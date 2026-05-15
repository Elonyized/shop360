<?php
// processes/customer_process.php

session_start();
require_once '../config/db_connect.php';
require_once '../Classes/Customer.php';

$customer = new Customer();

$account_id = $_SESSION['account_id'] ?? $_SESSION['user_id'] ?? null;

if (!$account_id) {
    $_SESSION['error'] = "Please login first!";
    header("Location: ../login.php");
    exit();
}

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
        $_SESSION['success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to save profile. Please try again.";
    }
}

header("Location: ../customer_dashboard.php");
exit();
?>