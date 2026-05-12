<?php
session_start();

require_once "../config/db_connect.php";
require_once "../Classes/Account.php";
require_once "../Classes/Validation.php";
 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $validation = new validation();

    $email_error = $validation::validateEmail($email);
    $password_error = $validation::validatePassword($password, $confirm_password);
    $password_strength_error = $validation::validatepasswordStrength($password);

    if($email_error) {
        $_SESSION['error'] = "Invalid email format";
        header("Location: ../register.php");
        exit();
    }

     if ($password_error) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: ../register.php");
        exit();
    }

     if ($password_strength_error) {
        $_SESSION['error'] = "Password must be at least 8 characters long";
        header("Location: ../register.php");
        exit();
    }

    $account = new Account();

        $accountEmailAlreadyExists = $account->accountEmailAlreadyExists($pdo, $email);

        if($accountEmailAlreadyExists) {
            $_SESSION["error"] = "Email already registered";
            header("Location: ../register.php");
            exit();
        }

        $createAccount = $account->createAccount($pdo, $email, $password);

        if($createAccount) {
            $_SESSION["success"] = "Registration successful! Please log in.";
            header("Location: ../login.php");
            exit();
        }

        else {
            $_SESSION["error"] = "Failed to create account. Please try again.";
            header("Location: ../register.php");
            exit();
        }
}

   
