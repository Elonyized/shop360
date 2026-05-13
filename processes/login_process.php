<?php
// processes/login_process.php

session_start();

require_once '../config/db_connect.php';
require_once '../classes/Validation.php';
require_once '../classes/Account.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // VALIDATION
    $email_error = Validation::validateEmail($email);
    $password_error = Validation::validatePasswordStrength($password);

    if ($email_error) {
        $_SESSION["error"] = "Invalid email format";
        header("Location: ../login.php");
        exit();
    }

    if ($password_error) {
        $_SESSION["error"] = "Password must be at least 8 characters long";
        header("Location: ../login.php");
        exit();
    }

    // LOGIN
    $account = new Account();
    $user = $account->accountLogin($pdo, $email, $password);

    if ($user) {

        //  IMPORTANT: Set these session variables
        $_SESSION["account_id"] = $user["id"];     // Most important for profile
        $_SESSION["user_id"]    = $user["id"];
        $_SESSION["user_email"] = $user["email"];
        $_SESSION["success"]    = "Successfully logged in!";

        header("Location: ../index.php");   // or ../products.php
        exit();

    } else {

        $_SESSION["error1"] = "Invalid email or password";
        header("Location: ../login.php");
        exit();
    }
}
?>