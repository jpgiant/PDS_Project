<?php
$host = 'localhost';
$dbname = 'PDS_Project_2';
$username = 'postgres';
$password = 'tranquilty69';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // You can return $pdo here if you want to reuse the connection object in other files
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
