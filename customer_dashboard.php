<?php
// customer_dashboard.php

session_start();
require_once 'config/db_connect.php';
require_once 'Classes/Customer.php';
require_once 'Classes/Order.php';

$customer = new Customer();
$orderObj = new Order();

$account_id = $_SESSION['account_id'] ?? $_SESSION['user_id'] ?? null;

if (!$account_id) {
    header("Location: login.php");
    exit();
}

$profile = $customer->getProfile($account_id);
$orders  = $orderObj->getCustomerOrders($account_id);
?>

<?php include "includes/header.php"; ?>

<div class="container-fluid py-4">
    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-2">
            <aside class="sidebar">
                <div class="sidebar-brand">
                    <div class="brand-icon">TM</div>
                    <div class="brand-text">
                        <strong>Trinity Mart</strong>
                        <span>Customer Area</span>
                    </div>
                </div>

                <nav>
                    <a href="customer_dashboard.php" class="nav-link active">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                    <a href="customer_profile.php" class="nav-link">
                        <i class="fas fa-user"></i> My Profile
                    </a>
                    <a href="customer_orders.php" class="nav-link">
                        <i class="fas fa-shopping-bag"></i> My Orders
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-heart"></i> Wishlist
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-map-marker-alt"></i> Addresses
                    </a>

                    <div class="nav-section-label mt-4">Account</div>
                    <a href="../index.php" class="nav-link" target="_blank">
                        <i class="fas fa-store"></i> Browse Store
                    </a>
                    <a href="../logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </nav>
            </aside>
        </div>

        <!-- Main Content -->
        <div class="col-lg-10">
            <h1 class="text-white mb-2">
                Welcome back, <?= htmlspecialchars($profile['first_name'] ?? $profile['last_name'] ?? 'Customer') ?>!
            </h1>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center p-4">
                        <h3><?= count($orders) ?></h3>
                        <p>Total Orders</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4">
                        <h3>0</h3>
                        <p>Wishlist Items</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4">
                        <h3>₦0</h3>
                        <p>Total Spent</p>
                    </div>
                </div>
            </div>

            <h4 class="text-white mt-5 mb-3">Recent Orders</h4>
            <!-- Add table here later -->
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>