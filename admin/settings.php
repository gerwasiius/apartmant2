<?php
declare(strict_types=1);

require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

$successMsg = null;

// TODO: Add actual settings storage/retrieval logic

?>
<!doctype html>
<html lang="hr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Podešavanja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-mediterranean-beige text-gray-900">
  <header class="border-b border-mediterranean-sand header-glass">
    <div class="container flex h-16 items-center justify-between">
      <a href="../index.php" class="text-lg font-bold text-mediterranean-blue">Majstorić Apartments — Admin</a>
      <div class="flex items-center gap-4">
        <span class="text-sm"><?= htmlspecialchars($user['email'] ?? 'Admin') ?></span>
        <a href="logout.php" class="ap-btn">Odjava</a>
      </div>
    </div>
  </header>

  <div class="container py-8">
    <!-- Sidebar Navigation -->
    <div class="grid grid-cols-1 md:grid-cols-[250px_1fr] gap-8">
      <aside class="md:sticky md:top-24">
        <nav class="ap-card">
          <div class="ap-card-header">Admin Menu</div>
          <div class="ap-card-body p-0">
            <ul class="divide-y">
              <li><a href="index.php" class="block px-4 py-3 hover:bg-gray-50">Dashboard</a></li>
              <li><a href="apartments.php" class="block px-4 py-3 hover:bg-gray-50">Apartmani</a></li>
              <li><a href="audit.php" class="block px-4 py-3 hover:bg-gray-50">Audit Log</a></li>
              <li><a href="settings.php" class="block px-4 py-3 hover:bg-gray-50 bg-gray-100 font-medium text-mediterranean-blue">Podešavanja</a></li>
            </ul>
          </div>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
        <h1 class="text-2xl font-bold mb-6">Podešavanja</h1>

        <?php if ($successMsg): ?>
          <div class="mb-4 p-4 bg-green-100 border border-green-300 rounded-lg text-green-800">
            <?= htmlspecialchars($successMsg) ?>
          </div>
        <?php endif; ?>

        <!-- Admin Account Settings -->
        <div class="ap-card mb-6">
          <div class="ap-card-header">Konto</div>
          <div class="ap-card-body">
            <div class="mb-4">
              <label class="block text-sm font-medium">Email</label>
              <input type="email" class="ap-input" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            </div>
            <button class="ap-btn">Promijeni lozinku</button>
          </div>
        </div>

        <!-- Site Settings -->
        <div class="ap-card mb-6">
          <div class="ap-card-header">Postavke stranice</div>
          <div class="ap-card-body">
            <form method="post" class="grid gap-4">
              <div class="ap-field">
                <label class="ap-label">Naziv stranice</label>
                <input class="ap-input" type="text" name="site_name" value="Majstorić Apartments">
              </div>

              <div class="ap-field">
                <label class="ap-label">Email za kontakt</label>
                <input class="ap-input" type="email" name="contact_email" value="info@majstoricapartments.com">
              </div>

              <div class="ap-field">
                <label class="ap-label">Telefon</label>
                <input class="ap-input" type="tel" name="phone" value="+385 1 234 5678">
              </div>

              <button class="ap-btn">Spremi postavke</button>
            </form>
          </div>
        </div>

        <!-- Security Settings -->
        <div class="ap-card">
          <div class="ap-card-header">Sigurnost</div>
          <div class="ap-card-body">
            <p class="text-sm text-gray-700 mb-4">
              Admin paneli su zaštićeni login sustavom sa rate-limiting zaštitom i audit logom.
            </p>
            <div class="grid gap-3 text-sm">
              <div class="p-3 bg-gray-50 rounded border border-mediterranean-sand">
                <div class="font-semibold">Maksimalno neuspješnih pokušaja</div>
                <div class="text-gray-600">5 pokušaja u 15 minuta</div>
              </div>
              <div class="p-3 bg-gray-50 rounded border border-mediterranean-sand">
                <div class="font-semibold">IP blokiranje</div>
                <div class="text-gray-600">30 neuspješnih pokušaja u 60 minuta</div>
              </div>
              <div class="p-3 bg-gray-50 rounded border border-mediterranean-sand">
                <div class="font-semibold">Vrijeme zaključavanja</div>
                <div class="text-gray-600">30 minuta nakon blokade</div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <footer class="container text-center py-6 text-sm text-gray-600 mt-8">&copy; <?= date('Y') ?> Majstorić Apartments</footer>
</body>
</html>
