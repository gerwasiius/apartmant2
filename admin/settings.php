<?php
declare(strict_types=1);

require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

$successMsg = null;

// TODO: Add actual settings storage/retrieval logic

admin_head('Podešavanja');

?>
  <div class="container px-4 md:px-0 py-4 md:py-8">
    <main>
      <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Podešavanja</h1>

        <?php if ($successMsg): ?>
          <div class="mb-4 p-3 md:p-4 bg-green-100 border border-green-300 rounded-lg text-green-800 text-sm">
            <?= htmlspecialchars($successMsg) ?>
          </div>
        <?php endif; ?>

        <!-- Admin Account Settings -->
        <div class="ap-card mb-4 md:mb-6">
          <div class="ap-card-header text-sm">Konto</div>
          <div class="ap-card-body">
            <div class="mb-4">
              <label class="block text-xs md:text-sm font-medium">Email</label>
              <input type="email" class="ap-input text-sm" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            </div>
            <button class="ap-btn text-sm px-3 py-1 md:px-4 md:py-2">Promijeni lozinku</button>
          </div>
        </div>

        <!-- Security Settings -->
        <div class="ap-card">
          <div class="ap-card-header text-sm">Sigurnost</div>
          <div class="ap-card-body">
            <p class="text-xs md:text-sm text-gray-700 mb-4">
              Admin paneli su zaštićeni login sustavom sa rate-limiting zaštitom i audit logom.
            </p>
            <div class="grid gap-2 md:gap-3 text-xs md:text-sm">
              <div class="p-2 md:p-3 bg-gray-50 rounded border border-mediterranean-sand">
                <div class="font-semibold">Maksimalno pokušaja</div>
                <div class="text-gray-600 text-xs">5 u 15 minuta</div>
              </div>
              <div class="p-2 md:p-3 bg-gray-50 rounded border border-mediterranean-sand">
                <div class="font-semibold">IP blokiranje</div>
                <div class="text-gray-600 text-xs">30 pokušaja u 60 minuta</div>
              </div>
              <div class="p-2 md:p-3 bg-gray-50 rounded border border-mediterranean-sand">
                <div class="font-semibold">Vrijeme zaključavanja</div>
                <div class="text-gray-600 text-xs">30 minuta nakon blokade</div>
              </div>
            </div>
          </div>
        </div>
    </main>
  </div>
<?php admin_footer(); ?>
