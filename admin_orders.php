<?php
// =============================================================
// FILE: admin/orders.php
// PURPOSE: Trinity Mart — Admin Orders Management Page
// INCLUDE AT TOP: session_start(), require db.php, requireAdmin()
// =============================================================
session_start();
requireAdmin();

$message = '';
$msgType = 'success';

// ── UPDATE ORDER STATUS ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $orderId   = (int)$_POST['order_id'];
    $newStatus = $_POST['status'];
    $allowed   = ['Pending', 'Processing', 'Delivered', 'Cancelled'];
    if (in_array($newStatus, $allowed)) {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $orderId]);
        $message = "Order #" . str_pad($orderId, 4, '0', STR_PAD_LEFT) . " updated to <strong>$newStatus</strong>.";
    }
}

// ── FILTER ──
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$allowedFilters = ['all', 'Pending', 'Processing', 'Delivered', 'Cancelled'];
if (!in_array($filter, $allowedFilters)) $filter = 'all';

$whereClause = ($filter !== 'all') ? "WHERE o.status = '$filter'" : '';

// ── FETCH ORDERS ──
$orders = $pdo->query(
    "SELECT o.id, o.quantity, o.status, o.created_at,
            p.name AS product_name, p.price,
            c.first_name, c.last_name,
            a.username, a.email
     FROM orders o
     JOIN products p  ON p.id = o.product_id
     JOIN customers c ON c.id = o.customer_id
     JOIN accounts a  ON a.id = c.account_id
     $whereClause
     ORDER BY o.created_at DESC"
)->fetchAll();

