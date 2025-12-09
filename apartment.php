<?php
// apartment.php
require_once __DIR__ . '/config/bootstrap.php';
require_once __DIR__ . '/src/data.php';

// ID: očekujemo rewrite /apartments/1 -> apartment.php?id=1 (kao u listi linkova)
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$apt = $id ? find_apartment($id) : null;

if (!$apt) {
  http_response_code(404);
  site_head(htmlspecialchars(t('generic.not_found')) . ' - ' . t('app.name'));
  echo '<main class="container mx-auto px-4 py-12">' . htmlspecialchars(t('generic.not_found')) . '</main>';
  site_footer();
  exit;
}

site_head(htmlspecialchars($apt['name'] ?? '') . ' - ' . t('app.name'));
?>

<main class="min-h-[60vh] bg-[#FAF7EE]">
  <div class="container mx-auto px-4 py-6 md:py-8">
    <a href="<?php echo url('apartments.php'); ?>"
      class="inline-flex items-center gap-2 text-base font-medium text-mediterranean-blue-dark hover:text-mediterranean-blue">
      <?= htmlspecialchars(t('apt.back_to_all')) ?>
    </a>

    <h1 class="mt-2 text-3xl md:text-4xl font-semibold text-mediterranean-blue-dark">
      <?php echo htmlspecialchars($apt['name'] ?? ''); ?>
    </h1>

    <?php if (!empty($apt['subName'])): ?>
      <p class="mt-1 text-gray-500 text-sm"><?php echo htmlspecialchars($apt['subName']); ?></p>
    <?php endif; ?>

    <div class="mt-2 flex items-center gap-6 text-gray-600 text-sm">
      <?php if (!empty($apt['beds'])): ?>
        <span class="inline-flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="10" rx="2"/><path d="M8 7v-2a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
          <span><?php echo strtr(t('page.apartments.beds'), ['{count}' => (int) $apt['beds']]); ?></span>
        </span>
      <?php endif; ?>

      <?php if (!empty($apt['baths'])): ?>
        <span class="inline-flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/></svg>
          <span><?php echo strtr(t('page.apartments.baths'), ['{count}' => (int) $apt['baths']]); ?></span>
        </span>
      <?php endif; ?>

      <?php if (!empty($apt['guests'])): ?>
        <span class="inline-flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          <span><?php echo strtr(t('page.apartments.guests'), ['{count}' => (int) $apt['guests']]); ?></span>
        </span>
      <?php endif; ?>
    </div>

    <div class="mt-4 grid gap-6 lg:grid-cols-[minmax(0,1fr)_380px]">
      <!-- LEFT: Gallery + Tabs -->
      <section>
        <div class="relative rounded-xl bg-white border border-mediterranean-sand p-3">
          <?php
          // izaberi featured ili prvu
          $images = $apt['images'] ?? [];
          $featured = null;
          foreach ($images as $im) {
            if (!empty($im['featured']) || !empty($im['isFeatured'])) {
              $featured = $im;
              break;
            }
          }
          if (!$featured && !empty($images)) {
            $featured = $images[0];
          }
          ?>
          <?php if ($featured): ?>
            <div class="relative">
              <img id="hero" src="<?php echo htmlspecialchars($featured['url']); ?>"
                alt="<?php echo htmlspecialchars($featured['alt'] ?? ($apt['name'] ?? '')); ?>"
                class="w-full h-[260px] md:h-[360px] lg:h-[420px] object-cover rounded-lg" />
              <?php $total = count($images); ?>
              <?php if ($total > 1): ?>
                <div
                  class="absolute bottom-3 left-3 bg-black/60 text-white text-xs px-2 py-1 rounded-full flex items-center gap-2">
                  <span id="imgCounter">1/<?php echo $total; ?></span>
                </div>
              <?php endif; ?>
            </div>

            <?php if ($total > 1): ?>
              <div id="thumbs"
                class="mt-3 grid grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 max-h-[120px] overflow-y-auto pr-1">
                <?php foreach ($images as $idx => $im): ?>
                  <button type="button" data-index="<?php echo (int) $idx; ?>"
                    class="relative rounded-md overflow-hidden border border-transparent hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:ring-offset-1">
                    <img src="<?php echo htmlspecialchars($im['url']); ?>"
                      alt="<?php echo htmlspecialchars($im['alt'] ?? ($apt['name'] ?? '')); ?>"
                      class="w-full h-[70px] object-cover" loading="lazy" />
                  </button>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <div class="h-[260px] md:h-[360px] lg:h-[420px] flex items-center justify-center bg-gray-100 rounded-lg">
              <span class="text-gray-500 text-sm">No image available</span>
            </div>
          <?php endif; ?>
        </div>

        <!-- Tabs -->
        <div class="border-b border-mediterranean-sand mt-6">
          <div class="flex gap-6 text-sm">
            <button type="button"
              class="tab-btn pb-3 border-b-2 border-mediterranean-blue text-mediterranean-blue-dark font-semibold"
              data-tab="desc">
              <?= htmlspecialchars(t('apt.description')) ?>
            </button>
            <button type="button" class="tab-btn pb-3 border-b-2 border-transparent text-gray-700" data-tab="amen">
              <?= htmlspecialchars(t('apt.amenities')) ?>
            </button>
            <button type="button" class="tab-btn pb-3 border-b-2 border-transparent text-gray-700" data-tab="rules">
              <?= htmlspecialchars(t('apt.rules')) ?>
            </button>
          </div>
        </div>

        <!-- Tab panels -->
        <div class="mt-4">
          <!-- Description -->
          <article id="panel-desc" class="space-y-4">
            <?php if (!empty($apt['longDescription'])): ?>
              <p class="text-gray-700 leading-relaxed">
                <?php echo nl2br(htmlspecialchars($apt['longDescription'])); ?>
              </p>
            <?php elseif (!empty($apt['description'])): ?>
              <p class="text-gray-700 leading-relaxed">
                <?php echo nl2br(htmlspecialchars($apt['description'])); ?>
              </p>
            <?php endif; ?>

            <!-- Reviews/ratings removed as per site requirements -->
          </article>

          <!-- Amenities -->
          <article id="panel-amen" class="hidden">
            <?php if (!empty($apt['amenities']) && is_array($apt['amenities'])): ?>
              <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-gray-700 text-sm">
                <?php foreach ($apt['amenities'] as $amen): ?>
                  <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 20 20"
                      fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 9.207a1 1 0 011.414-1.414L8.5 11.586l6.793-6.793a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                    </svg>
                    <span><?php echo htmlspecialchars($amen); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="text-gray-500 text-sm">Amenities information is not available.</p>
            <?php endif; ?>
          </article>


          <!-- House Rules -->
          <article id="panel-rules" class="hidden">
            <?php if (!empty($apt['rules']) && is_array($apt['rules'])): ?>
              <ul class="list-disc pl-5 space-y-1 text-gray-700 text-sm">
                <?php foreach ($apt['rules'] as $rule): ?>
                  <li><?php echo htmlspecialchars($rule); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="text-gray-500 text-sm">House rules information is not available.</p>
            <?php endif; ?>
          </article>
        </div>
      </section>

      <!-- RIGHT: Booking card -->
      <aside class="ap-sidebar">
        <div class="ap-sidebar-inner rounded-xl bg-white border border-mediterranean-sand p-4 shadow-sm">
          <div class="flex items-baseline justify-between gap-3">
            <div class="flex items-baseline gap-1">
              <span class="text-2xl font-semibold text-mediterranean-blue-dark">
                €<span id="priceTop"><?php echo (int) ($apt['price'] ?? 0); ?></span>
              </span>
              <span class="text-gray-600 text-sm">
                <?= htmlspecialchars(t('apt.per_night')) ?>
              </span>
            </div>

            <!-- Rating/reviews intentionally removed -->
          </div>

          <form class="mt-4 space-y-4" method="post" action="#">
            <!-- Dates -->
            <div class="flex flex-col gap-1">
              <div class="flex items-center gap-2 text-sm text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  aria-hidden="true">
                  <rect x="3" y="4" width="18" height="18" rx="2" />
                  <line x1="16" y1="2" x2="16" y2="6" />
                  <line x1="8" y1="2" x2="8" y2="6" />
                  <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                <span class="font-medium">
                  <?= htmlspecialchars(t('apt.dates')) ?>
                </span>
              </div>
              <label for="dateRange" class="sr-only">
                <?= htmlspecialchars(t('apt.dates')) ?>
              </label>
              <input id="dateRange" type="text" name="dates" class="input-sand-apartments w-full rounded-md px-3 py-2 text-sm"
                placeholder="<?= htmlspecialchars(t('apt.dates_placeholder')) ?>" autocomplete="off" />
            </div>

            <!-- Guests -->
            <div class="flex flex-col gap-1">
              <div class="flex items-center gap-2 text-sm text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mediterranean-blue" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  aria-hidden="true">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                  <circle cx="9" cy="7" r="4" />
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <span class="font-medium">
                  <?= htmlspecialchars(t('apt.guests')) ?>
                </span>
              </div>
              <label for="guests" class="sr-only">
                <?= htmlspecialchars(t('apt.guests')) ?>
              </label>
              <select id="guests" name="guestsSelect" class="input-sand-apartments w-full rounded-md px-3 py-2 text-sm">
                <option value="" disabled selected hidden>
                  <?= htmlspecialchars(t('apt.guests_placeholder')) ?>
                </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>

            <div id="priceBreakdown" class="space-y-2 text-sm text-gray-700 border-t pt-3 mt-4 hidden">
              <div class="flex items-baseline justify-between">
                <p>
                  €<span id="priceBottom"><?php echo (int) ($apt['price'] ?? 0); ?></span>
                  × <span id="nights">0</span>
                  <?= htmlspecialchars(t('apt.night')) ?>
                </p>
                <p id="subtotal" class="font-medium">€0</p>
              </div>

              <div class="flex items-baseline justify-between font-semibold">
                <p><?= htmlspecialchars(t('apt.total')) ?></p>
                <p id="total" class="font-semibold text-mediterranean-blue-dark">€0</p>
              </div>
            </div>

            <!-- Hidden fields (za pravi booking kasnije) -->
            <input type="hidden" name="from" id="from">
            <input type="hidden" name="to" id="to">
            <input type="hidden" name="guests" id="guestsInput">
            <input type="hidden" name="nights" id="nightsInput">
            <input type="hidden" name="total" id="totalInput">

            <button id="bookBtn" type="submit"
              class="w-full mt-2 inline-flex items-center justify-center rounded-md bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white px-4 py-2 text-sm font-medium"
              disabled>
              <?= htmlspecialchars(t('apt.book_now')) ?>
            </button>

            <p class="text-[11px] text-gray-500 text-center mt-1">
              <?= htmlspecialchars(t('apt.not_charged')) ?>
            </p>
          </form>
        </div>
      </aside>
    </div>
  </div>
</main>

<script src="<?php echo htmlspecialchars(url('assets/js/apartment-detail.js')); ?>"></script>
<?php site_footer(); ?>