<?php
declare(strict_types=1);

// Simple PDO-based DB helper. Use `get_db()` to obtain a PDO instance.

// Load config
$dbConfigFile = __DIR__ . '/../config/database.php';
$config = file_exists($dbConfigFile) ? require $dbConfigFile : [];

$DRIVER = $config['driver'] ?? 'mysql';
$HOST = $config['host'] ?? '127.0.0.1';
$PORT = $config['port'] ?? '3306';
$DATABASE = $config['database'] ?? 'apartmani';
$USERNAME = $config['username'] ?? 'root';
$PASSWORD = $config['password'] ?? '';
$CHARSET = $config['charset'] ?? 'utf8mb4';

function get_db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    global $DRIVER, $HOST, $PORT, $DATABASE, $USERNAME, $PASSWORD, $CHARSET;

    if ($DRIVER === 'sqlite') {
        // $DATABASE is a path to sqlite file
        $dsn = 'sqlite:' . $DATABASE;
        $user = null;
        $pass = null;
    } else {
        $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', $DRIVER, $HOST, $PORT, $DATABASE, $CHARSET);
        $user = $USERNAME;
        $pass = $PASSWORD;
    }

    try {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        error_log('Database connection failed: ' . $e->getMessage());
        throw $e;
    }
}

function db_fetch_all(string $sql, array $params = []): array
{
    $stmt = get_db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function db_fetch_one(string $sql, array $params = []): ?array
{
    $stmt = get_db()->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch();
    return $row === false ? null : $row;
}

function db_execute(string $sql, array $params = []): bool
{
    $stmt = get_db()->prepare($sql);
    return $stmt->execute($params);
}
