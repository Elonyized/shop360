<?php
// Classes/Order.php

class Order {
    
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // ====================== ADMIN METHODS ======================
    
    public function getTotalRevenue() {
        $sql = "SELECT SUM(total_amount) as total FROM orders WHERE LOWER(status) = 'delivered'";
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
        $sql = "SELECT COUNT(*) as total FROM orders WHERE LOWER(status) = 'pending'";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getRecentOrders($limit = 5) {
        $sql = "SELECT o.*, p.product_name, 
                       CONCAT(c.`first name`, ' ', c.`last name`) as customer_name 
                FROM orders o 
                LEFT JOIN products p ON o.product_id = p.id 
                LEFT JOIN customers c ON o.customer_id = c.id 
                ORDER BY o.created_at DESC LIMIT ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrderStatus($order_id, $status) {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$status, $order_id]);
    }

    // ====================== CUSTOMER METHODS ======================

    public function getCustomerOrders($customer_id) {
        $sql = "SELECT o.*, p.product_name, p.product_price 
                FROM orders o 
                LEFT JOIN products p ON o.product_id = p.id 
                WHERE o.account_id = ? 
                ORDER BY o.created_at DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Main Place Order Method (with Stock Reduction)
    public function placeOrder($customer_id, $product_id, $quantity, $total_amount, $shipping_address, $payment_type) {
        
        $this->pdo->beginTransaction();
        
        try {
            // Check stock availability
            $stmt = $this->pdo->prepare("SELECT in_stock FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $current_stock = $stmt->fetchColumn();

            if ($current_stock < $quantity) {
                $this->pdo->rollBack();
                return false; // Not enough stock
            }

            // Insert the order
            $sql = "INSERT INTO orders 
                    (customer_id, product_id, quantity, total_amount, shipping_address, payment_type, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$customer_id, $product_id, $quantity, $total_amount, $shipping_address, $payment_type]);

            // Reduce stock
            $new_stock = $current_stock - $quantity;
            $stmt = $this->pdo->prepare("UPDATE products SET in_stock = ? WHERE id = ?");
            $stmt->execute([$new_stock, $product_id]);

            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
    
}
?>