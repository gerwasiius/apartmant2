<?php
declare(strict_types=1);

require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

// Get recent audit logs from admin database
$limit = 50;
$pdo = getAdminPDO();
$stmt = $pdo->prepare('SELECT * FROM admin_audit ORDER BY created_at DESC LIMIT ' . (int)$limit);
$stmt->execute();
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="hr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Audit Log</title>
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
              <li><a href="audit.php" class="block px-4 py-3 hover:bg-gray-50 bg-gray-100 font-medium text-mediterranean-blue">Audit Log</a></li>
              <li><a href="settings.php" class="block px-4 py-3 hover:bg-gray-50">Podešavanja</a></li>
            </ul>
          </div>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
        <h1 class="text-2xl font-bold mb-6">Audit Log</h1>

        <div class="ap-card">
          <div class="ap-card-body">
            <?php if (empty($logs)): ?>
              <p class="text-gray-600">Nema logova.</p>
            <?php else: ?>
              <div class="overflow-x-auto">
                <table class="w-full text-sm">
                  <thead class="border-b border-mediterranean-sand">
                    <tr>
                      <th class="text-left py-2 px-4">Vrijeme</th>
                      <th class="text-left py-2 px-4">Akcija</th>
                      <th class="text-left py-2 px-4">Admin</th>
                      <th class="text-left py-2 px-4">Detalji</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-mediterranean-sand">
                    <?php foreach ($logs as $log): ?>
                      <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 whitespace-nowrap text-xs">
                          <?= htmlspecialchars(date('Y-m-d H:i:s', strtotime($log['created_at']))) ?>
                        </td>
                        <td class="py-3 px-4">
                          <span class="inline-block px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                            <?= htmlspecialchars($log['action']) ?>
                          </span>
                        </td>
                        <td class="py-3 px-4 text-xs">
                          <?= !empty($log['admin_id']) ? htmlspecialchars((string)$log['admin_id']) : '-' ?>
                        </td>
                        <td class="py-3 px-4">
                          <code class="text-xs bg-gray-100 px-2 py-1 rounded">
                            <?= htmlspecialchars(substr($log['meta'] ?? '', 0, 50)) ?>
                          </code>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="mt-4 text-sm text-gray-600">
                Prikazano: <strong><?= count($logs) ?></strong> unosa (zadnjih <?= $limit ?>)
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
