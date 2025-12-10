<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

// Get all apartments
$apartments = load_apartments();

$successMsg = null;
if (!empty($_GET['msg'])) {
    if ($_GET['msg'] === 'deleted') {
        $successMsg = 'Apartman je obrisan.';
    } elseif ($_GET['msg'] === 'created') {
        $successMsg = 'Apartman je kreiran.';
    } elseif ($_GET['msg'] === 'updated') {
        $successMsg = 'Apartman je ažuriran.';
    }
}

?>
<!doctype html>
<html lang="hr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Apartmani</title>
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
              <li><a href="index.php" class="block px-4 py-3 hover:bg-gray-50 text-mediterranean-blue font-medium">Dashboard</a></li>
              <li><a href="apartments.php" class="block px-4 py-3 hover:bg-gray-50 bg-gray-100">Apartmani</a></li>
              <li><a href="audit.php" class="block px-4 py-3 hover:bg-gray-50">Audit Log</a></li>
              <li><a href="settings.php" class="block px-4 py-3 hover:bg-gray-50">Podešavanja</a></li>
            </ul>
          </div>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
        <div class="ap-card mb-6">
          <div class="ap-card-body">
            <div class="flex justify-between items-center">
              <h1 class="text-2xl font-bold">Apartmani</h1>
              <a href="apartment-edit.php" class="ap-btn">+ Novi apartman</a>
            </div>
          </div>
        </div>

        <?php if ($successMsg): ?>
          <div class="mb-4 p-4 bg-green-100 border border-green-300 rounded-lg text-green-800">
            <?= htmlspecialchars($successMsg) ?>
          </div>
        <?php endif; ?>

        <!-- Apartments Table -->
        <div class="ap-card">
          <div class="ap-card-body">
            <?php if (empty($apartments)): ?>
              <p class="text-gray-600">Nema apartmana.</p>
            <?php else: ?>
              <div class="overflow-x-auto">
                <table class="w-full text-sm">
                  <thead class="border-b border-mediterranean-sand">
                    <tr>
                      <th class="text-left py-2 px-4">ID</th>
                      <th class="text-left py-2 px-4">Naziv</th>
                      <th class="text-left py-2 px-4">Cijena/noć</th>
                      <th class="text-left py-2 px-4">Spavaće sobe</th>
                      <th class="text-left py-2 px-4">Kupaonica</th>
                      <th class="text-left py-2 px-4">Gostiju</th>
                      <th class="text-center py-2 px-4">Akcije</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-mediterranean-sand">
                    <?php foreach ($apartments as $apt): ?>
                      <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4"><?= htmlspecialchars((string)$apt['id']) ?></td>
                        <td class="py-3 px-4">
                          <div>
                            <div class="font-semibold"><?= htmlspecialchars($apt['name'] ?? '') ?></div>
                            <div class="text-xs text-gray-600"><?= htmlspecialchars($apt['subName'] ?? '') ?></div>
                          </div>
                        </td>
                        <td class="py-3 px-4">€<?= htmlspecialchars((string)$apt['price']) ?></td>
                        <td class="py-3 px-4 text-center"><?= htmlspecialchars((string)$apt['beds']) ?></td>
                        <td class="py-3 px-4 text-center"><?= htmlspecialchars((string)$apt['baths']) ?></td>
                        <td class="py-3 px-4 text-center"><?= htmlspecialchars((string)$apt['guests']) ?></td>
                        <td class="py-3 px-4 text-center">
                          <a href="apartment-edit.php?id=<?= htmlspecialchars((string)$apt['id']) ?>" class="text-mediterranean-blue hover:underline text-xs mr-2">Uređuj</a>
                          <a href="apartment-delete.php?id=<?= htmlspecialchars((string)$apt['id']) ?>" class="text-red-600 hover:underline text-xs" onclick="return confirm('Sigurno?')">Obriši</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="mt-4 text-sm text-gray-600">
                Ukupno: <strong><?= count($apartments) ?></strong> apartmana
              </div>
            <?php endif; ?>
          </div>
        </div>
      </main>
    </div>
  </div>

  <footer class="container text-center py-6 text-sm text-gray-600 mt-8">&copy; <?= date('Y') ?> Majstorić Apartments</footer>
</body>
</html>
