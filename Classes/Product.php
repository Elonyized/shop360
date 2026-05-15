<?php
// Classes/Product.php

class Product {
    
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Get All Products - Fixed for your table
    public function getAllProducts() {
        $sql = "SELECT * FROM products ORDER BY id ASC";   // Using id instead of created_at
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single product
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all images for a product
    public function getProductImages($product_id) {
        $sql = "SELECT * FROM product_images 
                WHERE product_id = ? 
                ORDER BY is_featured DESC, id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get featured image
    public function getFeaturedImage($product_id) {
        $sql = "SELECT image_path FROM product_images 
                WHERE product_id = ? AND is_featured = 1 
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['image_path'] : null;
    }
}
?>