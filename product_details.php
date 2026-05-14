<?php
// product_details.php

session_start();
require_once 'config/db_connect.php';
require_once 'Classes/Product.php';

$productObj = new Product();

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    die("<div class='alert alert-danger text-center mt-5'>Invalid Product ID</div>");
}

$product = $productObj->getProductById($product_id);
$images  = $productObj->getProductImages($product_id);

if (!$product) {
    die("<div class='alert alert-danger text-center mt-5'>Product not found!</div>");
}

// Get featured image
$featured_image = $productObj->getFeaturedImage($product_id);
?>

<?php include "includes/header.php"; ?>

<div class="container py-5">

    <a href="products.php" class="btn btn-secondary mb-4">← Back to Products</a>

    <div class="row">

        <!-- Images Section -->
        <div class="col-lg-6">

            <!-- Main Featured Image -->
            <div class="card mb-4 shadow">
                <img id="mainImage" 
                     src="<?= htmlspecialchars($featured_image ?? ($images[0]['image_path'] ?? 'assets/image/no-image.png')) ?>" 
                     class="card-img-top" 
                     alt="<?= htmlspecialchars($product['product_name']) ?>"
                     style="height: 450px; object-fit: contain; background:#f8f9fa;">
            </div>

            <!-- Thumbnail Gallery -->
            <?php if (count($images) > 1): ?>
                <h5 class="mb-3 text-white">More Images</h5>
                <div class="row g-3">
                    <?php foreach($images as $img): ?>
                        <div class="col-3">
                            <img src="<?= htmlspecialchars($img['image_path']) ?>" 
                                 class="img-thumbnail"
                                 style="height: 100px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('mainImage').src = this.src">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Information -->
        <div class="col-lg-6">
            <h2 class="text-white"><?= htmlspecialchars($product['product_name']) ?></h2>
            <h4 class="text-success fw-bold">$<?= number_format($product['price'], 2) ?></h4>
            
            <p><strong>Category:</strong> <?= htmlspecialchars($product['category'] ?? 'N/A') ?></p>
            
            <hr>
            <h5 class="text-white">Description</h5>
            <p class="lead text-light">
                <?= nl2br(htmlspecialchars($product['description'] ?? '')) ?>
            </p>

            <div class="mt-4">
                <?php if (isset($_SESSION['account_id']) || isset($_SESSION['user_id'])): ?>
                    <a href="processes/place_order_process.php?product_id=<?= $product_id ?>" 
                       class="btn btn-success btn-lg w-100">Place Order</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-warning btn-lg w-100">Login to Place Order</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>