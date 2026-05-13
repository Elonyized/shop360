<!-- ==================== HTML SECTION ==================== -->
<?php 
 require_once "config/db_connect.php";
 require_once "Classes/Customer.php";
include "includes/header.php";
?>

<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- MAIN CONTENT -->
        <div class="col-lg-10">

            <div class="card profile-card p-5">

                <h2 class="text-white fw-bold mb-4 text-glow">My Profile</h2>

                <?= $message ?? ''; ?>

                <form action="processes/customer_process.php" method="POST">
                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label text-light">First Name</label>
                            <input type="text" name="first_name" class="form-control" 
                            value="<?= htmlspecialchars($profile['first_name'] ?? '') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light">Last Name</label>
                            <input type="text" name="last_name" class="form-control" 
                            value="<?= htmlspecialchars($profile['last_name'] ?? '') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" 
                            value="<?= htmlspecialchars($profile['phone'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light">Email Address</label>
                            <input type="email" class="form-control" 
                            value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-light">Delivery Address</label>
                            <textarea name="address" class="form-control" 
                            rows="3"><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
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

                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                            <i class="bi bi-check-circle me-2"></i> Save Changes
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

<?php include "includes/footer.php";?>