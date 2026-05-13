<?php
include "includes/header.php";

require_once 'classes/product.php';
require_once 'config/db_connect.php';
?>


<!-- SIDEBAR — admin/dashboard.php -->
<div class="admin-layout">
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
</div>
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
<?php include "includes/footer.php";?>