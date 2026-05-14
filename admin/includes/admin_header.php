<?php require_once 'auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinity Mart Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .sidebar { background: linear-gradient(180deg, #6B21A8, #581C87); }
        .accent-orange { color: #F97316; }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 sidebar text-white">
        <div class="p-6 border-b border-purple-700">
            <h1 class="text-2xl font-bold">Trinity Mart</h1>
            <p class="text-orange-400 text-sm">Admin Panel</p>
        </div>
        
        <nav class="mt-8">
            <a href="admin_dashboard.php" class="flex items-center px-6 py-4 hover:bg-white/10 <?= basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'bg-white/20' : '' ?>">
                <i class="fas fa-home w-5 mr-3"></i> Dashboard
            </a>
            <a href="admin_product.php" class="flex items-center px-6 py-4 hover:bg-white/10 <?= basename($_SERVER['PHP_SELF']) == 'admin_product.php' ? 'bg-white/20' : '' ?>">
                <i class="fas fa-box w-5 mr-3"></i> Products
            </a>
            <a href="admin_orders.php" class="flex items-center px-6 py-4 hover:bg-white/10 <?= basename($_SERVER['PHP_SELF']) == 'admin_orders.php' ? 'bg-white/20' : '' ?>">
                <i class="fas fa-shopping-cart w-5 mr-3"></i> Orders
            </a>
            <a href="admin_customer.php" class="flex items-center px-6 py-4 hover:bg-white/10 <?= basename($_SERVER['PHP_SELF']) == 'admin_customer.php' ? 'bg-white/20' : '' ?>">
                <i class="fas fa-users w-5 mr-3"></i> Customers
            </a>
        </nav>

        <div class="absolute bottom-8 px-6 w-64">
            <a href="admin_logout.php" class="flex items-center text-red-300 hover:text-red-400">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Admin Dashboard</h2>
            <div class="text-sm text-gray-500"><?= date("l, d F Y") ?></div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-8 overflow-auto">