<?php
include "includes/header.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinity Mart - Everything You Need</title>
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6B21A8;
            --primary-dark: #581C87;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #6B21A8 0%, #C026D3 50%, #F97316 100%);
            color: white;
            position: relative;
            overflow: hidden;
            min-height: 580px;
            display: flex;
            align-items: center;
        }
        
        .hero-badge {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: 3.2rem;
            font-weight: 700;
            line-height: 1.1;
        }
        
        .hero-title span {
            color: #FDE047;
        }
        
        .hero-text {
            font-size: 1.25rem;
            opacity: 0.95;
        }
        
        .hero-btn-primary {
            background: white;
            color: var(--primary-dark);
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .hero-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .hero-btn-secondary {
            border: 2px solid white;
            color: white;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .hero-btn-secondary:hover {
            background: white;
            color: var(--primary-dark);
        }
        
        /* .floating-products {
            position: absolute;
            right: 8%;
            top: 15%;
            width: 45%;
            animation: float 6s ease-in-out infinite; */
        .floating-products {
            animation: float 6s ease-in-out infinite;
                }

            @keyframes float {
                0%, 100% { transform: translateY(0px) scale(1); }
                50% { transform: translateY(-35px) scale(1.02); }
                }           
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-25px); }
        }
        
        .category-card {
            background: white;
            border-radius: 16px;
            padding: 20px 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(107, 33, 168, 0.15);
        }
        
        .category-card img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            transition: transform 0.4s ease;
        }
        
        .category-card:hover img {
            transform: scale(1.1);
        }
        
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(107, 33, 168, 0.12);
        }
        
        .product-image img {
            transition: transform 0.4s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.08);
        }
        
        .service-box {
            background: white;
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }
        
        .service-box:hover {
            transform: translateY(-5px);
        }
        
        .section-heading h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }
        
        .section-heading h2:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: var(--primary);
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 3px;
        }
        
        .add-cart-btn {
            background: var(--primary);
            border: none;
            border-radius: 50px;
        }
    </style>
</head>
<body>

<!-- HERO SECTION -->
<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- LEFT CONTENT -->
            <div class="col-lg-6">
                <span class="hero-badge">BIG DEALS • BIG SAVINGS</span>
                
                <h1 class="hero-title mt-4">
                    Everything You Need,<br>
                    <span>All In One Place</span>
                </h1>
                
                <p class="hero-text mt-3">
                    Shop smarter with quality products at unbeatable prices.
                </p>
                
                <!-- BUTTONS -->
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <a href="products.php" class="btn hero-btn-primary d-flex align-items-center gap-2">
                        Shop Now 
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#" class="btn hero-btn-secondary">
                        Explore Deals
                    </a>
                </div>
                
                <!-- FEATURES -->
                <div class="hero-features mt-5 d-flex gap-4 flex-wrap">
                    <div class="feature-item d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check fs-4"></i>
                        <div>
                            <strong>Trusted Quality</strong>
                        </div>
                    </div>
                    <div class="feature-item d-flex align-items-center gap-2">
                        <i class="bi bi-tags fs-4"></i>
                        <div>
                            <strong>Best Prices</strong>
                        </div>
                    </div>
                    <div class="feature-item d-flex align-items-center gap-2">
                        <i class="bi bi-truck fs-4"></i>
                        <div>
                            <strong>Fast Delivery</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT IMAGE / FLOATING PRODUCTS -->
            <div class="col-lg-6 position-relative d-none d-lg-block">
                <img src="assets/image/cart_image-removebg-preview.png" 
                     alt="Hero Banner" 
                     class="img-fluid floating-products"
                     style="max-height: 520px; object-fit: contain;">
            </div>
        </div>
    </div>
</section>

