<?php
// includes/customer_auth.php

session_start();
require_once '../config/db_connect.php';     // ← Change if your db file path is different

// If user is not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../customer_dashboard.php");
    exit();
}

// Get customer details from customers table
$stmt = $pdo->prepare("SELECT * FROM customers WHERE account_Id = ?");
$stmt->execute([$_SESSION['user_id']]);
$customer = $stmt->fetch();

// If customer record doesn't exist yet, create one automatically
if (!$customer) {
    $stmt = $pdo->prepare("INSERT INTO customers (account_Id) VALUES (?)");
    $stmt->execute([$_SESSION['user_id']]);
    
    // Fetch the newly created customer
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE account_Id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $customer = $stmt->fetch();
}
?>