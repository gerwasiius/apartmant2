<?php
declare(strict_types=1);

/**
 * Admin setup script — initialize database and create first admin user.
 * Run this once: php admin/setup.php
 * Then DELETE or RENAME this file for security.
 */

require_once __DIR__ . '/db.php';

echo "=== Admin Database Setup ===\n\n";

// Step 1: Try to run migration SQL
$migrationFile = __DIR__ . '/../migrations/003_create_admin_schema.sql';
if (!file_exists($migrationFile)) {
    echo "ERROR: Migration file not found: $migrationFile\n";
    exit(1);
}

echo "[1/3] Running migration...\n";
$sql = file_get_contents($migrationFile);

try {
    // Connect to MySQL root/default to allow DROP DATABASE
    $config = require __DIR__ . '/../config/database.php';
    $host = $config['host'] ?? '127.0.0.1';
    $port = $config['port'] ?? '3306';
    $user = $config['username'] ?? '';
    $pass = $config['password'] ?? '';
    $charset = $config['charset'] ?? 'utf8mb4';

    $dsn = sprintf('mysql:host=%s;port=%s;charset=%s', $host, $port, $charset);
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // Split and execute each statement
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            $conn->exec($stmt);
        }
    }

    echo "✓ Migration completed successfully\n\n";
} catch (Exception $e) {
    echo "ERROR: Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 2: Create first admin user
echo "[2/3] Creating first admin user...\n";

$email = readline("Enter admin email: ");
$password = readline("Enter admin password: ");
$passwordConfirm = readline("Confirm password: ");

if (empty($email) || empty($password)) {
    echo "ERROR: Email and password are required\n";
    exit(1);
}

if ($password !== $passwordConfirm) {
    echo "ERROR: Passwords do not match\n";
    exit(1);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "ERROR: Invalid email format\n";
    exit(1);
}

if (strlen($password) < 6) {
    echo "ERROR: Password must be at least 6 characters\n";
    exit(1);
}

try {
    $pdo = getAdminPDO();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO admin_users (email, password) VALUES (?, ?)');
    $stmt->execute([$email, $hash]);
    $userId = $pdo->lastInsertId();
    echo "✓ Admin user created: ID=$userId, Email=$email\n\n";
} catch (PDOException $e) {
    echo "ERROR: Could not create admin user: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 3: Verify
echo "[3/3] Verifying...\n";
try {
    $stmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM admin_users');
    $stmt->execute();
    $row = $stmt->fetch();
    echo "✓ Total admin users: " . $row['cnt'] . "\n";

    $stmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM admin_audit');
    $stmt->execute();
    $row = $stmt->fetch();
    echo "✓ Audit log entries: " . $row['cnt'] . "\n\n";

    echo "=== Setup Complete ===\n";
    echo "Now you can:\n";
    echo "1. Delete or rename this file (admin/setup.php) for security\n";
    echo "2. Visit admin/login.php to log in\n";
    echo "3. Delete or protect admin/register.php\n";

} catch (Exception $e) {
    echo "ERROR: Verification failed: " . $e->getMessage() . "\n";
    exit(1);
}
