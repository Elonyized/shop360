<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Trinity Mart - Customer Profile</title>

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONT -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

</head>

<!-- BODY -->

<body
style="
background:
linear-gradient(
135deg,
#140021,
#240046,
#3C096C,
#10002B
);
min-height:100vh;
overflow-x:hidden;
font-family:'Poppins',sans-serif;
">

<div class="container-fluid py-4">

    <div class="row g-4 min-vh-100">

        <!-- SIDEBAR -->

        <div class="col-lg-2">

            <div class="card
            border-0
            rounded-4
            h-100"
            style="
            background:rgba(255,255,255,0.05);
            backdrop-filter:blur(15px);
            box-shadow:0 0 30px rgba(142,45,226,0.2);
            ">

                <div class="card-body p-4">

                    <!-- LOGO -->

                    <div class="text-center mb-4">

                        <div
                        class="rounded-circle
                        d-inline-flex
                        justify-content-center
                        align-items-center"
                        style="
                        width:70px;
                        height:70px;
                        background:#8E2DE2;
                        ">

                            <i class="bi bi-bag-fill
                            text-white fs-2"></i>

                        </div>

                        <h3 class="text-white fw-bold mt-3">

                            Trinity Mart

                        </h3>

                    </div>

                    <!-- USER PROFILE -->

                    <div class="text-center mb-5">

                        <img src="https://via.placeholder.com/100"
                        class="rounded-circle border border-3"
                        width="100"
                        height="100"
                        style="
                        object-fit:cover;
                        border-color:#C77DFF !important;
                        ">

                        <h5 class="text-white fw-bold mt-3 mb-1">

                            John Doe

                        </h5>

                        <small style="color:#C77DFF;">

                            Premium Member

                        </small>

                    </div>

                    <!-- NAVIGATION -->

                    <ul class="nav flex-column gap-3">

                        <!-- DASHBOARD -->

                        <li>

                            <a href="#"
                            class="btn
                            rounded-4
                            w-100
                            text-start
                            py-3
                            fw-bold
                            text-white"
                            style="
                            background:#8E2DE2;
                            transition:0.3s ease;
                            "
                            onmouseover="this.style.transform='translateX(5px)'"
                            onmouseout="this.style.transform='translateX(0px)'">

                                <i class="bi bi-grid-fill me-2"></i>

                                Dashboard

                            </a>

                        </li>

                        <!-- PROFILE -->

                        <li>

                            <a href="#"
                            class="btn text-white
                            rounded-4
                            w-100
                            text-start
                            py-3"
                            style="
                            background:rgba(255,255,255,0.03);
                            transition:0.3s ease;
                            "
                            onmouseover="this.style.transform='translateX(5px)'"
                            onmouseout="this.style.transform='translateX(0px)'">

                                <i class="bi bi-person-fill me-2"
                                style="color:#C77DFF;"></i>

                                Profile

                            </a>

                        </li>

                        <!-- ORDERS -->

                        <li>

                            <a href="#"
                            class="btn text-white
                            rounded-4
                            w-100
                            text-start
                            py-3"
                            style="
                            background:rgba(255,255,255,0.03);
                            transition:0.3s ease;
                            "
                            onmouseover="this.style.transform='translateX(5px)'"
                            onmouseout="this.style.transform='translateX(0px)'">

                                <i class="bi bi-cart-fill me-2"
                                style="color:#C77DFF;"></i>

                                Orders

                            </a>

                        </li>

                        <!-- WISHLIST -->

                        <li>

                            <a href="#"
                            class="btn text-white
                            rounded-4
                            w-100
                            text-start
                            py-3"
                            style="
                            background:rgba(255,255,255,0.03);
                            transition:0.3s ease;
                            "
                            onmouseover="this.style.transform='translateX(5px)'"
                            onmouseout="this.style.transform='translateX(0px)'">

                                <i class="bi bi-heart-fill me-2"
                                style="color:#C77DFF;"></i>

                                Wishlist

                            </a>

                        </li>

                        <!-- ADDRESS -->

                        <li>

                            <a href="#"
                            class="btn text-white
                            rounded-4
                            w-100
                            text-start
                            py-3"
                            style="
                            background:rgba(255,255,255,0.03);
                            transition:0.3s ease;
                            "
                            onmouseover="this.style.transform='translateX(5px)'"
                            onmouseout="this.style.transform='translateX(0px)'">

                                <i class="bi bi-geo-alt-fill me-2"
                                style="color:#C77DFF;"></i>

                                Addresses

                            </a>

                        </li>

                        <!-- SETTINGS -->

                        <li>

                            <a href="#"
                            class="btn text-white
                            rounded-4
                            w-100
                            text-start
                            py-3"
                            style="
                            background:rgba(255,255,255,0.03);
                            transition:0.3s ease;
                            "
                            onmouseover="this.style.transform='translateX(5px)'"
                            onmouseout="this.style.transform='translateX(0px)'">

                                <i class="bi bi-gear-fill me-2"
                                style="color:#C77DFF;"></i>

                                Settings

                            </a>

                        </li>

                    </ul>

                    <!-- LOGOUT -->

                    <div class="mt-5">

                        <a href="#"
                        class="btn
                        rounded-4
                        w-100
                        py-3
                        text-white fw-bold"
                        style="
                        background:#3F0D67;
                        ">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- MAIN CONTENT -->

        <div class="col-lg-10">

            <!-- TOP NAVBAR -->

            <div class="d-flex
            justify-content-between
            align-items-center
            flex-wrap
            gap-3
            mb-4">

                <!-- SEARCH -->

                <div class="input-group"
                style="max-width:500px;">

                    <span class="input-group-text
                    bg-dark
                    border-0
                    text-white">

                        <i class="bi bi-search"></i>

                    </span>

                    <input type="text"
                    class="form-control
                    bg-dark
                    border-0
                    text-white"
                    placeholder="Search products...">

                </div>

                <!-- ICONS -->

                <div class="d-flex gap-3">

                    <button class="btn
                    rounded-circle
                    text-white"
                    style="
                    width:50px;
                    height:50px;
                    background:#240046;
                    ">

                        <i class="bi bi-bell-fill"></i>

                    </button>

                    <button class="btn
                    rounded-circle
                    text-white"
                    style="
                    width:50px;
                    height:50px;
                    background:#FF9100;
                    ">

                        <i class="bi bi-cart-fill"></i>

                    </button>

                </div>

            </div>

            <!-- HERO SECTION -->

            <div class="card border-0 rounded-4 mb-4"
            style="
            background:
            linear-gradient(
            135deg,
            #4A148C,
            #6A1B9A,
            #8E2DE2
            );
            ">

                <div class="card-body p-5">

                    <div class="row align-items-center">

                        <div class="col-lg-8">

                            <h1 class="text-white fw-bold display-5">

                                Welcome Back, John 👋

                            </h1>

                            <p class="text-light fs-5 mt-3">

                                Track orders, manage wishlist,
                                discover exclusive deals and enjoy
                                seamless shopping on Trinity Mart.

                            </p>

                            <div class="mt-4">

                                <button
                                class="btn
                                rounded-4
                                px-4
                                py-3
                                fw-bold
                                text-white"
                                style="
                                background:#240046;
                                ">

                                    Explore Store

                                </button>

                                <button
                                class="btn
                                btn-light
                                rounded-4
                                px-4
                                py-3
                                fw-bold
                                ms-2">

                                    My Orders

                                </button>

                            </div>

                        </div>

                        <div class="col-lg-4 text-center mt-4 mt-lg-0">

                            <img src="https://via.placeholder.com/180"
                            class="rounded-circle border border-3"
                            style="
                            border-color:#C77DFF !important;
                            "
                            width="180">

                        </div>

                    </div>

                </div>

            </div>

            <!-- STATS -->

            <div class="row g-4 mb-4">

                <!-- ORDERS -->

                <div class="col-lg-4">

                    <div class="card
                    border-0
                    rounded-4
                    h-100"
                    style="
                    background:rgba(255,255,255,0.05);
                    backdrop-filter:blur(15px);
                    transition:0.3s ease;
                    cursor:pointer;
                    "
                    onmouseover="
                    this.style.transform='translateY(-5px)';
                    this.style.boxShadow='0 0 25px rgba(199,125,255,0.2)';
                    "
                    onmouseout="
                    this.style.transform='translateY(0px)';
                    this.style.boxShadow='none';
                    ">

                        <div class="card-body p-4">

                            <div class="d-flex
                            justify-content-between
                            align-items-center">

                                <div>

                                    <p class="text-light mb-2">

                                        Orders

                                    </p>

                                    <h2 class="text-white fw-bold">

                                        24

                                    </h2>

                                </div>

                                <div
                                class="rounded-circle
                                d-flex
                                justify-content-center
                                align-items-center"
                                style="
                                width:60px;
                                height:60px;
                                background:#8E2DE2;
                                ">

                                    <i class="bi bi-cart-check-fill
                                    text-white fs-3"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- WISHLIST -->

                <div class="col-lg-4">

                    <div class="card
                    border-0
                    rounded-4
                    h-100"
                    style="
                    background:rgba(255,255,255,0.05);
                    backdrop-filter:blur(15px);
                    transition:0.3s ease;
                    cursor:pointer;
                    "
                    onmouseover="
                    this.style.transform='translateY(-5px)';
                    this.style.boxShadow='0 0 25px rgba(199,125,255,0.2)';
                    "
                    onmouseout="
                    this.style.transform='translateY(0px)';
                    this.style.boxShadow='none';
                    ">

                        <div class="card-body p-4">

                            <div class="d-flex
                            justify-content-between
                            align-items-center">

                                <div>

                                    <p class="text-light mb-2">

                                        Wishlist

                                    </p>

                                    <h2 class="text-white fw-bold">

                                        12

                                    </h2>

                                </div>

                                <div
                                class="rounded-circle
                                d-flex
                                justify-content-center
                                align-items-center"
                                style="
                                width:60px;
                                height:60px;
                                background:#5A189A;
                                ">

                                    <i class="bi bi-heart-fill
                                    text-white fs-3"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SPENDING -->

                <div class="col-lg-4">

                    <div class="card
                    border-0
                    rounded-4
                    h-100"
                    style="
                    background:rgba(255,255,255,0.05);
                    backdrop-filter:blur(15px);
                    transition:0.3s ease;
                    cursor:pointer;
                    "
                    onmouseover="
                    this.style.transform='translateY(-5px)';
                    this.style.boxShadow='0 0 25px rgba(199,125,255,0.2)';
                    "
                    onmouseout="
                    this.style.transform='translateY(0px)';
                    this.style.boxShadow='none';
                    ">

                        <div class="card-body p-4">

                            <div class="d-flex
                            justify-content-between
                            align-items-center">

                                <div>

                                    <p class="text-light mb-2">

                                        Spending

                                    </p>

                                    <h2 class="text-white fw-bold">

                                        ₦850K

                                    </h2>

                                </div>

                                <div
                                class="rounded-circle
                                d-flex
                                justify-content-center
                                align-items-center"
                                style="
                                width:60px;
                                height:60px;
                                background:#3C096C;
                                ">

                                    <i class="bi bi-wallet2
                                    text-white fs-3"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- QUICK ACTIONS -->

            <div class="row g-4 mb-4">

                <div class="col-lg-3">

                    <button class="btn
                    w-100
                    py-4
                    rounded-4
                    text-white fw-bold"
                    style="
                    background:#8E2DE2;
                    ">

                        <i class="bi bi-cart-plus-fill
                        fs-3 d-block mb-2"></i>

                        Shop Now

                    </button>

                </div>

                <div class="col-lg-3">

                    <button class="btn
                    w-100
                    py-4
                    rounded-4
                    text-white fw-bold"
                    style="
                    background:#5A189A;
                    ">

                        <i class="bi bi-truck
                        fs-3 d-block mb-2"></i>

                        Track Order

                    </button>

                </div>

                <div class="col-lg-3">

                    <button class="btn
                    w-100
                    py-4
                    rounded-4
                    text-white fw-bold"
                    style="
                    background:#3C096C;
                    ">

                        <i class="bi bi-headset
                        fs-3 d-block mb-2"></i>

                        Support

                    </button>

                </div>

                <div class="col-lg-3">

                    <button class="btn
                    w-100
                    py-4
                    rounded-4
                    text-dark fw-bold"
                    style="
                    background:#FF9100;
                    ">

                        <i class="bi bi-shop
                        fs-3 d-block mb-2"></i>

                        Become Vendor

                    </button>

                </div>

            </div>

            <!-- RECENT ORDERS -->

            <div class="card border-0 rounded-4"
            style="
            background:rgba(255,255,255,0.05);
            backdrop-filter:blur(15px);
            ">

                <div class="card-body p-4">

                    <h4 class="text-white fw-bold mb-4">

                        Recent Orders

                    </h4>

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>

                                <tr class="text-light">

                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Date</th>

                                </tr>

                            </thead>

                            <tbody class="text-white">

                                <tr>

                                    <td>iPhone 15 Pro</td>

                                    <td>

                                        <span class="badge bg-success">

                                            Delivered

                                        </span>

                                    </td>

                                    <td>₦1,450,000</td>

                                    <td>May 10</td>

                                </tr>

                                <tr>

                                    <td>Gaming Headset</td>

                                    <td>

                                        <span class="badge
                                        bg-warning
                                        text-dark">

                                            Shipping

                                        </span>

                                    </td>

                                    <td>₦85,000</td>

                                    <td>May 8</td>

                                </tr>

                                <tr>

                                    <td>Smart Watch</td>

                                    <td>

                                        <span class="badge bg-primary">

                                            Processing

                                        </span>

                                    </td>

                                    <td>₦120,000</td>

                                    <td>May 6</td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- BOOTSTRAP JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>