<?php
// place_order.php

session_start();
require_once '../config/db_connect.php';
require_once '../Classes/Product.php';

$productObj = new Product();

$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

if ($product_id <= 0) {
    $_SESSION['error'] = "Invalid Product!";
    header("Location: products.php");
    exit();
}

if (!isset($_SESSION['account_id']) && !isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must login to place an order!";
    header("Location: login.php");
    exit();
}

$account_id = $_SESSION['account_id'] ?? $_SESSION['user_id'];
$product = $productObj->getProductById($product_id);

if (!$product) {
    $_SESSION['error'] = "Product not found!";
    header("Location: ../products.php");
    exit();
}
?>

<?php include "includes/header.php"; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2 class="text-white mb-4">Place Order</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="<?= htmlspecialchars($productObj->getFeaturedImage($product_id) ?? 'assets/image/no-image.png') ?>" 
                                 class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
                        </div>
                        <div class="col-md-8">
                            <h4><?= htmlspecialchars($product['product_name']) ?></h4>
                            <h5 class="text-success">₦<?= number_format($product['price'], 2) ?></h5>
                        </div>
                    </div>

                    <form method="POST" action="processes/place_order_process.php">
                        <input type="hidden" name="product_id" value="<?= $product_id ?>">

                        <div class="mb-3">
                            <label class="form-label text-light">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Phone Number</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            Confirm & Place Order
                        </button>
                    </form>

                </div>
            </div>

            <div class="text-center mt-3">
                <a href="product_details.php?id=<?= $product_id ?>" class="btn btn-secondary">
                    ← Back to Product Details
                </a>
            </div>

        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>