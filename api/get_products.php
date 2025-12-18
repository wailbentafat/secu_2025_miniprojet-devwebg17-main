<?php
header('Content-Type: application/json');
require_once '../config/db.php';

try {
    $sql = "SELECT items.*, categories.name as category_name 
            FROM items 
            LEFT JOIN categories ON items.category_id = categories.id";

    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll();
    echo json_encode($products);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}