<?php
session_start();
require_once '../config/db.php';
header('Content-Type: application/json');

// Check admin authentication
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

try {
    $stmt = $pdo->prepare("INSERT INTO items (name, description, price, image_url, category_id, stock) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['name'],
        $data['description'],
        $data['price'],
        $data['image_url'],
        $data['category_id'],
        $data['stock']
    ]);

    echo json_encode(['success' => true, 'message' => 'Product added successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>