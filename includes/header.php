<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinity Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/SHOP360/assets/css/styles.css">


</head>
<body>

    <!-- TOP HEADER -->
    <section class="top-header">
        <div class="container">
            <div class="top-header-wrapper">

                <!-- LEFT -->
                <div class="top-header-text">
                    <p><i class="bi bi-cart3"></i> Welcome to Trinity Mart</p>
                </div>

                <!-- RIGHT -->
                <div class="top-header-links">
                    <a href="#"><i class="bi bi-truck"></i>Track Order</a>

                    <a href="login.php"><i class="bi bi-box-arrow-in-right"></i>Login</a>

                    <a href="register.php"><i class="bi bi-person-plus"></i>Register</a>
                </div>
            </div>
        </div>
    </section>

    <!-- MAIN NAVBAR -->
    <header class="main-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-lg">

                <!-- LOGO -->
                <a href="index.php" class="logo">
                    <div class="logo-icon">
                        <img src="/SHOP360/assets/image/logo.png" alt="Trinity Mart Logo">
                    </div>

                    <div class="logo-text">
                        <h2>Trinity<span>Mart</span></h2>
                        <h6>Everything you need in one place</h6>
                    </div>
                </a>

                <!-- MOBILE TOGGLE -->
                <button 
                    class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMenu"><i class="bi bi-list"></i>
                </button>

                <!-- NAVBAR CONTENT -->
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <!-- SEARCH BAR -->
                    <form class="search-form">
                        <div class="search-box">
                            <input type="search" placeholder="Search products...">

                            <button type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>

                    <!-- NAV LINKS -->
                    <ul class="nav-links">
                        <li>
                            <a href="#"><i class="bi bi-heart"></i><h6>Wishlist</h6></a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-cart3"></i><h6>Cart</h6></a>
                        </li>
                        <li>
                            <a href="customer_profile.php"><i class="bi bi-person-circle"></i><h6>Profile</h6></a>
                        </li>

                        <li>
                            <a href><i class="bi bi-bell-fill"></i>
                            <h6>Notifications</h6>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- CATEGORY BAR -->
    <section class="category-bar">
        <div class="container">
            <div class="category-wrapper">
                <a href="#">Fashion</a>
                <a href="#">Electronics</a>
                <a href="#">Groceries</a>
                <a href="#">Beauty</a>
                <a href="#">Sports</a>
                <a href="#">Home & Living</a>
            </div>
        </div>
    </section>


