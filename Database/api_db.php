<?php
// Database connection file (Database/db.php)

$host = 'localhost'; // Database host
$db   = 'human resource management system'; // Database name
$user = 'root'; // Database user
$pass = ''; // Database password
$charset = 'utf8mb4'; // Charset

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // Data Source Name
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Initialize PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Catch any connection errors and display an appropriate message
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
