<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/db.php';

// Rate limit / lockout settings (tweak as needed)
if (!defined('ADMIN_LOGIN_MAX_FAILED')) define('ADMIN_LOGIN_MAX_FAILED', 5);
if (!defined('ADMIN_LOGIN_WINDOW_MINUTES')) define('ADMIN_LOGIN_WINDOW_MINUTES', 15);
if (!defined('ADMIN_LOGIN_LOCK_MINUTES')) define('ADMIN_LOGIN_LOCK_MINUTES', 30);
if (!defined('ADMIN_LOGIN_IP_MAX_FAILED')) define('ADMIN_LOGIN_IP_MAX_FAILED', 30);
if (!defined('ADMIN_LOGIN_IP_WINDOW_MINUTES')) define('ADMIN_LOGIN_IP_WINDOW_MINUTES', 60);
if (!defined('ADMIN_LOGIN_IP_LOCK_MINUTES')) define('ADMIN_LOGIN_IP_LOCK_MINUTES', 60);

/**
 * Record an admin audit event. `admin_id` may be null for unknown emails.
 * `meta` is stored as JSON text.
 */
function admin_record_audit(?int $adminId, string $action, array $meta = []): void
{
    try {
        $pdo = getAdminPDO();
        $stmt = $pdo->prepare('INSERT INTO admin_audit (admin_id, action, meta) VALUES (?, ?, ?)');
        $json = json_encode($meta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $stmt->execute([$adminId, $action, $json]);
    } catch (Exception $e) {
        error_log('admin_record_audit error: ' . $e->getMessage());
    }
}

function admin_count_recent_failed_by_admin(int $adminId, int $minutes = ADMIN_LOGIN_WINDOW_MINUTES): int
{
    $pdo = getAdminPDO();
    $stmt = $pdo->prepare("SELECT COUNT(*) as c FROM admin_audit WHERE admin_id = ? AND action = 'login_failed' AND created_at > DATE_SUB(NOW(), INTERVAL ? MINUTE)");
    $stmt->execute([$adminId, $minutes]);
    $row = $stmt->fetch();
    return (int) ($row['c'] ?? 0);
}

function admin_count_recent_failed_by_ip(string $ip, int $minutes = ADMIN_LOGIN_IP_WINDOW_MINUTES): int
{
    $pdo = getAdminPDO();
    // meta contains JSON like {"ip":"1.2.3.4",...}
    $like = '%"ip":"' . str_replace('%', '\\%', $ip) . '"%';
    $stmt = $pdo->prepare("SELECT COUNT(*) as c FROM admin_audit WHERE meta LIKE ? AND action LIKE 'login_failed%' AND created_at > DATE_SUB(NOW(), INTERVAL ? MINUTE)");
    $stmt->execute([$like, $minutes]);
    $row = $stmt->fetch();
    return (int) ($row['c'] ?? 0);
}

function admin_lock_account(int $adminId): void
{
    $pdo = getAdminPDO();
    $stmt = $pdo->prepare('UPDATE admin_users SET locked_until = DATE_ADD(NOW(), INTERVAL ? MINUTE) WHERE id = ?');
    $stmt->execute([ADMIN_LOGIN_LOCK_MINUTES, $adminId]);
    admin_record_audit($adminId, 'account_locked', ['reason' => 'too_many_failed_logins']);
}

function admin_is_account_locked(int $adminId): ?string
{
    $pdo = getAdminPDO();
    $stmt = $pdo->prepare('SELECT locked_until FROM admin_users WHERE id = ?');
    $stmt->execute([$adminId]);
    $row = $stmt->fetch();
    if (empty($row['locked_until'])) return null;
    // return datetime string of locked_until
    return $row['locked_until'];
}


function isAdminLoggedIn(): bool
{
    return !empty($_SESSION['admin_user_id']);
}

function requireAdmin(): void
{
    if (!isAdminLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function adminUser(): ?array
{
    if (!isAdminLoggedIn()) {
        return null;
    }
    $pdo = getAdminPDO();
    $stmt = $pdo->prepare('SELECT id, email, role FROM admin_users WHERE id = ?');
    $stmt->execute([$_SESSION['admin_user_id']]);
    $user = $stmt->fetch();
    return $user ?: null;
}
