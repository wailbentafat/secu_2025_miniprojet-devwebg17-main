<?php
$host = "localhost";
$user = "root";
$database = "db";
$password = "";
$dsn = "mysql:host=$host;dbname=$database";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $password, $options);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


    ?>

