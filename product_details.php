<?php
include "includes/header.php";

require_once 'classes/product.php';
require_once 'config/db_connect.php';

$products = new Product();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetails = $products->getProductById($pdo, $id);
} else {
    header('Location: product.php');
    exit();
}
?>


<body>
    <div class="container mt-5">
     <div class="row justify-content-center">
          <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                 <div class="card-body p-4">
                      <h2 class="card-title fw-semibold mb-3"><?= htmlspecialchars($productDetails['product_name']) ?></h2>
                      <p class="text-muted small mb-4"><?= htmlspecialchars($productDetails['product_category']) ?></p>
                      <p class="card-text text-secondary mb-4"><?= htmlspecialchars($productDetails['product_description']) ?></p>
                      <h3 class="fw-bold text-dark mb-4"> ₦<?= number_format($productDetails['product_price'], 2) ?></h3>
                      <a href="order.php?id=<?= $productDetails['id'] ?? '' ?>" class="btn btn-primary">Order Now</a>
                      <a href="product.php" class="btn btn-secondary">Back to Products</a>
                 </div>
                </div>
          </div>
        </div>
    </div>


<?php include "includes/footer.php";?>