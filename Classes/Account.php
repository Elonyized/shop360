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
}