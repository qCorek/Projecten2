<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'st1738846965';      // ⚠️ CHECK DIT IN phpMyAdmin
$user = 'st1738846965';
$pass = 'cuWi9Nkl36sPlBs';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database connectie mislukt',
        'detail' => $e->getMessage()
    ]);
    exit;
}
