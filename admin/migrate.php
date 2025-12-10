#!/usr/bin/env php
<?php
/**
 * CLI script to run admin database migration
 * Usage: php admin/migrate.php
 */

declare(strict_types=1);

$config = require __DIR__ . '/../config/database.php';

$host = $config['host'] ?? '127.0.0.1';
$port = $config['port'] ?? '3306';
$user = $config['username'] ?? '';
$pass = $config['password'] ?? '';
$charset = $config['charset'] ?? 'utf8mb4';

// Read migration SQL
$migrationFile = __DIR__ . '/../migrations/003_create_admin_schema.sql';
if (!file_exists($migrationFile)) {
    echo "ERROR: Migration file not found: $migrationFile\n";
    exit(1);
}

$sql = file_get_contents($migrationFile);

try {
    // Connect without selecting database (to allow CREATE/DROP DATABASE)
    $dsn = sprintf('mysql:host=%s;port=%s;charset=%s', $host, $port, $charset);
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    echo "Running migration...\n";

    // Split statements by semicolon and execute
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            $pdo->exec($stmt);
            echo ".";
        }
    }

    echo "\n✓ Migration completed successfully!\n";
    echo "\nVerifying tables...\n";

    // Verify tables exist
    $pdo->exec("USE `apartmani_admin`");
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        echo "✓ Table: $table\n";
    }

    echo "\n✓ Admin database setup complete!\n";
    echo "\nNext steps:\n";
    echo "1. Run: php admin/setup.php (to create first admin user)\n";
    echo "2. Visit: http://localhost:8000/admin/login.php\n";

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
