<?php
// customer_profile.php

require_once 'config/db_connect.php';
require_once 'Classes/Customer.php';

$customer = new Customer();

$account_id = $_SESSION['account_id'] ?? null;

if (!$account_id) {
    $_SESSION['error'] = "Please login to access your profile.";
    header("Location: login.php");
    exit();
}

$profile = $customer->getProfile($account_id);

$message = '';
if (isset($_SESSION['success'])) {
    $message = '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $message = '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
?>

<?php include "includes/header.php"; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card profile-card p-5">

                <h2 class="text-white fw-bold mb-4 text-center">My Profile</h2>
                
                <?= $message; ?>

                <form method="POST" action="processes/customer_process.php">
                    <div class="row g-4">

                        <!-- FIRST NAME -->
                        <div class="col-md-6">
                            <label class="form-label text-light">First Name</label>
                            <input type="text" name="first_name" class="form-control" 
                                   value="<?= htmlspecialchars($profile['first_name'] ?? '') ?>">
                        </div>

                        <!-- LAST NAME -->
                        <div class="col-md-6">
                            <label class="form-label text-light">Last Name</label>
                            <input type="text" name="last_name" class="form-control" 
                                   value="<?= htmlspecialchars($profile['last_name'] ?? '') ?>">
                        </div>

                        <!-- PHONE -->
                        <div class="col-md-6">
                            <label class="form-label text-light">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" 
                                   value="<?= htmlspecialchars($profile['phone'] ?? '') ?>">
                        </div>

                        <!-- ADDRESS -->
                        <div class="col-12">
                            <label class="form-label text-light">Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
                        </div>

                        <!-- CITY -->
                        <div class="col-md-6">
                            <label class="form-label text-light">City</label>
                            <input type="text" name="city" class="form-control" 
                                   value="<?= htmlspecialchars($profile['city'] ?? '') ?>">
                        </div>

                        <!-- STATE -->
                        <div class="col-md-6">
                            <label class="form-label text-light">State</label>
                            <input type="text" name="state" class="form-control" 
                                   value="<?= htmlspecialchars($profile['state'] ?? '') ?>">
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>