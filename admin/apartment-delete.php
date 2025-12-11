<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

$aptId = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$aptId) {
    header('Location: apartments.php');
    exit;
}

$apartment = find_apartment($aptId);
if (!$apartment) {
    header('Location: apartments.php?msg=notfound');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    try {
        // Delete apartment and all related data
        db_execute('DELETE FROM apartment_translations WHERE apartment_id = ?', [$aptId]);
        db_execute('DELETE FROM images WHERE apartment_id = ?', [$aptId]);
        db_execute('DELETE FROM apartment_amenities WHERE apartment_id = ?', [$aptId]);
        db_execute('DELETE FROM house_rules WHERE apartment_id = ?', [$aptId]);
        db_execute('DELETE FROM apartments WHERE id = ?', [$aptId]);

        admin_record_audit($user['id'], 'apartment_deleted', ['apartment_id' => $aptId, 'name' => $apartment['name']]);

        header('Location: apartments.php?msg=deleted');
        exit;
    } catch (Exception $e) {
        $error = 'Greška pri brisanju: ' . $e->getMessage();
    }
}

admin_head('Brisanje apartmana');

?>
  <div class="container px-4 md:px-0 py-4 md:py-8">
    <div class="max-w-md mx-auto">
      <a href="apartments.php" class="text-mediterranean-blue mb-4 inline-block text-sm">← Nazad</a>

      <div class="ap-card">
        <div class="ap-card-header text-sm">Potvrdi brisanje</div>

        <div class="ap-card-body">
          <?php if (!empty($error)): ?>
            <div class="mb-4 p-3 md:p-4 bg-red-100 border border-red-300 rounded-lg text-red-800 text-sm">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <div class="mb-4 p-3 md:p-4 bg-yellow-100 border border-yellow-300 rounded-lg text-yellow-900 text-sm">
            <p class="font-semibold mb-2">Upozorenje!</p>
            <p>Sigurno želiš obrisati <strong><?= htmlspecialchars($apartment['name'] ?? '') ?></strong>?</p>
            <p class="text-xs mt-2">Ovo će obrisati:</p>
            <ul class="text-xs list-disc pl-5 mt-1">
              <li>Sve informacije o apartmanu</li>
              <li>Sve slike</li>
              <li>Sve amenitete i pravila</li>
            </ul>
            <p class="text-xs mt-2 font-semibold">Ova akcija se ne može poništiti!</p>
          </div>

          <form method="post" class="grid gap-3 md:gap-4">
            <input type="hidden" name="confirm" value="1">
            <div class="flex gap-2">
              <button type="submit" class="flex-1 ap-btn bg-red-600 hover:bg-red-700 text-sm py-2">Obriši</button>
              <a href="apartments.php" class="flex-1 inline-flex items-center justify-center px-3 md:px-4 py-2 text-sm rounded-lg border border-mediterranean-sand hover:bg-gray-50">Otkaži</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php admin_footer(); ?>
