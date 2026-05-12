<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Trinity Mart - Create Account</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #2d006e;">


<div class="bg-dark text-white text-center py-2">
    <small>Welcome to TrinityMart — Shop Smart, Live Better</small>
</div>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card border-0 shadow-lg rounded-4 w-100" style="max-width: 450px;">

        
        <div class="card-header bg-white text-center border-0 pt-4">

            <h3 class="fw-bold text-purple mb-1" style="color:#4b0082;">
                Create Account
            </h3>

            <p class="text-muted small mb-0">
                Join TrinityMart today
            </p>

        </div>

        <div class="card-body p-4">

            
            <?php
            if(isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger text-center'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            }
            ?>

            
            <form action="processes/register_process.php" method="POST">

                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter your email">
                </div>

                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Create password">
                </div>

                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                </div>

                
                <div class="d-grid">
                    <button type="submit" class="btn btn-lg fw-semibold text-white"
                        style="background-color:#d35400;">
                        Create Account
                    </button>
                </div>

            </form>

        </div>

        <!-- FOOTER -->
        <div class="card-footer text-center bg-white border-0 pb-4">

            <small class="text-muted">
                Already have an account?
                <a href="login.php" class="text-decoration-none fw-semibold" style="color:#4b0082;">
                    Login
                </a>
            </small>

        </div>

    </div>

</div>

</body>
</html>