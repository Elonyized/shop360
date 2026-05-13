<?php

class Product {
    public function getALLproducts($pdo){

        $sql = "SELECT * FROM products WHERE in_stock > 0";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getProductById($pdo, $id){
        
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $products = $stmt->fetch(PDO::FETCH_ASSOC);
        return $products;
    } 
}
