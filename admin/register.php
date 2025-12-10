<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
// Temporary register script to create admin users. Remove after initial setup.

$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email) {
        $errors[] = 'Unesite ispravan e-mail.';
    }
    if (strlen($password) < 6) {
        $errors[] = 'Lozinka mora imati najmanje 6 karaktera.';
    }

    if (empty($errors)) {
        $pdo = getAdminPDO();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO admin_users (email, password) VALUES (?, ?)');
        try {
            $stmt->execute([$email, $hash]);
            $success = 'Admin korisnik je kreiran. Možete se prijaviti.';
        } catch (PDOException $e) {
            $errors[] = 'Greška pri kreiranju korisnika (možda već postoji).';
        }
    }
}

?>
<!doctype html>
<html lang="hr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Registracija</title>
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
          <h1 class="text-2xl font-bold">Registracija admin korisnika (privremeno)</h1>

          <?php if ($success): ?>
            <p class="text-green-700 mt-3"><?= htmlspecialchars($success) ?></p>
          <?php endif; ?>

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
              <button class="ap-btn w-full" type="submit">Kreiraj korisnika</button>
            </div>
          </form>

          <p class="mt-4 text-sm"><a href="login.php" class="text-mediterranean-blue">Prijava</a></p>
        </div>
      </div>
    </div>
  </main>

  <footer class="container text-center py-6 text-sm text-gray-600">&copy; <?= date('Y') ?> Majstorić Apartments</footer>
</body>
</html>
