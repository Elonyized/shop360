<?php
// ============================================================
// FILE LOCATION: admin/login.php
// PURPOSE: Admin login form — posts to process/process_admin_login.php
// NOTE: No DB queries here — just the form
// ============================================================

session_start();

// If already logged in as admin, skip login page
if (!empty($_SESSION['is_admin'])) {
    header("Location: dashboard.php");
    exit;
}

// Grab error message if login failed
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
// ↑ Clear it immediately so it doesn't show twice
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinity Mart — Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- ============================================================
         CSS → ADD THIS BLOCK TO: css/style.css
         under the comment:  /* === ADMIN LOGIN PAGE === */
         ============================================================ -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* ── PASTE INTO css/style.css under === ADMIN LOGIN === ── */
        :root {
            --tm-purple:      #6C3CE1;
            --tm-purple-dark: #4C1D95;
            --tm-purple-soft: #EDE9FE;
            --tm-orange:      #F97316;
            --tm-white:       #FFFFFF;
            --tm-gray-50:     #F9FAFB;
            --tm-gray-100:    #F3F4F6;
            --tm-gray-500:    #6B7280;
            --tm-gray-900:    #111827;
            --tm-font:        'Plus Jakarta Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body.admin-login-body {
            font-family: var(--tm-font);
            background: linear-gradient(135deg, var(--tm-purple-dark) 0%, var(--tm-purple) 60%, #9333EA 100%);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .login-card {
            background: var(--tm-white);
            border-radius: 20px;
            padding: 48px 44px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 24px 80px rgba(0,0,0,.25);
        }

        /* Brand at top */
        .login-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        .login-brand-icon {
            width: 48px; height: 48px;
            background: var(--tm-orange);
            border-radius: 14px;
            display: grid; place-items: center;
            font-weight: 800; font-size: 16px;
            color: #fff;
            box-shadow: 0 4px 14px rgba(249,115,22,.40);
            letter-spacing: -1px;
        }

        .login-brand-text strong {
            display: block;
            font-size: 18px; font-weight: 800;
            color: var(--tm-gray-900);
        }

        .login-brand-text span {
            font-size: 12px;
            color: var(--tm-gray-500);
        }

        .login-title {
            font-size: 24px; font-weight: 800;
            color: var(--tm-gray-900);
            margin-bottom: 6px;
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--tm-gray-500);
            margin-bottom: 32px;
        }

        /* Error box */
        .login-error {
            background: #FEE2E2;
            border: 1px solid #FECACA;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; font-weight: 600;
            color: #991B1B;
        }

        .login-error i { font-size: 15px; flex-shrink: 0; }

        /* Form fields */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px; font-weight: 600;
            color: var(--tm-gray-900);
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--tm-gray-500);
            font-size: 14px;
            pointer-events: none;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px 13px 40px;
            border: 1.5px solid var(--tm-gray-100);
            border-radius: 10px;
            font-family: var(--tm-font);
            font-size: 14px;
            color: var(--tm-gray-900);
            background: var(--tm-gray-50);
            transition: border-color .2s, background .2s;
            outline: none;
        }

        .form-group input:focus {
            border-color: var(--tm-purple);
            background: var(--tm-white);
            box-shadow: 0 0 0 3px rgba(108,60,225,.10);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            background: var(--tm-purple);
            color: #fff;
            border: none;
            font-family: var(--tm-font);
            font-size: 15px; font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: all .25s;
            box-shadow: 0 6px 20px rgba(108,60,225,.35);
            display: flex; align-items: center;
            justify-content: center; gap: 8px;
        }

        .btn-login:hover {
            background: var(--tm-purple-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(108,60,225,.45);
        }

        .login-back {
            text-align: center;
            margin-top: 22px;
            font-size: 13px;
            color: var(--tm-gray-500);
        }

        .login-back a {
            color: var(--tm-purple);
            font-weight: 600;
            text-decoration: none;
        }

        .login-back a:hover { text-decoration: underline; }
    </style>
</head>

<body class="admin-login-body">

    <div class="login-card">

        <!-- Brand -->
        <div class="login-brand">
            <div class="login-brand-icon">TM</div>
            <div class="login-brand-text">
                <strong>Trinity Mart</strong>
                <span>Admin Panel</span>
            </div>
        </div>

        <h1 class="login-title">Welcome back</h1>
        <p class="login-subtitle">Sign in to manage your store</p>

        <!-- Error message (from failed login attempt) -->
        <?php if ($error): ?>
        <div class="login-error">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <!-- ══════════════════════════════════════════════════
             LOGIN FORM
             ACTION → posts to processes/admin_login.php
             FIELDS:
               email    → matches accounts.email ✅
               password → matched against accounts.password ✅
             ══════════════════════════════════════════════════ -->
        <form method="POST" action="processes/admin_login_process.php">

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="admin@trinitymart.com"
                        required
                        autocomplete="email"
                    >
                    <!-- ↑ name="email" → goes to $_POST['email']
                             → matched against accounts.email ✅ -->
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >
                    <!-- ↑ name="password" → goes to $_POST['password']
                             → verified against accounts.password hash ✅ -->
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Sign In to Admin
            </button>

        </form>

        <div class="login-back">
            <a href="../index.php">← Back to Trinity Mart</a>
        </div>

    </div>

</body>
</html>