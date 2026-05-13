<?php

if (isset($_SESSION['success'])) {
    $message = '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}

include "includes/header.php";

require_once 'config/db_connect.php';
require_once 'classes/Product.php';
$product = new product();
$products = $product->getALLproducts($pdo);
?>




   <div class="container mt-5">
    <div class="row g-4">

        <?php foreach($products as $product): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 d-flex flex-column">

                        <h5 class="card-title fw-semibold mb-2"><?= htmlspecialchars($product['product_name']) ?></h5>
                        
                        <p class="text-muted small mb-3"><?= htmlspecialchars($product['product_category']) ?></p>
                        
                        <p class="card-text flex-grow-1 text-secondary"><?= htmlspecialchars($product['product_description']) ?></p>
                        
                        <h4 class="fw-bold text-dark mt-3 mb-4"> ₦<?= number_format($product['product_price'], 2) ?></h4>
                        
                    </div>
                    
                    <div class="card-footer">
                        <a href="order.php?id=<?= $product['id'] ?? '' ?>" class="btn btn-secondary">Order


                        <a href="product_details.php?id=<?= $product['id'] ?? '' ?>"class="btn btn-primary">View Details</a>
                    </div>
                </div>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include "includes/footer.php";?>