
<?php 
require_once '../config/db_connect.php';
require_once 'includes/auth_check.php'; 
require_once 'includes/admin_header.php';

// Include the Admin Class
require_once '../Classes/admin.php';     // Adjust path if needed

// Create object
$admin = new Admin($pdo);

$stats = $admin->getDashboardStats();
?>

<h1 class="text-3xl font-bold text-purple-700 mb-8">Dashboard Overview</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Total Products</p>
        <p class="text-5xl font-bold text-purple-700"><?= $stats['total_products'] ?></p>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Total Orders</p>
        <p class="text-5xl font-bold text-orange-600"><?= $stats['total_orders'] ?></p>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Total Customers</p>
        <p class="text-5xl font-bold"><?= $stats['total_customers'] ?></p>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Pending Orders</p>
        <p class="text-5xl font-bold text-red-600"><?= $stats['pending_orders'] ?></p>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>