<?php
// products.php

session_start();
require_once 'config/db_connect.php';
require_once 'Classes/Product.php';

$productObj = new Product();
$products = $productObj->getAllProducts();
?>

<?php include "includes/header.php"; ?>

<div class="container py-5">
    <h1 class="text-white mb-4">Our Products</h1>

     <a href="index.php" class="btn btn-secondary mb-4">← Back to Home</a>

    <div class="row g-4">
        <?php if (empty($products)): ?>
            <div class="col-12 text-center">
                <p class="text-light">No products available at the moment.</p>
            </div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 bg-dark text-white border-0">

                        <?php 
                        $featuredImg = $productObj->getFeaturedImage($product['id']);

                            $imageSrc = $featuredImg 
                                ? 'assets/image/' . $featuredImg 
                                : 'assets/image/no-image.jpg';
                        ?>
                            <img src="<?= htmlspecialchars($imageSrc) ?>" 
                            class="card-img-top" 
                            alt="<?= htmlspecialchars($product['product_name']) ?>"
                            style="height: 220px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                            <p class="text-success fw-bold mb-2">$<?= number_format($product['product_price'], 2) ?></p>
                            
                            <p class="card-text text-light small flex-grow-1">
                                <?= htmlspecialchars(substr($product['product_description'] ?? '', 0, 85)) ?>...
                            </p>

                            <a href="product_details.php?id=<?= $product['id'] ?>" 
                               class="btn btn-primary mt-3">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include "includes/footer.php"; ?>