<?php
// ==================== LOGIC SECTION (Top of customer_profile.php) ====================
require_once 'config/db_connect.php';
require_once 'Classes/Customer.php';

$customer = new Customer();

$account_id = $_SESSION['account_id'] ?? $_SESSION['user_id'] ?? $_SESSION['customer_id'] ?? null;

// Redirect if not logged in
if (!$account_id) {
    header("Location: login.php");
    exit();
}

// Fetch current profile data
$profile = $customer->getProfile($account_id);

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = [
        'first_name' => trim($_POST['first_name'] ?? ''),
        'last_name'  => trim($_POST['last_name'] ?? ''),
        'phone'      => trim($_POST['phone'] ?? ''),
        'address'    => trim($_POST['address'] ?? ''),
        'city'       => trim($_POST['city'] ?? ''),
        'state'      => trim($_POST['state'] ?? '')
    ];

    $result = $customer->saveProfile($account_id, $data);
    
    if ($result) {
        $message = '<div class="alert alert-success alert-dismissible fade show">✅ Profile updated successfully!</div>';
        $profile = $customer->getProfile($account_id); // Refresh
    } else {
        $message = '<div class="alert alert-danger alert-dismissible fade show">❌ Failed to update profile.</div>';
    }
}
?>