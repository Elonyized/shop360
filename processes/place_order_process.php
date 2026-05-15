<?php
// processes/place_order_process.php

session_start();
require_once '../config/db_connect.php';
require_once '../Classes/Order.php';

$orderObj = new Order();

$account_id = $_SESSION['account_id'] ?? $_SESSION['user_id'] ?? null;

if (!$account_id) {
    $_SESSION['error'] = "Please login first!";
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $product_id = (int)$_POST['product_id'];
    $quantity   = (int)$_POST['quantity'];
    $address    = trim($_POST['address']);
    $phone      = trim($_POST['phone']);

    if ($product_id <= 0 || $quantity <= 0) {
        $_SESSION['error'] = "Invalid order details!";
        header("Location: ../products.php");
        exit();
    }

    $result = $orderObj->placeOrder($account_id, $product_id, $quantity, $address, $phone);

    if ($result) {
        $_SESSION['success'] = "✅ Order placed successfully!";
        header("Location: ../customer_orders.php");
        exit();
    } else {
        $_SESSION['error'] = "❌ Failed to place order. Please try again.";
    }
}

header("Location: ../product_details.php?id=" . $product_id);
exit();
?>