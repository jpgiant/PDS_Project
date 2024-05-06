<?php
$host = 'localhost';
$dbname = 'PDS_Project';
$username = 'postgres';
$password = '12345';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // You can return $pdo here if you want to reuse the connection object in other files
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
