<?php


class Account {

    public function accountEmailAlreadyExists($pdo, $email){
        $sql = "SELECT * FROM accounts WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createAccount($pdo, $email, $password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO accounts(email, password) VALUES(?, ?)";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$email, $hashed_password]);
    }


    public function accountLogin($pdo, $email, $password) {

        $sql = "SELECT * FROM accounts WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $account = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$account) {
            return false;
        }

        if (password_verify($password, $account["password"])) {
            return $account;
        }

        return false;
    }

     public function adminLogin($pdo, $email, $password) {

        // ⚠️ CHANGE THIS to the email you registered in your accounts table
        $admin_email = "priestadakole@gmail.com";

        if ($email !== $admin_email) {
            return false;
        }

        $sql  = "SELECT * FROM accounts WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $account = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$account) {
            return false;
        }

        if (password_verify($password, $account["password"])) {
            return $account;
        }

        return false;
    }

    public function requireAdmin() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['admin_id']) || empty($_SESSION['is_admin'])) {
            header("Location:admin_login.php");
            exit;
        }
    }
}