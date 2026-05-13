<?php
// FILE LOCATION: process/admin_login_process.php

session_start();
require_once '../config/db_connect.php';
require_once '../Classes/Account.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $account = new Account();
    $result  = $account->adminLogin($pdo, $email, $password);

    if ($result) {
        // Login success — store in session
        $_SESSION['admin_id']    = $result['id'];       // accounts.id
        $_SESSION['admin_email'] = $result['email'];    // accounts.email
        $_SESSION['is_admin']    = true;
        header("Location: ../admin_dashboard.php");
        exit;

    } else {
        // Login failed — send error back to login page
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: ../admin_login.php");
        exit;
    }
}
?>