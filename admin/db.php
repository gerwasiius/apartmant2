<?php
declare(strict_types=1);

// Admin DB connection using same credentials as main app but a separate DB name
$config = require __DIR__ . '/../config/database.php';

$host = $config['host'] ?? '127.0.0.1';
$port = $config['port'] ?? '3306';
$user = $config['username'] ?? '';
$pass = $config['password'] ?? '';
$charset = $config['charset'] ?? 'utf8mb4';
$driver = $config['driver'] ?? 'mysql';

// Name of the admin database (created by migration)
$adminDb = $config['admin_database'] ?? 'apartmani_admin';

try {
    $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', $driver, $host, $port, $adminDb, $charset);
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Admin DB connection error';
    exit;
}

function getAdminPDO(): PDO
{
    global $pdo;
    return $pdo;
}
