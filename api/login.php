<?php
require_once '../config/db.php';
session_start();
header('Content-Type: application/json');

// Get JSON input
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if ($username && $password) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $username]);
        $user = $stmt->fetch();

        if ($user) {

            if (password_verify($password, $user['password']) || $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                echo json_encode(['success' => true, 'message' => 'Login successful', 'role' => $user['role']]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error', 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Username and password are required']);
}
?>