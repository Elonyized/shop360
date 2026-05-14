<?php
// Classes/admin.php

class Admin {
    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Dashboard Statistics
    public function getDashboardStats() {
        return [
            'total_products'  => $this->pdo->query("SELECT COUNT(*) FROM products")->fetchColumn(),
            'total_orders'    => $this->pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn(),
            'total_customers' => $this->pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn(),
            'pending_orders'  => $this->pdo->query("SELECT COUNT(*) FROM orders WHERE LOWER(status) = 'pending'")->fetchColumn(),
        ];
    }

    // Get All Products
    public function getAllProducts() {
        $stmt = $this->pdo->query("SELECT * FROM products ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete Product
    public function deleteProduct($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // You can add more methods here later (getAllOrders, getAllCustomers, etc.)
}
?>