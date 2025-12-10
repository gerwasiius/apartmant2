<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

// Get basic stats
$apartments = load_apartments();
$totalApartments = count($apartments);

?>
<!doctype html>
<html lang="hr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
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
              <li><a href="index.php" class="block px-4 py-3 hover:bg-gray-50 bg-gray-100 font-medium text-mediterranean-blue">Dashboard</a></li>
              <li><a href="apartments.php" class="block px-4 py-3 hover:bg-gray-50">Apartmani</a></li>
              <li><a href="audit.php" class="block px-4 py-3 hover:bg-gray-50">Audit Log</a></li>
              <li><a href="settings.php" class="block px-4 py-3 hover:bg-gray-50">Podešavanja</a></li>
            </ul>
          </div>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
          <div class="ap-card">
            <div class="ap-card-body">
              <div class="text-4xl font-bold text-mediterranean-blue"><?= $totalApartments ?></div>
              <div class="text-gray-600 mt-2">Ukupno apartmana</div>
            </div>
          </div>

          <div class="ap-card">
            <div class="ap-card-body">
              <div class="text-4xl font-bold text-mediterranean-orange">-</div>
              <div class="text-gray-600 mt-2">Aktivne rezervacije</div>
            </div>
          </div>

          <div class="ap-card">
            <div class="ap-card-body">
              <div class="text-4xl font-bold text-mediterranean-blue">-</div>
              <div class="text-gray-600 mt-2">Poruke kontakta</div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="ap-card">
          <div class="ap-card-header">Brze akcije</div>
          <div class="ap-card-body">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <a href="apartments.php" class="block p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
                <div class="text-2xl mb-2">🏠</div>
                <div class="font-medium text-sm">Apartmani</div>
              </a>
              <a href="audit.php" class="block p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
                <div class="text-2xl mb-2">📋</div>
                <div class="font-medium text-sm">Audit Log</div>
              </a>
              <a href="settings.php" class="block p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
                <div class="text-2xl mb-2">⚙️</div>
                <div class="font-medium text-sm">Podešavanja</div>
              </a>
              <a href="logout.php" class="block p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
                <div class="text-2xl mb-2">🚪</div>
                <div class="font-medium text-sm">Odjava</div>
              </a>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-8 ap-card">
          <div class="ap-card-header">Nedavne aktivnosti</div>
          <div class="ap-card-body">
            <p class="text-gray-600 text-sm">Pregledaj <a href="audit.php" class="text-mediterranean-blue">audit log</a> za sve aktivnosti.</p>
          </div>
        </div>
      </main>
    </div>
  </div>

  <footer class="container text-center py-6 text-sm text-gray-600 mt-8">&copy; <?= date('Y') ?> Majstorić Apartments</footer>
</body>
</html>
