<?php
// Classes/Order.php

class Order {
    
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getTotalRevenue() {
        $sql = "SELECT SUM(total_amount) as total FROM orders WHERE status = 'Delivered'";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getTotalOrders() {
        $sql = "SELECT COUNT(*) as total FROM orders";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getPendingOrdersCount() {
        $sql = "SELECT COUNT(*) as total FROM orders WHERE status = 'Pending'";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getRecentOrders($limit = 5) {
        $sql = "SELECT o.*, a.username as customer_name, p.product_name 
                FROM orders o 
                LEFT JOIN accounts a ON o.account_id = a.id 
                LEFT JOIN products p ON o.product_id = p.id 
                ORDER BY o.order_date DESC LIMIT ?";
        $stmt = $this->pdo->prepare($sql);
        // $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>