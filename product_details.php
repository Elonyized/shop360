<?php
// product_details.php

session_start();
require_once 'config/db_connect.php';
// require_once 'Classes/Product.php';
require_once 'processes/place_order_process.php';

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
                <?php
                $mainImage = $featured_image 
                    ? 'assets/image/' . $featured_image 
                    : (!empty($images[0]['image_path']) 
                        ? 'assets/image/' . $images[0]['image_path'] 
                        : 'assets/image/no-image.jpg');
                ?>

                <img id="mainImage" 
                    src="<?= htmlspecialchars($mainImage) ?>" 
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
                            <img src="<?= htmlspecialchars('assets/image/' . $img['image_path']) ?>" 
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
            <h4 class="text-success fw-bold">$<?= number_format($product['product_price'], 2) ?></h4>
            
            <p><strong>Category:</strong> <?= htmlspecialchars($product['product_category'] ?? 'N/A') ?></p>
            
            <hr>
            <h5 class="text-white">Description</h5>
            <p class="lead text-light">
                <?= nl2br(htmlspecialchars($product['product_description'] ?? '')) ?>
            </p>

            <div class="mt-4">
                <?php if (isset($_SESSION['account_id']) || isset($_SESSION['user_id'])): ?>
                   <form method="GET" action="processes/place_order_process.php">
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
    
            <div class="mb-3">
            <label class="text-white">Quantity:</label>
            <input type="number" name="quantity" value="1" min="1" 
               max="<?= $product['in_stock'] ?? 10 ?>" 
               class="form-control w-50 d-inline">
            </div>

        <button type="submit" class="btn btn-success btn-lg w-100">
        Place Order
        </button>
        </form>
                <?php else: ?>
                    <a href="login.php" class="btn btn-warning btn-lg w-100">Login to Place Order</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>