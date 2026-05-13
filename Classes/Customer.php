<?php
// Classes/Customer.php

class Customer {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    /**
     * Get customer profile by account_id
     */
    public function getProfile($account_id) {
        $sql = "SELECT * FROM customers WHERE account_id = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$account_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Save or Update customer profile
     */
    public function saveProfile($account_id, $data) {
        // Check if profile already exists
        $existing = $this->getProfile($account_id);

        if ($existing) {
            // UPDATE
            $sql = "UPDATE customers 
                    SET first_name = ?, last_name = ?, phone = ?, 
                        address = ?, city = ?, state = ?, 
                        updated_at = NOW() 
                    WHERE account_id = ?";
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
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
                    (account_id, first_name, last_name, phone, address, city, state, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $account_id,
                $data['first_name'],
                $data['last_name'],
                $data['phone'],
                $data['address'],
                $data['city'],
                $data['state']
            ]);
        }
    }
}
?>