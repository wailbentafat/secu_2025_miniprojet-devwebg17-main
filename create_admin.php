<?php
require_once 'config/db.php';

try {
    // Delete existing admin users
    $pdo->exec("DELETE FROM users WHERE username = 'admin_user' OR username = 'admin'");

    // Create new admin user
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute(['admin', 'admin@nexstore.com', $password, 'admin']);

    echo "✅ Admin user created successfully!<br><br>";
    echo "<strong>Login Credentials:</strong><br>";
    echo "Username: <code>admin</code><br>";
    echo "Password: <code>admin123</code><br><br>";
    echo "<a href='login.php'>Go to Login</a>";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>