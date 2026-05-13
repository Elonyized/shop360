<?php
// Classes/Customer.php

class Customer {
    
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Get Profile with Email from accounts table
    public function getProfile($account_id) {
        $sql = "SELECT c.*, a.email 
                FROM customers c 
                LEFT JOIN accounts a ON c.account_id = a.id 
                WHERE c.account_id = ? LIMIT 1";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$account_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Save or Update Profile
    public function saveProfile($account_id, $data) {
        $sql = "INSERT INTO customers 
                (account_id, first_name, last_name, phone, address, city, state)
                VALUES (?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    first_name = VALUES(first_name),
                    last_name = VALUES(last_name),
                    phone = VALUES(phone),
                    address = VALUES(address),
                    city = VALUES(city),
                    state = VALUES(state)";

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
?>