<!-- SHOP BY CATEGORIES -->
<section class="categories-section py-5 bg-light">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <h2>Shop By Categories</h2>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card h-100">
                    <img src="assets/image/fashion-removebg-preview.png" class="img-fluid mb-3" alt="Fashion">
                    <h6 class="fw-semibold">Fashion</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card h-100">
                    <img src="assets/image/s26_ultra-removebg-preview.png" class="img-fluid mb-3" alt="Electronics">
                    <h6 class="fw-semibold">Electronics</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card h-100">
                    <img src="assets/image/chair_and_lamp-removebg-preview.png" class="img-fluid mb-3" alt="Home & Living">
                    <h6 class="fw-semibold">Home & Living</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card h-100">
                    <img src="assets/image/bag_and_groceries-removebg-preview.png" class="img-fluid mb-3" alt="Groceries">
                    <h6 class="fw-semibold">Groceries</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card h-100">
                    <img src="assets/image/perfume_and_lipstick-removebg-preview.png"class="img-fluid mb-3" alt="Beauty">
                    <h6 class="fw-semibold">Beauty</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card h-100">
                    <img src="assets/image/dumbell_and_football-removebg-preview.png" class="img-fluid mb-3" alt="Sports">
                    <h6 class="fw-semibold">Sports</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="featured-products py-5">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <h2>Featured Products</h2>
        </div>
        
        <div class="row g-4">
            <!-- Product 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="product-card">
                    <div class="product-image p-4 text-center bg-light">
                        <img src="/SHOP360/assets/image/watch.png" class="img-fluid" alt="Smart Watch" style="height: 180px; object-fit: contain;">
                    </div>
                    <div class="product-details p-4">
                        <h5 class="fw-semibold">Smart Watch Series 9</h5>
                        <p class="text-danger fw-bold fs-4 mb-1">$199.99</p>
                        <div class="text-warning">
                            ★★★★★
                        </div>
                        <button class="btn add-cart-btn text-white w-100 mt-3 py-2">
                            <i class="bi bi-cart-plus"></i> Add To Cart
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="product-card">
                    <div class="product-image p-4 text-center bg-light">
                        <img src="/SHOP360/assets/image/shoe.png" class="img-fluid" alt="Sneakers" style="height: 180px; object-fit: contain;">
                    </div>
                    <div class="product-details p-4">
                        <h5 class="fw-semibold">Men's White Sneakers</h5>
                        <p class="text-danger fw-bold fs-4 mb-1">$79.99</p>
                        <div class="text-warning">
                            ★★★★★
                        </div>
                        <button class="btn add-cart-btn text-white w-100 mt-3 py-2">
                            <i class="bi bi-cart-plus"></i> Add To Cart
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="product-card">
                    <div class="product-image p-4 text-center bg-light">
                        <img src="/SHOP360/assets/image/headphone.png" class="img-fluid" alt="Headphones" style="height: 180px; object-fit: contain;">
                    </div>
                    <div class="product-details p-4">
                        <h5 class="fw-semibold">Wireless Headphones</h5>
                        <p class="text-danger fw-bold fs-4 mb-1">$129.99</p>
                        <div class="text-warning">
                            ★★★★★
                        </div>
                        <button class="btn add-cart-btn text-white w-100 mt-3 py-2">
                            <i class="bi bi-cart-plus"></i> Add To Cart
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="product-card">
                    <div class="product-image p-4 text-center bg-light">
                        <img src="/SHOP360/assets/image/bag.png" class="img-fluid" alt="Backpack" style="height: 180px; object-fit: contain;">
                    </div>
                    <div class="product-details p-4">
                        <h5 class="fw-semibold">Travel Backpack</h5>
                        <p class="text-danger fw-bold fs-4 mb-1">$49.99</p>
                        <div class="text-warning">
                            ★★★★★
                        </div>
                        <button class="btn add-cart-btn text-white w-100 mt-3 py-2">
                            <i class="bi bi-cart-plus"></i> Add To Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="services-section py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-box">
                    <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 mb-2">Trusted Quality</h5>
                    <p class="text-muted">We ensure the best quality products for you.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <i class="bi bi-tags text-primary" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 mb-2">Best Prices</h5>
                    <p class="text-muted">Get the best deals everyday.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <i class="bi bi-truck text-primary" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 mb-2">Fast Delivery</h5>
                    <p class="text-muted">Reliable delivery to your doorstep.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include "includes/footer.php"; ?>
</body>
</html>