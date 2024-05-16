<?php

// Set connection parameters
$host = 'localhost';
$dbname = 'PDS_Project';
$username = 'postgres';
$password = '12345';

try {
    // Create a new PDO instance
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Additional configuration options if needed
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Optional: Set character encoding if needed
    // $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
