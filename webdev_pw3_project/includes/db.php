<?php
require_once __DIR__ . '/../classes/Database.php';

try {
    $database = new Database();
    $pdo = $database->connect();
} catch (PDOException $e) {
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}
