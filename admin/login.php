<?php
declare(strict_types=1);

require_once __DIR__ . '/init.php';

$errors = [];

// Enable error logging to a file for debugging
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error.log');

// helper: get client IP (basic)
function admin_get_client_ip(): string
{
  if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    return trim($parts[0]);
  }
  return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
  $password = $_POST['password'] ?? '';
  $ip = admin_get_client_ip();
  
  // Generic error messages for security (never reveal if email/password is valid)
  $genericError = 'Neispravan email ili lozinka. Pokušajte ponovno.';
  $blockError = 'Previše pokušaja. Pokušajte kasneje.';

  if (!$email || $password === '') {
    $errors[] = $genericError;
  } else {
    // quick IP-based block check
    $ipFails = admin_count_recent_failed_by_ip($ip, ADMIN_LOGIN_IP_WINDOW_MINUTES);
    if ($ipFails >= ADMIN_LOGIN_IP_MAX_FAILED) {
      admin_record_audit(null, 'login_blocked_ip_attempt', ['ip' => $ip]);
      $errors[] = $blockError;
    }

    if (empty($errors)) {
      $pdo = getAdminPDO();
      $stmt = $pdo->prepare('SELECT id, password FROM admin_users WHERE email = ? LIMIT 1');
      $stmt->execute([$email]);
      $user = $stmt->fetch();

      // if user exists, check account lock
      if ($user) {
        $lockedUntil = admin_is_account_locked((int)$user['id']);
        if ($lockedUntil !== null) {
          $now = new DateTimeImmutable('now');
          $until = new DateTimeImmutable($lockedUntil);
          if ($until > $now) {
            admin_record_audit((int)$user['id'], 'login_attempt_locked', ['ip' => $ip]);
            $errors[] = $blockError;
          } else {
            // lock expired, clear locked_until
            $u = $pdo->prepare('UPDATE admin_users SET locked_until = NULL, failed_attempts = 0 WHERE id = ?');
            $u->execute([(int)$user['id']]);
          }
        }
      }

      if (empty($errors)) {
        if ($user && password_verify($password, $user['password'])) {
          // success
          $_SESSION['admin_user_id'] = $user['id'];
          $u = $pdo->prepare('UPDATE admin_users SET last_login = NOW(), failed_attempts = 0, locked_until = NULL WHERE id = ?');
          $u->execute([$user['id']]);
          admin_record_audit((int)$user['id'], 'login_success', ['ip' => $ip]);
          header('Location: index.php');
          exit;
        }

        // failed login (no distinction between unknown email and wrong password)
        if ($user) {
          admin_record_audit((int)$user['id'], 'login_failed', ['ip' => $ip, 'email' => $email]);
          $inc = $pdo->prepare('UPDATE admin_users SET failed_attempts = failed_attempts + 1 WHERE id = ?');
          $inc->execute([(int)$user['id']]);

          $recentFails = admin_count_recent_failed_by_admin((int)$user['id'], ADMIN_LOGIN_WINDOW_MINUTES);
          if ($recentFails >= ADMIN_LOGIN_MAX_FAILED) {
            admin_lock_account((int)$user['id']);
          }
        } else {
          // unknown email — record attempt without admin_id
          admin_record_audit(null, 'login_failed_unknown', ['ip' => $ip, 'email' => $email]);
        }

        $errors[] = $genericError;

        // If IP crosses threshold now, record an IP block event
        $ipFailsAfter = admin_count_recent_failed_by_ip($ip, ADMIN_LOGIN_IP_WINDOW_MINUTES);
        if ($ipFailsAfter >= ADMIN_LOGIN_IP_MAX_FAILED) {
          admin_record_audit(null, 'ip_blocked', ['ip' => $ip]);
        }
      }
    }
  }
}

?>
<!doctype html>
<html lang="hr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/cta.css">
  <link rel="stylesheet" href="../assets/css/location.css">
</head>
<body class="bg-mediterranean-beige text-gray-900">
  <header class="border-b border-mediterranean-sand header-glass">
    <div class="container flex h-16 items-center">
      <a href="../index.php" class="text-lg font-bold text-mediterranean-blue">Majstorić Apartments — Admin</a>
    </div>
  </header>

  <main class="container py-8">
    <div class="max-w-md mx-auto">
      <div class="ap-card">
        <div class="ap-card-body">
          <h1 class="text-2xl font-bold">Admin Prijava</h1>

          <?php if ($errors): ?>
            <ul class="text-red-600 mt-3 list-disc pl-5">
              <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <form method="post" class="mt-4 grid gap-4">
            <div class="ap-field">
              <label class="ap-label">Email</label>
              <input class="ap-input" type="email" name="email" required>
            </div>
            <div class="ap-field">
              <label class="ap-label">Lozinka</label>
              <input class="ap-input" type="password" name="password" required>
            </div>
            <div>
              <button class="ap-btn w-full" type="submit">Prijavi se</button>
            </div>
          </form>

          <p class="mt-4 text-sm"><a href="register.php" class="text-mediterranean-blue">Kreiraj admin korisnika (privremeno)</a></p>
        </div>
      </div>
    </div>
  </main>

  <footer class="container text-center py-6 text-sm text-gray-600">&copy; <?= date('Y') ?> Majstorić Apartments</footer>
</body>
</html>
