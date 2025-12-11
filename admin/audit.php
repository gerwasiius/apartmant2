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

admin_head('Audit Log');

?>
  <div class="container px-4 md:px-0 py-4 md:py-8">
    <main>
      <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Audit Log</h1>

        <div class="ap-card">
          <div class="ap-card-body p-0">
            <?php if (empty($logs)): ?>
              <p class="text-gray-600 p-4">Nema logova.</p>
            <?php else: ?>
              <!-- Desktop: Table View -->
              <div class="hidden md:block overflow-x-auto">
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

              <!-- Mobile: List View -->
              <div class="md:hidden divide-y">
                <?php foreach ($logs as $log): ?>
                  <div class="p-3 hover:bg-gray-50">
                    <div class="flex justify-between items-start mb-2">
                      <span class="inline-block px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                        <?= htmlspecialchars($log['action']) ?>
                      </span>
                      <span class="text-xs text-gray-600">
                        <?= htmlspecialchars(date('H:i', strtotime($log['created_at']))) ?>
                      </span>
                    </div>
                    <p class="text-xs text-gray-700 mb-2"><?= htmlspecialchars(date('d.m.Y', strtotime($log['created_at']))) ?></p>
                    <code class="text-xs bg-gray-100 px-2 py-1 rounded block truncate">
                      <?= htmlspecialchars(substr($log['meta'] ?? '', 0, 50)) ?>
                    </code>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="p-3 md:p-4 border-t border-mediterranean-sand text-xs md:text-sm text-gray-600">
                Prikazano: <strong><?= count($logs) ?></strong> unosa (zadnjih <?= $limit ?>)
              </div>
            <?php endif; ?>
          </div>
        </div>
    </main>
  </div>
<?php admin_footer(); ?>
