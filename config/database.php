<?php

/**
 * Database Configuration
 * 
 * MySQL PDO connection configuration using environment variables
 */

// Database connection parameters
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'gestock_db';
$db_user = getenv('DB_USER') ?: 'root';
$db_password = getenv('DB_PASSWORD') ?: '';
$db_charset = getenv('DB_CHARSET') ?: 'utf8mb4';

// PDO DSN (Data Source Name)
$dsn = "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}";

// PDO Options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Create PDO connection
    $pdo = new PDO($dsn, $db_user, $db_password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

return $pdo;
