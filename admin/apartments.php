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

<?php admin_head('Apartmani'); ?>

<div class="container px-4 md:px-0 py-4 md:py-8 max-w-6xl mx-auto">
  <!-- Main Content -->
  <main>
    <div class="mb-4 md:mb-6">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
          <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Apartmani</h1>
          <p class="text-sm text-gray-600 mt-1">Pregled i upravljanje smještajima</p>
        </div>

        <div class="flex items-center gap-3">
          <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7 7 0 1110.65 6.65a7 7 0 016.99 10.0z" />
            </svg>
            <input id="aptSearch" type="search" placeholder="Pretraži apartmane..." class="ap-input text-sm pl-10 pr-3 w-48 md:w-64" />
          </div>

          <a href="apartment-edit.php" class="inline-flex items-center gap-2 bg-mediterranean-blue text-white px-4 py-2 rounded-md text-sm hover:opacity-95">+ Novi</a>
        </div>
      </div>
    </div>

    <?php if ($successMsg): ?>
      <div class="mb-4 p-3 md:p-4 bg-green-100 border border-green-300 rounded-lg text-green-800 text-sm">
        <?= htmlspecialchars($successMsg) ?>
      </div>
    <?php endif; ?>

    <!-- Apartments List -->
    <div class="ap-list-wrap">
      <div class="ap-card-body p-0">
        <?php if (empty($apartments)): ?>
          <p class="text-gray-600 p-4">Nema apartmana.</p>
        <?php else: ?>
          <!-- Use client-style cards for admin list -->
          <div id="adminAptList" class="space-y-6">
            <?php foreach ($apartments as $a): ?>
              <?php
                $images = $a['images'] ?? [];
                $img = $images[0] ?? null;
                foreach ($images as $im) {
                  if (!empty($im['featured']) || !empty($im['isFeatured'])) { $img = $im; break; }
                }
                $imgUrl = $img['url'] ?? '';
                $imgAlt = $img['alt'] ?? ($a['name'] ?? 'Apartment');
                $total = count($images);
              ?>

              <article class="admin-apt-card rounded-2xl border border-mediterranean-sand overflow-hidden bg-white shadow-sm hover:shadow-md transition-shadow duration-150">
                <div class="flex flex-col md:flex-row">
                  <div class="md:w-80 lg:w-96 flex-shrink-0">
                    <div class="relative h-48 md:h-full">
                      <?php if ($imgUrl): ?>
                        <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= htmlspecialchars($imgAlt) ?>" class="w-full h-full object-cover md:object-cover md:rounded-l-2xl md:rounded-tr-none rounded-t-2xl" loading="lazy" />
                      <?php else: ?>
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm rounded-t-2xl md:rounded-l-2xl">
                          Nema slike
                        </div>
                      <?php endif; ?>

                      <?php if ($total > 1): ?>
                        <span class="absolute bottom-3 right-3 rounded-full bg-black/70 text-white text-xs px-3 py-1">
                          <?= (int)$total ?> photos
                        </span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="flex-1 p-4 lg:p-6 flex flex-col gap-3">
                    <div class="flex items-start justify-between gap-3">
                      <h2 class="text-lg md:text-xl font-semibold text-mediterranean-blue-dark leading-tight"><?= htmlspecialchars($a['name'] ?? '') ?></h2>

                      <div class="text-right">
                        <div class="flex items-baseline gap-1 justify-end">
                          <span class="font-semibold text-base md:text-lg">€<?= htmlspecialchars((string)($a['price'] ?? '')) ?></span>
                          <span class="text-sm text-gray-500">/n</span>
                        </div>
                      </div>
                    </div>

                    <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed"><?= htmlspecialchars($a['description'] ?? '') ?></p>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-800 mt-1">
                      <div class="flex items-center gap-2">
                        <img src="<?= htmlspecialchars(url('assets/images/beds.svg')) ?>" alt="beds" class="w-4 h-4 opacity-90"> 
                        <span class="text-sm text-gray-700">Sobe: <?= htmlspecialchars(((int)($a['beds'] ?? 0))) ?></span>
                      </div>
                      <div class="flex items-center gap-2">
                        <img src="<?= htmlspecialchars(url('assets/images/baths.svg')) ?>" alt="baths" class="w-4 h-4 opacity-90"> 
                        <span class="text-sm text-gray-700">Kup: <?= htmlspecialchars(((int)($a['baths'] ?? 0))) ?></span>
                      </div>
                      <div class="flex items-center gap-2">
                        <img src="<?= htmlspecialchars(url('assets/images/guests.svg')) ?>" alt="guests" class="w-4 h-4 opacity-90"> 
                        <span class="text-sm text-gray-700">Gosti: <?= htmlspecialchars(((int)($a['guests'] ?? 0))) ?></span>
                      </div>
                    </div>

                    <div class="mt-3 pt-1 flex gap-2">
                      <a href="apartment-edit.php?id=<?= htmlspecialchars((string)$a['id']) ?>" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-mediterranean-blue text-white text-sm font-medium hover:opacity-95">Uređuj</a>
                      <form method="post" action="apartment-delete.php" onsubmit="return confirm('Sigurno obrisati ovaj apartman?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$a['id']) ?>">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-red-300 text-red-600 bg-red-50 text-sm">Obriši</button>
                      </form>
                    </div>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

          <div class="mt-4 text-sm text-gray-600">Ukupno: <strong><?= count($apartments) ?></strong> apartmana</div>
        <?php endif; ?>
      </div>
    </div>
  </main>
</div>

<div id="apNoResults" class="container px-4 md:px-0 py-4 md:py-2 hidden">
  <div class="ap-card">
    <div class="ap-card-body p-4 text-center text-gray-600">Nema rezultata za zadani upit.</div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('aptSearch');
  if (!input) return;

  const cardList = document.querySelectorAll('#adminAptList > article');
  const noResults = document.getElementById('apNoResults');

  function normalize(s){ return (s||'').toString().toLowerCase(); }

  function filter(q){
    const qn = normalize(q);
    let visibleCount = 0;
    // cards
    if (cardList && cardList.length) {
      cardList.forEach(card => {
        const text = normalize(card.textContent);
        const ok = text.indexOf(qn) !== -1;
        card.style.display = ok ? '' : 'none';
        if (ok) visibleCount++;
      });
    }

    // show no results if none
    if (noResults) noResults.classList.toggle('hidden', visibleCount !== 0);
  }

  input.addEventListener('input', function (e) {
    filter(e.target.value.trim());
  });
});
</script>

<?php admin_footer();
