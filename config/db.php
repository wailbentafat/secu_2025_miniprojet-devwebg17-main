<?php

$host = "127.0.0.1";   // localhost or 127.0.0.1 works from host
$user = "user";         // matches MYSQL_USER
$password = "password"; // matches MYSQL_PASSWORD
$database = "db";

$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
    $check = $pdo->query("SHOW TABLES LIKE 'users'")->fetch();
    if (!$check) {
        $sql = file_get_contents(__DIR__ . '/../sql/schema.sql');
        if ($sql === false) {
            throw new Exception("Cannot read schema.sql");
        }
        $pdo->exec($sql);
        echo "Database schema applied successfully.";
    }

} catch (Throwable $e) {
    die("Database error: " . $e->getMessage());
}
