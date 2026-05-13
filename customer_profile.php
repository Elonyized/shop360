<?php
// customer_profile.php

include "includes/header.php";

require_once 'config/db_connect.php';
require_once 'Classes/Customer.php';

$customer = new Customer();

$account_id = $_SESSION['account_id'] ?? $_SESSION['user_id'] ?? $_SESSION['id'] ?? null;

if (!$account_id) {
    $_SESSION['error'] = "Please login to access your profile.";
    header("Location: login.php");
    exit();
}

// Get profile data
$profile = $customer->getProfile($account_id);

$message = '';

// Show messages

if (isset($_SESSION['error'])) {
    $message = '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
?>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card profile-card p-5">

                <h2 class="text-white fw-bold mb-4 text-center">My Profile</h2>
                
                <?= $message; ?>

                <form method="POST" action="processes/customer_process.php">
                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label text-light">First Name</label>
                            <input type="text" name="first_name" class="form-control" 
                                   value="<?= htmlspecialchars($profile['first_name'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light">Last Name</label>
                            <input type="text" name="last_name" class="form-control" 
                                   value="<?= htmlspecialchars($profile['last_name'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" 
                                   value="<?= htmlspecialchars($profile['phone'] ?? '') ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label text-light">Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light">City</label>
                            <input type="text" name="city" class="form-control" 
                                   value="<?= htmlspecialchars($profile['city'] ?? '') ?>">
                        </div>

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
                    <div class="login-back">
                        <a href="../index.php">← Back to Trinity Mart</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>