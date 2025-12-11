<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

$aptId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$apartment = null;
if ($aptId) {
    $apartment = find_apartment($aptId);
}

$errors = [];
$successMsg = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $subName = $_POST['sub_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $longDescription = $_POST['long_description'] ?? '';
    $price = (float)($_POST['price'] ?? 0);
    $beds = (int)($_POST['beds'] ?? 0);
    $baths = (int)($_POST['baths'] ?? 0);
    $guests = (int)($_POST['guests'] ?? 0);

    if (empty($name)) $errors[] = 'Naziv je obavezan.';
    if ($price <= 0) $errors[] = 'Cijena mora biti veća od 0.';
    if ($beds < 0) $errors[] = 'Broj spavaćih soba ne može biti negativan.';
    if ($baths < 0) $errors[] = 'Broj kupaonica ne može biti negativan.';
    if ($guests < 0) $errors[] = 'Broj gostiju ne može biti negativan.';

    if (empty($errors)) {
        try {
            if ($aptId) {
                // Update
                db_execute(
                    'UPDATE apartments SET name = ?, description = ?, price = ?, beds = ?, baths = ?, guests = ? WHERE id = ?',
                    [$name, $description, $price, $beds, $baths, $guests, $aptId]
                );

                // Update translation (English as default)
                db_execute(
                    'UPDATE apartment_translations SET name = ?, sub_name = ?, description = ?, long_description = ? WHERE apartment_id = ? AND lang = ?',
                    [$name, $subName, $description, $longDescription, $aptId, 'en']
                );

                admin_record_audit($user['id'], 'apartment_updated', ['apartment_id' => $aptId, 'name' => $name]);
                header('Location: apartments.php?msg=updated');
                exit;
            } else {
                // Create
                db_execute(
                    'INSERT INTO apartments (name, description, price, beds, baths, guests) VALUES (?, ?, ?, ?, ?, ?)',
                    [$name, $description, $price, $beds, $baths, $guests]
                );
                $newId = db_fetch_one('SELECT LAST_INSERT_ID() as id')['id'];

                // Create translation (English as default)
                db_execute(
                    'INSERT INTO apartment_translations (apartment_id, lang, name, sub_name, description, long_description) VALUES (?, ?, ?, ?, ?, ?)',
                    [$newId, 'en', $name, $subName, $description, $longDescription]
                );

                admin_record_audit($user['id'], 'apartment_created', ['apartment_id' => $newId, 'name' => $name]);
                header('Location: apartments.php?msg=created');
                exit;
            }
        } catch (Exception $e) {
            $errors[] = 'Greška pri spremanju: ' . $e->getMessage();
        }
    }
}

$pageTitle = $aptId ? 'Uređivanje apartmana' : 'Novi apartman';
admin_head($pageTitle);

?>
  <div class="container px-4 md:px-0 py-4 md:py-8">
    <div class="max-w-2xl">
      <a href="apartments.php" class="text-mediterranean-blue mb-4 inline-block text-sm">← Nazad</a>

      <div class="ap-card">
        <div class="ap-card-header">
          <?= $aptId ? 'Uređivanje apartmana' : 'Novi apartman' ?>
        </div>

        <div class="ap-card-body">
          <?php if (!empty($errors)): ?>
            <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded-lg">
              <ul class="text-red-800 list-disc pl-5">
                <?php foreach ($errors as $err): ?>
                  <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="post" class="grid gap-4">
            <div class="ap-field">
              <label class="ap-label">Naziv *</label>
              <input class="ap-input" type="text" name="name" required value="<?= htmlspecialchars($apartment['name'] ?? '') ?>">
            </div>

            <div class="ap-field">
              <label class="ap-label">Podnaziv</label>
              <input class="ap-input" type="text" name="sub_name" value="<?= htmlspecialchars($apartment['subName'] ?? '') ?>">
            </div>

            <div class="ap-field">
              <label class="ap-label">Kratak opis</label>
              <textarea class="ap-input" name="description" rows="3"><?= htmlspecialchars($apartment['description'] ?? '') ?></textarea>
            </div>

            <div class="ap-field">
              <label class="ap-label">Detaljni opis</label>
              <textarea class="ap-input" name="long_description" rows="5"><?= htmlspecialchars($apartment['longDescription'] ?? '') ?></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div class="ap-field">
                <label class="ap-label">Cijena/noć (EUR) *</label>
                <input class="ap-input" type="number" name="price" step="0.01" min="0" required value="<?= htmlspecialchars((string)($apartment['price'] ?? '')) ?>">
              </div>

              <div class="ap-field">
                <label class="ap-label">Spavaće sobe *</label>
                <input class="ap-input" type="number" name="beds" min="0" required value="<?= htmlspecialchars((string)($apartment['beds'] ?? '')) ?>">
              </div>

              <div class="ap-field">
                <label class="ap-label">Kupaonica *</label>
                <input class="ap-input" type="number" name="baths" min="0" required value="<?= htmlspecialchars((string)($apartment['baths'] ?? '')) ?>">
              </div>

              <div class="ap-field">
                <label class="ap-label">Broj gostiju *</label>
                <input class="ap-input" type="number" name="guests" min="0" required value="<?= htmlspecialchars((string)($apartment['guests'] ?? '')) ?>">
              </div>
            </div>

            <div class="flex gap-2 pt-4">
              <button class="ap-btn" type="submit">
                <?= $aptId ? 'Spremi promjene' : 'Kreiraj apartman' ?>
              </button>
              <a href="apartments.php" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-mediterranean-sand hover:bg-gray-50">Otkaži</a>
            </div>
          </form>
        </div>
      </div>

      <?php if ($aptId && !empty($apartment['images'])): ?>
        <div class="ap-card mt-6">
          <div class="ap-card-header">Slike (<?= count($apartment['images']) ?>)</div>
          <div class="ap-card-body">
            <div class="grid grid-cols-3 gap-4">
              <?php foreach ($apartment['images'] as $img): ?>
                <div class="relative">
                  <img src="<?= htmlspecialchars($img['url']) ?>" alt="<?= htmlspecialchars($img['alt']) ?>" class="w-full h-32 object-cover rounded">
                  <div class="absolute bottom-1 right-1 bg-red-600 text-white text-xs px-2 py-1 rounded cursor-pointer hover:bg-red-700">Obriši</div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php admin_footer(); ?>
