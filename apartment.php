<?php
// apartment.php
require_once __DIR__ . '/config/bootstrap.php';
require_once __DIR__ . '/src/data.php';

// ID: očekujemo rewrite /apartments/1 -> apartment.php?id=1 (kao u listi linkova) :contentReference[oaicite:0]{index=0}
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$apt = $id ? find_apartment($id) : null; // isto kao tvoj api/apartment.php :contentReference[oaicite:1]{index=1}
if (!$apt) {
  http_response_code(404);
  site_head('Not found');
  echo '<main class="container mx-auto px-4 py-12">Not found</main>';
  site_footer();
  exit;
}

site_head(htmlspecialchars($apt['name']) . ' - Apartmani');
?>

<main class="min-h-[60vh] bg-[#FAF7EE]">
  <div class="container mx-auto px-4 py-6 md:py-8">
    <a href="<?php echo url('apartments.php'); ?>"
      class="inline-flex items-center gap-2 text-sm text-gray-700 hover:text-gray-900">
      &larr; Back to All Apartments
    </a>

    <h1 class="mt-2 text-3xl md:text-4xl font-semibold text-mediterranean-blue-dark">
      <?php echo htmlspecialchars($apt['name']); ?>
    </h1>

    <p class="mt-1 text-gray-600">
      <?php echo htmlspecialchars($apt['subName'] ?? ''); ?>
      <?php if (!empty($apt['beds'])): ?> · <?php echo (int) $apt['beds']; ?> bedrooms<?php endif; ?>
      <?php if (!empty($apt['sofaBeds'])): ?> · <?php echo (int) $apt['sofaBeds']; ?> sofa
        bed<?php echo $apt['sofaBeds'] > 1 ? 's' : ''; ?><?php endif; ?>
      <?php if (!empty($apt['baths'])): ?> · <?php echo (int) $apt['baths']; ?> bathroom<?php endif; ?>
      <?php if (!empty($apt['guests'])): ?> · Up to <?php echo (int) $apt['guests']; ?> Guests<?php endif; ?>
    </p>

    <div class="mt-4 grid gap-6 lg:grid-cols-[minmax(0,1fr)_380px]">
      <!-- LEFT: Gallery + Tabs -->
      <section>
        <div class="relative rounded-xl bg-white border border-mediterranean-sand p-3">
          <?php
          // izaberi featured ili prvu (isti obrazac kao liste) :contentReference[oaicite:2]{index=2}
          $images = $apt['images'] ?? [];
          $featured = null;
          foreach ($images as $im) {
            if (!empty($im['featured']) || !empty($im['isFeatured'])) {
              $featured = $im;
              break;
            }
          }
          if (!$featured && !empty($images))
            $featured = $images[0];
          ?>
          <?php if ($featured): ?>
            <div class="relative">
              <img id="hero" src="<?php echo htmlspecialchars($featured['url']); ?>"
                alt="<?php echo htmlspecialchars($featured['alt'] ?? $apt['name']); ?>"
                class="w-full h-[520px] object-cover rounded-lg"
                onerror="this.onerror=null;this.src='/assets/img/placeholder.jpg';">
              <span id="imgCounter"
                class="absolute right-3 bottom-2 bg-black/60 text-white text-xs px-2 py-1 rounded-full">
                1/<?php echo count($images); ?>
              </span>
            </div>
          <?php endif; ?>

          <?php if (!empty($images)): ?>
            <div id="thumbs" class="mt-3 flex gap-3 overflow-x-auto pb-1" role="listbox" aria-label="Gallery thumbnails">
              <?php foreach ($images as $i => $im): ?>
                <button
                  class="relative shrink-0 w-[220px] h-[130px] rounded-lg overflow-hidden border-2 <?php echo $i === 0 ? 'border-blue-300' : 'border-transparent'; ?>"
                  data-index="<?php echo $i; ?>" aria-label="Image <?php echo $i + 1; ?>">
                  <img src="<?php echo htmlspecialchars($im['url']); ?>"
                    alt="<?php echo htmlspecialchars($im['alt'] ?? $apt['name']); ?>" class="w-full h-full object-cover"
                    onerror="this.onerror=null;this.src='/assets/img/placeholder.jpg';">
                </button>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Tabs -->
        <div class="mt-4 grid grid-cols-3 gap-3">
          <button class="tab-btn rounded-lg bg-[#EDE7DA] hover:bg-[#E2D7C3] py-2 px-3 font-medium"
            data-tab="desc">Description</button>
          <button class="tab-btn rounded-lg bg-[#EDE7DA] hover:bg-[#E2D7C3] py-2 px-3"
            data-tab="amen">Amenities</button>
          <button class="tab-btn rounded-lg bg-[#EDE7DA] hover:bg-[#E2D7C3] py-2 px-3" data-tab="rules">House
            Rules</button>
        </div>

        <div class="mt-2 space-y-3">
          <div id="panel-desc" class="rounded-xl bg-white border border-mediterranean-sand p-4">
            <p><?php echo htmlspecialchars($apt['description'] ?? ''); ?></p>
          </div>
          <div id="panel-amen" class="hidden rounded-xl bg-white border border-mediterranean-sand p-4">
            <div class="flex flex-wrap gap-2">
              <?php foreach (($apt['amenities'] ?? []) as $am): ?>
                <span
                  class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm"><?php echo htmlspecialchars($am); ?></span>
              <?php endforeach; ?>
            </div>
          </div>
          <div id="panel-rules" class="hidden rounded-xl bg-white border border-mediterranean-sand p-4">
            <ul class="list-disc pl-6">
              <?php foreach (($apt['houseRules'] ?? []) as $r): ?>
                <li><?php echo htmlspecialchars($r); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </section>

      <!-- RIGHT: Booking card -->
      <aside class="sticky top-4 h-fit">
        <div class="rounded-xl bg-white border border-mediterranean-sand p-5">
          <div class="flex items-baseline gap-2">
            <div class="text-3xl font-semibold" id="priceTop">€<?php echo (int) $apt['price']; ?></div>
            <div class="text-sm text-gray-500">per night</div>
          </div>

          <!-- Dates (koristiš isti ID kao na listingu da radi tvoj calendar.js) :contentReference[oaicite:3]{index=3} -->
          <div class="mt-4">
            <label for="dateRange" class="block text-sm mb-1">Dates</label>
            <input id="dateRange" class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm"
              placeholder="Select dates" />
          </div>

          <!-- Guests (isti ID kao na listingu) :contentReference[oaicite:4]{index=4} -->
          <div class="mt-3">
            <label for="guests" class="block text-sm mb-1">Guests</label>
            <select id="guests" class="w-full rounded-md border border-mediterranean-sand bg-white px-3 py-2 text-sm"
              required aria-required="true">
              <option value="" selected disabled hidden>Guests</option>
              <?php $max = max(1, (int) ($apt['guests'] ?? 4));
              for ($g = 1; $g <= $max; $g++): ?>
                <option value="<?php echo $g; ?>"><?php echo $g; ?>   <?php echo $g === 1 ? 'Guest' : 'Guests'; ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <!-- Breakdown -->
          <div class="mt-4 border-t border-mediterranean-sand pt-3">
            <div class="flex items-center justify-between text-gray-700">
              <div>€<?php echo (int) $apt['price']; ?> × <span id="nights">0</span> night</div>
              <div id="subtotal">0,00 €</div>
            </div>
          </div>

          <div class="mt-3 border-t border-mediterranean-sand pt-3">
            <div class="flex items-center justify-between font-semibold">
              <div>Total</div>
              <div id="total">0,00 €</div>
            </div>
          </div>

          <form method="post" action="/booking/create.php" class="mt-4">
            <input type="hidden" name="apartment_id" value="<?php echo (int) $apt['id']; ?>">
            <input type="hidden" name="from" id="from" value="">
            <input type="hidden" name="to" id="to" value="">
            <input type="hidden" name="guests" id="guestsInput" value="">
            <input type="hidden" name="nights" id="nightsInput" value="0">
            <input type="hidden" name="total" id="totalInput" value="0">
            <button class="w-full rounded-lg bg-mediterranean-blue text-white py-3 font-semibold disabled:opacity-60"
              id="bookBtn" disabled>
              Book Now
            </button>
          </form>

          <p class="mt-2 text-center text-sm text-gray-500">You won't be charged yet</p>
        </div>
      </aside>
    </div>
  </div>
</main>

<?php site_footer(); ?>
<script src="<?php echo url('assets/js/apartment-detail.js'); ?>"></script>