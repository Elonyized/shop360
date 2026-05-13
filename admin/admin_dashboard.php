<?php
// admin/dashboard.php

session_start();
require_once '../config/db_connect.php';
require_once '../Classes/Product.php';
require_once '../Classes/Order.php';
require_once '../Classes/Customer.php';

$productObj  = new Product();
$orderObj    = new Order();
$customerObj = new Customer();

// Get Data
$totalRevenue   = $orderObj->getTotalRevenue() ?? 0;
$totalOrders    = $orderObj->getTotalOrders() ?? 0;
$pendingOrders  = $orderObj->getPendingOrdersCount() ?? 0;
// $totalCustomers = $customerObj->getTotalCustomers() ?? 0;
// $totalProducts  = $productObj->getTotalProducts() ?? 0;
$recentOrders   = $orderObj->getRecentOrders(5) ?? [];
?>

<?php include "../includes/header.php"; ?>

<!-- <link rel="stylesheet" href="../assets/css/admin_dashboard.css"> -->

<div class="admin-layout">

    <!-- ==================== SIDEBAR ==================== -->
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
                <div class="admin-avatar"><?= strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)) ?></div>
                <div class="admin-info">
                    <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Administrator') ?></strong>
                    <span>Admin</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="main">

        <header class="topbar">
            <div class="topbar-left">
                <h1>Dashboard</h1>
                <span>Welcome back — here's what's happening today</span>
            </div>
        </header>

        <div class="page-body">

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card purple">
                    <div class="stat-icon"><i class="fas fa-pound-sign"></i></div>
                    <div class="stat-value">₦<?= number_format($totalRevenue, 2) ?></div>
                    <div class="stat-label">Total Revenue</div>
                </div>

                <div class="stat-card orange">
                    <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="stat-value"><?= $totalOrders ?></div>
                    <div class="stat-label">Total Orders</div>
                    <small><?= $pendingOrders ?> Pending</small>
                </div>

                <div class="stat-card green">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-value"><?= $totalCustomers ?></div>
                    <div class="stat-label">Customers</div>
                </div>

                <div class="stat-card blue">
                    <div class="stat-icon"><i class="fas fa-box"></i></div>
                    <div class="stat-value"><?= $totalProducts ?></div>
                    <div class="stat-label">Products</div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card">
                <div class="card-header">
                    <h3>Recent Orders</h3>
                    <a href="orders.php">View All →</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentOrders)): ?>
                            <tr><td colspan="5" class="text-center py-4">No orders yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td>#<?= str_pad($order['id'] ?? 0, 5, '0', STR_PAD_LEFT) ?></td>
                                <td><?= htmlspecialchars($order['customer_name'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($order['product_name'] ?? 'N/A') ?></td>
                                <td>₦<?= number_format($order['total_amount'] ?? 0, 2) ?></td>
                                <td><span class="badge"><?= ucfirst($order['status'] ?? 'Pending') ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>