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
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$data['id']]);

    echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>