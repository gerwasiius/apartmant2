<?php
require_once __DIR__ . '/config/bootstrap.php';
$apartments = load_apartments();
$fromParam = $_GET['from'] ?? '';
$toParam = $_GET['to'] ?? '';
$guestsParam = $_GET['guests'] ?? '';

$count = count($apartments);
$countText = t('page.apartments.showing', ['count' => $count]);

site_head(t('page.apartments.title') . ' - Apartmani');
?>
<main class="min-h-[60vh] bg-[#FAF7EE]">
  <section class="border-b border-black/5 bg-white">
    <div class="container mx-auto px-4 py-12 md:py-12">
      <h1 class="text-4xl md:text-5xl font-medium tracking-tight">
        <?= htmlspecialchars(t('page.apartments.title')) ?>
      </h1>
      <p class="mt-3 md:mt-4 text-lg md:text-xl max-w-3xl">
        <?= htmlspecialchars(t('page.apartments.subtitle')) ?>
      </p>
    </div>
  </section>
  <div class="container mx-auto px-4 py-10">
    <!-- Page content -->
    <div class="grid gap-8 md:grid-cols-[300px_1fr]">
      <!-- LEFT: Search panel (reuses home booking UI + IDs) -->
      <aside>
        <div class="rounded-xl border border-mediterranean-sand bg-white p-4 shadow-sm">
          <h2 class="text-lg font-semibold mb-4">
            <?= htmlspecialchars(t('page.apartments.search_box_title')) ?>
          </h2>

          <!-- Dates -->
          <div class="mb-3">
            <div class="flex items-center gap-2 mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mediterranean-blue" viewBox="0 0 24 24"
                fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1M6 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2" />
              </svg>
              <span class="font-medium">
                <?= htmlspecialchars(t('page.apartments.search_dates')) ?>
              </span>
            </div>
            <label for="dateRange" class="sr-only">
              <?= htmlspecialchars(t('page.apartments.search_dates')) ?>
            </label>
            <!-- IMPORTANT: same id as on homepage so calendar.js picks it up -->
            <input
              id="dateRange"
              class="input-sand-apartments w-full rounded-md px-3 py-2 text-sm"
              placeholder="<?= htmlspecialchars(t('apt.dates_placeholder')) ?>"
            />
          </div>

          <!-- Guests -->
          <div class="mb-4">
            <div class="flex items-center gap-2 mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mediterranean-blue" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
              <span class="font-medium">
                <?= htmlspecialchars(t('page.apartments.search_guests')) ?>
              </span>
            </div>
            <label for="guests" class="sr-only">
              <?= htmlspecialchars(t('page.apartments.search_guests')) ?>
            </label>
            <!-- IMPORTANT: same id as on homepage so click handler keeps working -->
            <select id="guests" class="input-sand-apartments w-full rounded-md px-3 py-2 text-sm" required
              aria-required="true">
              <option value="" selected disabled hidden>
                <?= htmlspecialchars(t('page.apartments.guests_placeholder')) ?>
              </option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>

          <button id="searchBtn" class="w-full px-4 py-2 rounded-lg bg-mediterranean-blue text-white hover:opacity-90">
            <?= htmlspecialchars(t('hero.search')) ?>
          </button>
        </div>
      </aside>

      <!-- RIGHT: List + toolbar -->
      <section class="space-y-6">
        <!-- Top toolbar (count + sort) -->
        <div class="flex items-center justify-between">
          <p class="text-gray-600">
            <?= htmlspecialchars($countText) ?>
          </p>
          <select class="rounded-md border border-mediterranean-sand bg-white px-3 py-2 text-sm">
            <option>
              <?= htmlspecialchars(t('page.apartments.sort_price_asc')) ?>
            </option>
            <option>
              <?= htmlspecialchars(t('page.apartments.sort_price_desc')) ?>
            </option>
          </select>
        </div>

        <!-- Apartments list (card rows like v0) -->
        <div class="space-y-6">
          <?php foreach ($apartments as $a): ?>
            <?php
              $images = $a['images'] ?? [];
              $img = $images[0] ?? null;
              foreach ($images as $im) {
                if (!empty($im['featured']) || !empty($im['isFeatured'])) {
                  $img = $im;
                  break;
                }
              }
              $imgUrl = $img['url'] ?? '';
              $imgAlt = $img['alt'] ?? ($a['name'] ?? 'Apartment');
            ?>
            <div class="rounded-xl border border-mediterranean-sand overflow-hidden bg-white">
              <div class="grid md:grid-cols-[300px_1fr] gap-0">
                <!-- Image -->
                <div class="relative aspect-[4/3] md:aspect-auto">
                  <img
                    src="<?php echo htmlspecialchars($imgUrl); ?>"
                    alt="<?php echo htmlspecialchars($imgAlt); ?>"
                    class="object-cover w-full h-full"
                    loading="lazy"
                    referrerpolicy="no-referrer"
                    onerror="this.onerror=null;this.src='/assets/img/placeholder.jpg';"
                  />
                  <?php if (!empty($images) && count($images) > 1): ?>
                    <div class="absolute bottom-2 right-2 bg-black/50 rounded-full px-2 py-1 text-xs text-white">
                      <span><?php echo count($images); ?> photos</span>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col gap-3">
                  <div class="flex items-start justify-between">
                    <h2 class="text-xl font-semibold text-mediterranean-blue-dark">
                      <?php echo htmlspecialchars($a['name'] ?? ''); ?>
                    </h2>
                    <div class="flex items-baseline gap-1">
                      <span class="font-semibold">
                        €<?php echo htmlspecialchars((string)($a['price'] ?? '')); ?>
                      </span>
                      <span class="text-sm text-gray-500">
                        <?= htmlspecialchars(t('apt.per_night')) ?>
                      </span>
                    </div>
                  </div>

                  <p class="text-gray-600">
                    <?php echo htmlspecialchars($a['description'] ?? ''); ?>
                  </p>

                  <div class="flex items-center gap-4 text-sm text-gray-800">
                    <div class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path d="M4 21v-7a2 2 0 0 1 2-2h3v9" />
                        <path d="M9 21V10" />
                        <path d="M9 6.5A2.5 2.5 0 0 1 11.5 4H20a1 1 0 0 1 1 1v7H9" />
                        <path d="M16 3v3" />
                        <path d="M12 3v3" />
                      </svg>
                      <?= htmlspecialchars(
                        t('page.apartments.beds', ['count' => (int)($a['beds'] ?? 0)])
                      ); ?>
                    </div>
                    <div class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path d="M4 12V7a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v5M4 21v-3m16 3v-3M4 15h16v3H4z" />
                      </svg>
                      <?= htmlspecialchars(
                        t('page.apartments.baths', ['count' => (int)($a['baths'] ?? 0)])
                      ); ?>
                    </div>
                    <div class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                      </svg>
                      <?= htmlspecialchars(
                        t('page.apartments.guests', ['count' => (int)($a['guests'] ?? 0)])
                      ); ?>
                    </div>
                  </div>

                  <div class="mt-2">
                    <?php
                    $detailParams = ['id' => $a['id']];
                    if ($fromParam)   $detailParams['from'] = $fromParam;
                    if ($toParam)     $detailParams['to'] = $toParam;
                    if ($guestsParam) $detailParams['guests'] = $guestsParam;
                    $detailHref = url('apartment.php?' . http_build_query($detailParams));
                    ?>
                    <a
                      href="<?php echo htmlspecialchars($detailHref); ?>"
                      class="inline-flex items-center justify-center rounded-md bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white px-4 py-2 text-sm"
                    >
                      <?= htmlspecialchars(t('page.apartments.view_details')) ?>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    </div>
  </div>
</main>
<?php site_footer(); ?>
