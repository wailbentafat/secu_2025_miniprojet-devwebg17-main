<?php
session_start();
require_once '../config/db.php';
header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['items']) || empty($data['items'])) {
    echo json_encode(['success' => false, 'message' => 'No items in cart']);
    exit();
}

try {
    $pdo->beginTransaction();

    $errors = [];
    $updates = [];

    // First, validate all items have sufficient stock
    foreach ($data['items'] as $item) {
        $stmt = $pdo->prepare("SELECT stock, name FROM items WHERE id = ?");
        $stmt->execute([$item['id']]);
        $product = $stmt->fetch();

        if (!$product) {
            $errors[] = "Product ID {$item['id']} not found";
            continue;
        }

        if ($product['stock'] < $item['quantity']) {
            $errors[] = "{$product['name']}: Only {$product['stock']} in stock (requested {$item['quantity']})";
        } else {
            $updates[] = [
                'id' => $item['id'],
                'quantity' => $item['quantity'],
                'name' => $product['name']
            ];
        }
    }

    // If there are any errors, rollback and return them
    if (!empty($errors)) {
        $pdo->rollBack();
        echo json_encode([
            'success' => false,
            'message' => 'Insufficient stock',
            'errors' => $errors
        ]);
        exit();
    }

    // All validations passed, update stock
    foreach ($updates as $update) {
        $stmt = $pdo->prepare("UPDATE items SET stock = stock - ? WHERE id = ?");
        $stmt->execute([$update['quantity'], $update['id']]);
    }

    // If user is logged in, save order to database (optional enhancement)
    if (isset($_SESSION['user_id'])) {
        // You could create an orders table and save the order here
        // For now, we'll just reduce stock
    }

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Order placed successfully! Stock has been updated.',
        'items_processed' => count($updates)
    ]);

} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>