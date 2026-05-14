<?php 
// Customer must be logged in
require_once '../config/db_connect.php';
require_once 'include/customer_auth.php'; 
require_once 'Classes/Order.php';
$orderObj = new Order();

$product_id = intval($_GET['id'] ?? 0);

if ($product_id <= 0) {
    die("<h2 class='text-center text-red-600 mt-10'>Invalid Product!</h2>");
}

// Fetch the product
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    die("<h2 class='text-center text-red-600 mt-10'>Product not found!</h2>");
}
?>
<?php
include "includes/header.php";
?>

<!-- Rest of your page content (HTML + Form) goes here -->

<?php
// ORDER PLACEMENT LOGIC
if (isset($_POST['place_order'])) {
    $quantity         = intval($_POST['quantity']);
    $total_amount     = $quantity * $product['product_price'];
    $shipping_address = trim($_POST['shipping_address']);
    $payment_type     = $_POST['payment_type'];

    $success = $orderObj->placeOrder(
        $customer['id'], 
        $product['id'], 
        $quantity, 
        $total_amount, 
        $shipping_address, 
        $payment_type
    );

    if ($success) {
        echo "<script>alert(' Order Placed Successfully!'); window.location.href='orders.php';</script>";
    } else {
        echo "<script>alert(' Failed to place order.');</script>";
    }
}
?>

<?php require_once 'includes/footer.php'; ?>