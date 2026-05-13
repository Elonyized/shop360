<?php
// =============================================================
// FILE: admin/dashboard.php
// PURPOSE: Trinity Mart Admin Dashboard — stats, charts, quick actions
// INCLUDE AT TOP: session_start(), require db.php, requireAdmin()
// =============================================================
session_start();
require_once 'classes/product.php';
require_once 'config/db_connect.php';

// --- DATA QUERIES ---
// $totalProducts  = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
// $totalorders    = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
// $totalCustomers = $pdo->query("SELECT COUNT(*) FROM accounts WHERE role='customer'")->fetchColumn();
// $pendingOrders  = $pdo->query("SELECT COUNT(*) FROM orders WHERE status='Pending'")->fetchColumn();
// $deliveredOrders= $pdo->query("SELECT COUNT(*) FROM orders WHERE status='Delivered'")->fetchColumn();
// $totalRevenue   = $pdo->query(
//     "SELECT COALESCE(SUM(p.price * o.quantity),0)
//      FROM orders o JOIN products p ON p.id = o.product_id
//      WHERE o.status != 'Cancelled'"
// )->fetchColumn();

// // Recent 5 orders
// $recentOrders = $pdo->query(
//     "SELECT o.id, o.status, o.created_at, o.quantity,
//             p.name AS product_name, p.price,
//             a.username
//      FROM orders o
//      JOIN products p  ON p.id = o.product_id
//      JOIN customers c ON c.id = o.customer_id
//      JOIN accounts a  ON a.id = c.account_id
//      ORDER BY o.created_at DESC LIMIT 5"
// )->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinity Mart — Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- ============================================================
         CSS: ADD THIS BLOCK TO admin/css/admin.css
         OR paste inside a <style> tag in the <head>
         ============================================================ -->
    <style>
        /* ── VARIABLES ── */
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
            --shadow-lg:   0 8px 40px rgba(108,60,225,.18);
            --sidebar-w:   260px;
            --font:        'Plus Jakarta Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font); background: var(--gray-50); color: var(--gray-900); display: flex; min-height: 100vh; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(175deg, var(--purple-dark) 0%, var(--purple) 100%);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex; flex-direction: column;
            padding: 0 0 24px;
            z-index: 100;
            box-shadow: 4px 0 30px rgba(76,29,149,.25);
        }

        .sidebar-brand {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,.12);
            display: flex; align-items: center; gap: 12px;
        }

        .brand-icon {
            width: 44px; height: 44px;
            background: var(--orange);
            border-radius: 12px;
            display: grid; place-items: center;
            font-weight: 800; color: #fff; font-size: 18px;
            box-shadow: 0 4px 14px rgba(249,115,22,.45);
        }

        .brand-text { color: #fff; }
        .brand-text strong { display: block; font-size: 17px; font-weight: 800; letter-spacing: -.3px; }
        .brand-text span   { font-size: 11px; opacity: .6; font-weight: 500; }

        .sidebar nav { padding: 20px 12px; flex: 1; }

        .nav-section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
            color: rgba(255,255,255,.4); padding: 16px 12px 8px;
            text-transform: uppercase;
        }

        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: 10px;
            color: rgba(255,255,255,.75); text-decoration: none;
            font-size: 14px; font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,.15);
            color: #fff;
        }

        .nav-link.active {
            background: rgba(255,255,255,.2);
            box-shadow: inset 3px 0 0 var(--orange);
        }

        .nav-link i { width: 18px; text-align: center; font-size: 15px; }
        .nav-badge {
            margin-left: auto;
            background: var(--orange); color: #fff;
            font-size: 10px; font-weight: 700;
            padding: 2px 7px; border-radius: 20px;
        }

        .sidebar-footer {
            padding: 0 12px;
            border-top: 1px solid rgba(255,255,255,.12);
            padding-top: 16px; margin: 0 12px;
        }

        .admin-user {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: rgba(255,255,255,.1);
        }

        .admin-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--orange); display: grid; place-items: center;
            font-weight: 700; color: #fff; font-size: 14px;
        }

        .admin-info strong { display: block; color: #fff; font-size: 13px; }
        .admin-info span   { color: rgba(255,255,255,.5); font-size: 11px; }

        /* ── MAIN CONTENT ── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }

        /* ── TOP BAR ── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--gray-100);
            padding: 0 32px;
            height: 68px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }

        .topbar-left h1 { font-size: 20px; font-weight: 800; color: var(--gray-900); }
        .topbar-left span { font-size: 13px; color: var(--gray-500); }

        .topbar-right { display: flex; align-items: center; gap: 16px; }

        .topbar-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--gray-100);
            display: grid; place-items: center;
            color: var(--gray-700); font-size: 15px;
            cursor: pointer; transition: all .2s; position: relative;
        }

        .topbar-icon:hover { background: var(--purple-soft); color: var(--purple); }

        .notif-dot {
            position: absolute; top: 8px; right: 8px;
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--orange); border: 2px solid #fff;
        }

        /* ── PAGE BODY ── */
        .page-body { padding: 32px; flex: 1; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
        }

        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }

        .stat-card::before {
            content: '';
            position: absolute; top: 0; left: 0;
            width: 4px; height: 100%;
        }

        .stat-card.purple::before { background: var(--purple); }
        .stat-card.orange::before { background: var(--orange); }
        .stat-card.green::before  { background: #10B981; }
        .stat-card.blue::before   { background: #3B82F6; }

        .stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: grid; place-items: center;
            font-size: 20px; margin-bottom: 16px;
        }

        .stat-card.purple .stat-icon { background: var(--purple-soft); color: var(--purple); }
        .stat-card.orange .stat-icon { background: var(--orange-soft); color: var(--orange); }
        .stat-card.green  .stat-icon { background: #D1FAE5; color: #059669; }
        .stat-card.blue   .stat-icon { background: #DBEAFE; color: #2563EB; }

        .stat-value { font-size: 28px; font-weight: 800; color: var(--gray-900); line-height: 1; margin-bottom: 4px; }
        .stat-label { font-size: 13px; color: var(--gray-500); font-weight: 500; }
        .stat-change {
            margin-top: 12px; font-size: 12px; font-weight: 600;
            display: flex; align-items: center; gap: 4px;
        }

        .stat-change.up   { color: #059669; }
        .stat-change.down { color: #DC2626; }

        /* ── BOTTOM GRID ── */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
        }

        /* ── TABLE CARD ── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--gray-100);
            display: flex; align-items: center; justify-content: space-between;
        }

        .card-header h3 { font-size: 16px; font-weight: 700; color: var(--gray-900); }
        .card-header a  {
            font-size: 13px; font-weight: 600; color: var(--purple);
            text-decoration: none; padding: 6px 14px;
            border: 1.5px solid var(--purple); border-radius: 8px;
            transition: all .2s;
        }
        .card-header a:hover { background: var(--purple); color: #fff; }

        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 12px 20px; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .8px;
            color: var(--gray-500); background: var(--gray-50);
            text-align: left;
        }
        tbody td { padding: 14px 20px; font-size: 14px; border-top: 1px solid var(--gray-100); }
        tbody tr:hover td { background: var(--gray-50); }

        .order-id { font-weight: 700; color: var(--purple); }
        .product-name { font-weight: 600; color: var(--gray-900); max-width: 160px; truncate: ellipsis; }

        /* Status badges */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700; letter-spacing: .3px;
        }

        .badge-pending    { background: #FEF3C7; color: #B45309; }
        .badge-processing { background: #DBEAFE; color: #1D4ED8; }
        .badge-delivered  { background: #D1FAE5; color: #065F46; }
        .badge-cancelled  { background: #FEE2E2; color: #991B1B; }

        /* ── QUICK ACTIONS ── */
        .quick-actions { display: flex; flex-direction: column; gap: 12px; padding: 20px; }

        .action-btn {
            display: flex; align-items: center; gap: 14px;
            padding: 16px 18px; border-radius: 10px;
            background: var(--gray-50); text-decoration: none;
            color: var(--gray-700); font-weight: 600; font-size: 14px;
            border: 1.5px solid var(--gray-100);
            transition: all .2s;
        }

        .action-btn:hover {
            background: var(--purple-soft);
            border-color: var(--purple);
            color: var(--purple);
            transform: translateX(4px);
        }

        .action-btn i {
            width: 36px; height: 36px; border-radius: 9px;
            background: var(--white); display: grid; place-items: center;
            font-size: 15px; box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }
    </style>
</head>
<body>

<!-- ============================================================
     SIDEBAR — admin/dashboard.php
     ============================================================ -->
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
        <a href="dashboard.php" class="nav-link active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="products.php" class="nav-link">
            <i class="fas fa-box"></i> Products
        </a>
        <a href="orders.php" class="nav-link">
            <i class="fas fa-shopping-bag"></i> Orders
            <?php if ($pendingOrders > 0): ?>
            <span class="nav-badge"><?= $pendingOrders ?></span>
            <?php endif; ?>
        </a>
        <a href="customers.php" class="nav-link">
            <i class="fas fa-users"></i> Customers
        </a>

        <div class="nav-section-label">System</div>
        <a href="../index.php" class="nav-link" target="_blank">
            <i class="fas fa-store"></i> View Store
        </a>
        <a href="logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
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

<!-- ============================================================
     MAIN CONTENT
     ============================================================ -->
<div class="main">

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="topbar-left">
            <h1>Dashboard</h1>
            <span>Welcome back — here's what's happening today</span>
        </div>
        <div class="topbar-right">
            <div class="topbar-icon">
                <i class="fas fa-bell"></i>
                <?php if ($pendingOrders > 0): ?><span class="notif-dot"></span><?php endif; ?>
            </div>
            <div class="topbar-icon"><i class="fas fa-cog"></i></div>
        </div>
    </header>

    <!-- PAGE BODY -->
    <div class="page-body">

        <!-- STAT CARDS -->
        <div class="stats-grid">
            <div class="stat-card purple">
                <div class="stat-icon"><i class="fas fa-pound-sign"></i></div>
                <div class="stat-value">£<?= number_format($totalRevenue, 2) ?></div>
                <div class="stat-label">Total Revenue</div>
                <div class="stat-change up"><i class="fas fa-arrow-up"></i> From all completed orders</div>
            </div>

            <div class="stat-card orange">
                <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                <div class="stat-value"><?= $totalOrders ?></div>
                <div class="stat-label">Total Orders</div>
                <div class="stat-change up"><i class="fas fa-circle"></i> <?= $pendingOrders ?> pending</div>
            </div>

            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-value"><?= $totalCustomers ?></div>
                <div class="stat-label">Customers</div>
                <div class="stat-change up"><i class="fas fa-arrow-up"></i> Registered accounts</div>
            </div>

            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-box"></i></div>
                <div class="stat-value"><?= $totalProducts ?></div>
                <div class="stat-label">Products</div>
                <div class="stat-change up"><i class="fas fa-circle"></i> Active listings</div>
            </div>
        </div>

        <!-- BOTTOM GRID -->
        <div class="bottom-grid">

            <!-- RECENT ORDERS TABLE -->
            <div class="card">
                <div class="card-header">
                    <h3>Recent Orders</h3>
                    <a href="orders.php">View All</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($recentOrders as $order): ?>
                    <tr>
                        <td><span class="order-id">#<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></span></td>
                        <td><?= htmlspecialchars($order['username']) ?></td>
                        <td class="product-name"><?= htmlspecialchars($order['product_name']) ?></td>
                        <td>£<?= number_format($order['price'] * $order['quantity'], 2) ?></td>
                        <td>
                            <span class="badge badge-<?= strtolower($order['status']) ?>">
                                <?= $order['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- QUICK ACTIONS -->
            <div class="card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="quick-actions">
                    <a href="products.php?action=add" class="action-btn">
                        <i class="fas fa-plus"></i> Add New Product
                    </a>
                    <a href="orders.php?filter=Pending" class="action-btn">
                        <i class="fas fa-clock"></i> View Pending Orders
                    </a>
                    <a href="customers.php" class="action-btn">
                        <i class="fas fa-user-plus"></i> View All Customers
                    </a>
                    <a href="../index.php" target="_blank" class="action-btn">
                        <i class="fas fa-external-link-alt"></i> Preview Storefront
                    </a>
                </div>
            </div>

        </div><!-- /bottom-grid -->
    </div><!-- /page-body -->
</div><!-- /main -->

</body>
</html>