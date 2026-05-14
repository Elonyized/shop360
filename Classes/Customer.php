<?php
// Classes/Customer.php

class Customer {
    
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getProfile($account_id) {
        $sql = "SELECT c.*, a.email 
                FROM customers c 
                LEFT JOIN accounts a ON c.account_id = a.id 
                WHERE c.account_id = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$account_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveProfile($account_id, $data) {
        try {
            $existing = $this->getProfile($account_id);

            if ($existing) {
                // UPDATE
                $sql = "UPDATE customers SET 
                        first_name = ?,
                        last_name = ?,
                        phone = ?,
                        address = ?,
                        city = ?,
                        state = ?
                        WHERE account_id = ?";
                
                $stmt = $this->pdo->prepare($sql);
                $success = $stmt->execute([
                    $data['first_name'],
                    $data['last_name'],
                    $data['phone'],
                    $data['address'],
                    $data['city'],
                    $data['state'],
                    $account_id
                ]);
            } else {
                // INSERT
                $sql = "INSERT INTO customers 
                        (account_id, first_name, last_name, phone, address, city, state)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = $this->pdo->prepare($sql);
                $success = $stmt->execute([
                    $account_id,
                    $data['first_name'],
                    $data['last_name'],
                    $data['phone'],
                    $data['address'],
                    $data['city'],
                    $data['state']
                ]);
            }

            return $success;

        } catch (PDOException $e) {
            // Show the real error to user
            $_SESSION['error'] = "Database Error: " . $e->getMessage();
            error_log("Customer Save Error: " . $e->getMessage());
            return false;
        }
    }
}
?>