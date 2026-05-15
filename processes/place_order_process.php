<?php
// processes/place_order_process.php

require_once '../config/db_connect.php';
require_once '../Classes/Order.php';

$orderObj = new Order();

// Check if user is logged in
if (!isset($_SESSION['user_id']) && !isset($_SESSION['account_id'])) {
    $_SESSION['error'] = "You must login to place an order!";
    header("Location: ../login.php");
    exit();
}

// Get customer_id
$customer_id = $_SESSION['user_id'] ?? $_SESSION['account_id'];

// Get data from URL
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

if ($product_id <= 0 || $quantity <= 0) {
    $_SESSION['error'] = "Invalid product or quantity!";
    header("Location: ../Product_order_details.php?id=$product_id");
    exit();
}

// Get product price
$stmt = $pdo->prepare("SELECT product_price, in_stock FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    $_SESSION['error'] = "Product not found!";
    header("Location: ../products.php");
    exit();
}

$total_amount = $quantity * $product['product_price'];

// Default shipping address (you can improve this later)
$shipping_address = "Default Address - Please update in profile";
$payment_type = "Cash on Delivery";

// Place Order with Stock Reduction
$success = $orderObj->placeOrder(
    $customer_id, 
    $product_id, 
    $quantity, 
    $total_amount, 
    $shipping_address, 
    $payment_type
);

if ($success) {
    $_SESSION['success'] = "Order placed successfully!";
    header("Location: ../orders.php");
} else {
    $_SESSION['error'] = "Not enough stock or failed to place order!";
    header("Location: ../Product_order_details.php?id=$product_id");
}

exit();
?>