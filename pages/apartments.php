<?php
require_once __DIR__ . '/../config/bootstrap.php';
$apartments = load_apartments();
$sortParam = $_GET['sort'] ?? 'asc';
$fromParam = $_GET['from'] ?? '';
$toParam = $_GET['to'] ?? '';
$guestsParam = $_GET['guests'] ?? '';

// Sortiraj apartmane prema parametru
if ($sortParam === 'desc') {
  usort($apartments, function ($a, $b) {
    return ($b['price'] ?? 0) <=> ($a['price'] ?? 0);
  });
} else {
  usort($apartments, function ($a, $b) {
    return ($a['price'] ?? 0) <=> ($b['price'] ?? 0);
  });
}

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
            <input id="dateRange" class="input-sand-apartments w-full rounded-md px-3 py-2 text-sm"
              placeholder="<?= htmlspecialchars(t('apt.dates_placeholder')) ?>" />
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
          <select id="sortSelect" class="rounded-md border border-mediterranean-sand bg-white px-3 py-2 text-sm">
            <option value="asc" <?= $sortParam === 'asc' ? 'selected' : '' ?>>
              <?= htmlspecialchars(t('page.apartments.sort_price_asc')) ?>
            </option>
            <option value="desc" <?= $sortParam === 'desc' ? 'selected' : '' ?>>
              <?= htmlspecialchars(t('page.apartments.sort_price_desc')) ?>
            </option>
          </select>
        </div>

        <!-- Apartments list (card rows like v0) -->
        <div class="space-y-8">
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
            $total = count($images);

            // link na detalje (ista logika kao prije)
            $detailParams = ['id' => $a['id']];
            if (!empty($fromParam))
              $detailParams['from'] = $fromParam;
            if (!empty($toParam))
              $detailParams['to'] = $toParam;
            if (!empty($guestsParam))
              $detailParams['guests'] = $guestsParam;
            $detailHref = url('pages/apartment.php?' . http_build_query($detailParams));
            ?>

            <!-- VEĆA KARTICA -->
            <article class="rounded-2xl border border-mediterranean-sand overflow-hidden bg-white shadow-sm">
              <div class="flex flex-col md:flex-row">
                <!-- LIJEVO: VEĆA SLIKA -->
                <div class="md:w-[340px] lg:w-[380px] flex-shrink-0">
                  <div class="relative h-[220px] md:h-[250px] lg:h-[270px]">
                    <?php if ($imgUrl): ?>
                      <img src="<?php echo htmlspecialchars($imgUrl); ?>" alt="<?php echo htmlspecialchars($imgAlt); ?>"
                        class="w-full h-full object-cover" loading="lazy" />
                    <?php else: ?>
                      <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                        <?= htmlspecialchars(t('page.apartments.no_image')); ?>
                      </div>
                    <?php endif; ?>

                    <?php if ($total > 1): ?>
                      <span class="absolute bottom-3 right-3 rounded-full bg-black/60 text-white text-xs px-3 py-1">
                        <?php echo (int) $total; ?> photos
                      </span>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- DESNO: SADRŽAJ -->
                <div class="flex-1 p-6 lg:p-7 flex flex-col gap-4">
                  <div class="flex items-start justify-between gap-3">
                    <h2 class="text-xl md:text-2xl font-semibold text-mediterranean-blue-dark">
                      <?php echo htmlspecialchars($a['name'] ?? ''); ?>
                    </h2>

                    <div class="text-right">
                      <div class="flex items-baseline gap-1 justify-end">
                        <span class="font-semibold text-lg md:text-xl">
                          €<?php echo htmlspecialchars((string) ($a['price'] ?? '')); ?>
                        </span>
                        <span class="text-sm text-gray-500">
                          <?= htmlspecialchars(t('apt.per_night')) ?>
                        </span>
                      </div>
                    </div>
                  </div>

                  <p class="text-gray-600 text-sm md:text-base">
                    <?php echo htmlspecialchars($a['description'] ?? ''); ?>
                  </p>

                  <!-- META: kreveta / kupaonica / gosti -->
                  <div class="flex flex-wrap items-center gap-4 text-sm text-gray-800">
                    <div class="flex items-center gap-1">
                        <img src="<?= htmlspecialchars(url('assets/images/beds.svg')); ?>" alt="beds" class="meta-icon"> 
                      <?= htmlspecialchars(
                        t('page.apartments.beds', ['count' => (int) ($a['beds'] ?? 0)])
                      ); ?>
                    </div>

                    <div class="flex items-center gap-1">
                      <img src="<?= htmlspecialchars(url('assets/images/baths.svg')); ?>" alt="baths" class="meta-icon"> 
                      <?= htmlspecialchars(
                        t('page.apartments.baths', ['count' => (int) ($a['baths'] ?? 0)])
                      ); ?>
                    </div>

                    <div class="flex items-center gap-1">
                      <img src="<?= htmlspecialchars(url('assets/images/guests.svg')); ?>" alt="guests" class="meta-icon"> 
                      <?= htmlspecialchars(
                        t('page.apartments.guests', ['count' => (int) ($a['guests'] ?? 0)])
                      ); ?>
                    </div>
                  </div>

                  <!-- DUGME ZA DETALJE -->
                  <div class="mt-3 pt-1">
                    <a href="<?php echo htmlspecialchars($detailHref); ?>"
                      class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-mediterranean-orange text-white text-sm font-medium hover:bg-mediterranean-orange-dark">
                      <?= htmlspecialchars(t('page.apartments.view_details')) ?>
                    </a>
                  </div>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </section>
    </div>
  </div>
</main>

<script>
  document.getElementById('sortSelect').addEventListener('change', function(e) {
    const sortValue = e.target.value;
    const params = new URLSearchParams(window.location.search);
    params.set('sort', sortValue);
    window.location.href = window.location.pathname + '?' + params.toString();
  });
</script>

<?php site_footer(); ?>