// ── STATUS COUNTS ──
$counts = [];
foreach (['all', 'Pending', 'Processing', 'Delivered', 'Cancelled'] as $s) {
    $where = ($s !== 'all') ? "WHERE status='$s'" : '';
    $counts[$s] = $pdo->query("SELECT COUNT(*) FROM orders $where")->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinity Mart — Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- ============================================================
         CSS: ADD THIS TO admin/css/admin.css
         (or inside a <style> tag)
         ============================================================ -->
    <style>
        :root {
            --purple:      #6C3CE1;
            --purple-dark: #4C1D95;
            --purple-soft: #EDE9FE;
            --orange:      #F97316;
            --orange-soft: #FFF7ED;
            --white:       #FFFFFF;
            --gray-50:     #F9FAFB;
            --gray-100:    #F3F4F6;
            --gray-300:    #D1D5DB;
            --gray-500:    #6B7280;
            --gray-700:    #374151;
            --gray-900:    #111827;
            --radius:      12px;
            --shadow:      0 4px 24px rgba(108,60,225,.10);
            --sidebar-w:   260px;
            --font:        'Plus Jakarta Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font); background: var(--gray-50); color: var(--gray-900); display: flex; min-height: 100vh; }

        /* SIDEBAR — reuse from dashboard.php styles */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(175deg, var(--purple-dark) 0%, var(--purple) 100%);
            min-height: 100vh; position: fixed; top: 0; left: 0;
            display: flex; flex-direction: column; padding: 0 0 24px;
            z-index: 100; box-shadow: 4px 0 30px rgba(76,29,149,.25);
        }
        .sidebar-brand { padding: 28px 24px 24px; border-bottom: 1px solid rgba(255,255,255,.12); display: flex; align-items: center; gap: 12px; }
        .brand-icon { width: 44px; height: 44px; background: var(--orange); border-radius: 12px; display: grid; place-items: center; font-weight: 800; color: #fff; font-size: 18px; box-shadow: 0 4px 14px rgba(249,115,22,.45); }
        .brand-text strong { display: block; color: #fff; font-size: 17px; font-weight: 800; }
        .brand-text span   { color: rgba(255,255,255,.5); font-size: 11px; }
        .sidebar nav { padding: 20px 12px; flex: 1; }
        .nav-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; color: rgba(255,255,255,.4); padding: 16px 12px 8px; text-transform: uppercase; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; color: rgba(255,255,255,.75); text-decoration: none; font-size: 14px; font-weight: 500; transition: all .2s; margin-bottom: 2px; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,.15); color: #fff; }
        .nav-link.active { background: rgba(255,255,255,.2); box-shadow: inset 3px 0 0 var(--orange); }
        .nav-link i { width: 18px; text-align: center; font-size: 15px; }
        .nav-badge { margin-left: auto; background: var(--orange); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 20px; }
        .sidebar-footer { padding: 16px 12px 0; border-top: 1px solid rgba(255,255,255,.12); margin: 0 12px; }
        .admin-user { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; background: rgba(255,255,255,.1); }
        .admin-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--orange); display: grid; place-items: center; font-weight: 700; color: #fff; font-size: 14px; }
        .admin-info strong { display: block; color: #fff; font-size: 13px; }
        .admin-info span   { color: rgba(255,255,255,.5); font-size: 11px; }

        /* MAIN */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar { background: var(--white); border-bottom: 1px solid var(--gray-100); padding: 0 32px; height: 68px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .topbar-left h1 { font-size: 20px; font-weight: 800; }
        .topbar-left span { font-size: 13px; color: var(--gray-500); }
        .page-body { padding: 32px; }

        /* TOAST */
        .toast {
            background: var(--white); border-radius: 10px;
            padding: 14px 20px; margin-bottom: 24px;
            display: flex; align-items: center; gap: 12px;
            box-shadow: var(--shadow);
            border-left: 4px solid #10B981;
            animation: slideIn .3s ease;
        }
        .toast i { color: #10B981; font-size: 18px; }
        @keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        /* FILTER TABS */
        .filter-tabs {
            display: flex; gap: 8px; margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 8px 18px; border-radius: 30px;
            font-size: 13px; font-weight: 600;
            text-decoration: none; border: 1.5px solid var(--gray-200);
            color: var(--gray-700); background: var(--white);
            transition: all .2s; display: flex; align-items: center; gap: 6px;
        }

        .filter-tab:hover { border-color: var(--purple); color: var(--purple); }

        .filter-tab.active {
            background: var(--purple); color: #fff; border-color: var(--purple);
            box-shadow: 0 4px 14px rgba(108,60,225,.3);
        }

        .filter-tab .count {
            background: rgba(255,255,255,.25);
            padding: 1px 6px; border-radius: 10px; font-size: 11px;
        }

        .filter-tab:not(.active) .count {
            background: var(--gray-100); color: var(--gray-500);
        }

        /* CARD */
        .card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
        .card-header { padding: 20px 24px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; }
        .card-header h3 { font-size: 16px; font-weight: 700; }
        .result-count { font-size: 13px; color: var(--gray-500); font-weight: 500; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }
        thead th { padding: 12px 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .8px; color: var(--gray-500); background: var(--gray-50); text-align: left; }
        tbody td { padding: 16px 20px; font-size: 14px; border-top: 1px solid var(--gray-100); vertical-align: middle; }
        tbody tr:hover td { background: #FAFAF9; }

        .order-id { font-weight: 800; color: var(--purple); font-size: 15px; }

        .customer-cell strong { display: block; font-weight: 600; }
        .customer-cell span   { font-size: 12px; color: var(--gray-500); }

        .product-cell strong { display: block; font-weight: 600; max-width: 180px; }
        .product-cell span   { font-size: 12px; color: var(--gray-500); }

        .amount-cell { font-weight: 700; color: var(--gray-900); font-size: 15px; }

        .date-cell { font-size: 13px; color: var(--gray-500); }

        /* Badges */
        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
        .badge-pending    { background: #FEF3C7; color: #B45309; }
        .badge-processing { background: #DBEAFE; color: #1D4ED8; }
        .badge-delivered  { background: #D1FAE5; color: #065F46; }
        .badge-cancelled  { background: #FEE2E2; color: #991B1B; }

        /* Status Update Form */
        .update-form { display: flex; align-items: center; gap: 8px; }

        .status-select {
            padding: 7px 10px; border-radius: 8px;
            border: 1.5px solid var(--gray-200);
            font-family: var(--font); font-size: 13px; font-weight: 500;
            color: var(--gray-700); background: var(--white);
            cursor: pointer; transition: border-color .2s;
        }

        .status-select:focus { outline: none; border-color: var(--purple); }

        .btn-save {
            padding: 7px 14px; border-radius: 8px;
            background: var(--purple); color: #fff;
            border: none; font-family: var(--font);
            font-size: 12px; font-weight: 700;
            cursor: pointer; transition: all .2s;
        }

        .btn-save:hover { background: var(--purple-dark); transform: scale(1.03); }

        /* Empty State */
        .empty-state {
            text-align: center; padding: 60px 24px;
            color: var(--gray-500);
        }
        .empty-state i { font-size: 48px; margin-bottom: 16px; color: var(--gray-300); }
        .empty-state p { font-size: 15px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">TM</div>
        <div class="brand-text">
            <strong>Trinity Mart</strong>
            <span>Admin Panel</span>
        </div>
    </div>
    <nav>
        <div class="nav-section-label">Main</div>
        <a href="dashboard.php" class="nav-link"><i class="fas fa-th-large"></i> Dashboard</a>
        <a href="products.php"  class="nav-link"><i class="fas fa-box"></i> Products</a>
        <a href="orders.php"    class="nav-link active">
            <i class="fas fa-shopping-bag"></i> Orders
            <?php if ($counts['Pending'] > 0): ?>
            <span class="nav-badge"><?= $counts['Pending'] ?></span>
            <?php endif; ?>
        </a>
        <a href="customers.php" class="nav-link"><i class="fas fa-users"></i> Customers</a>
        <div class="nav-section-label">System</div>
        <a href="../index.php" class="nav-link" target="_blank"><i class="fas fa-store"></i> View Store</a>
        <a href="logout.php"   class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
    <div class="sidebar-footer">
        <div class="admin-user">
            <div class="admin-avatar"><?= strtoupper(substr($_SESSION['username'], 0, 1)) ?></div>
            <div class="admin-info">
                <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
                <span>Administrator</span>
            </div>
        </div>
    </div>
</aside>

<!-- MAIN -->
<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <h1>Orders</h1>
            <span>Manage and update customer orders</span>
        </div>
    </header>

    <div class="page-body">

        <!-- TOAST MESSAGE -->
        <?php if ($message): ?>
        <div class="toast">
            <i class="fas fa-check-circle"></i>
            <span><?= $message ?></span>
        </div>
        <?php endif; ?>

        <!-- FILTER TABS -->
        <div class="filter-tabs">
            <?php
            $tabLabels = [
                'all' => 'All Orders',
                'Pending' => 'Pending',
                'Processing' => 'Processing',
                'Delivered' => 'Delivered',
                'Cancelled' => 'Cancelled',
            ];
            foreach ($tabLabels as $key => $label):
                $active = ($filter === $key) ? 'active' : '';
            ?>
            <a href="?filter=<?= $key ?>" class="filter-tab <?= $active ?>">
                <?= $label ?>
                <span class="count"><?= $counts[$key] ?></span>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- ORDERS TABLE -->
        <div class="card">
            <div class="card-header">
                <h3><?= $tabLabels[$filter] ?></h3>
                <span class="result-count"><?= count($orders) ?> order<?= count($orders) !== 1 ? 's' : '' ?></span>
            </div>

            <?php if (empty($orders)): ?>
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>No <?= $filter !== 'all' ? strtolower($filter) : '' ?> orders found.</p>
            </div>
            <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><span class="order-id">#<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></span></td>
                    <td class="customer-cell">
                        <strong><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></strong>
                        <span><?= htmlspecialchars($order['email']) ?></span>
                    </td>
                    <td class="product-cell">
                        <strong><?= htmlspecialchars($order['product_name']) ?></strong>
                        <span>£<?= number_format($order['price'], 2) ?> each</span>
                    </td>
                    <td><?= $order['quantity'] ?></td>
                    <td class="amount-cell">£<?= number_format($order['price'] * $order['quantity'], 2) ?></td>
                    <td class="date-cell"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></td>
                    <td>
                        <span class="badge badge-<?= strtolower($order['status']) ?>">
                            <?= $order['status'] ?>
                        </span>
                    </td>
                    <td>
                        <!-- STATUS UPDATE FORM -->
                        <form class="update-form" method="POST">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <select name="status" class="status-select">
                                <?php foreach (['Pending','Processing','Delivered','Cancelled'] as $s): ?>
                                <option value="<?= $s ?>" <?= $order['status'] === $s ? 'selected' : '' ?>>
                                    <?= $s ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" name="update_status" class="btn-save">Save</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>

    </div><!-- /page-body -->
</div><!-- /main -->

</body>
</html>