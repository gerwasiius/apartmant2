<?php
// === SAMPLE DATA (6 kom) ============================================
$apartments = [
  [
    'id' => 1,
    'name' => 'Suite Apartment Palma',
    'subName' => 'Suite 1',
    'description' => 'place holder text place holder text place holder text place holder textplace holder textplace holder textplace holder text',
    'price' => 150,
    'beds' => 2,
    'sofaBeds' => 1,
    'baths' => 1,
    'guests' => 4,
    'images' => [['url' => 'https://sssef5nrxfikvijy.public.blob.vercel-storage.com/apartment1-KuIf1L14B2r2oUZ5J0qr7yKDhKDTI2.jpg', 'alt' => 'Palma', 'featured' => true]]
  ],
  [
    'id' => 2,
    'name' => 'Suite Apartment Pinija',
    'subName' => 'Suite 2',
    'description' => 'place holder text',
    'price' => 145,
    'beds' => 2,
    'sofaBeds' => 1,
    'baths' => 1,
    'guests' => 3,
    'images' => [['url' => 'https://sssef5nrxfikvijy.public.blob.vercel-storage.com/apartment1-KuIf1L14B2r2oUZ5J0qr7yKDhKDTI2.jpg', 'alt' => 'Pinija', 'featured' => true]]
  ],
  [
    'id' => 3,
    'name' => 'Studio Apartment Maslina',
    'subName' => 'Studio 3',
    'description' => 'place holder text',
    'price' => 95,
    'beds' => 2,
    'sofaBeds' => 0,
    'baths' => 1,
    'guests' => 3,
    'images' => [['url' => 'https://sssef5nrxfikvijy.public.blob.vercel-storage.com/apartment2-9N8ptVybi9C0stNwAmfb0jfL50zPM4.jpg', 'alt' => 'Maslina', 'featured' => true]]
  ],
  [
    'id' => 4,
    'name' => 'Suite Apartment Lavanda',
    'subName' => 'Suite 4',
    'description' => 'place holder text',
    'price' => 160,
    'beds' => 2,
    'sofaBeds' => 1,
    'baths' => 1,
    'guests' => 4,
    'images' => [['url' => 'https://sssef5nrxfikvijy.public.blob.vercel-storage.com/apartment1-KuIf1L14B2r2oUZ5J0qr7yKDhKDTI2.jpg', 'alt' => 'Lavanda', 'featured' => true]]
  ],
  [
    'id' => 5,
    'name' => 'Suite Apartment Ruzmarin',
    'subName' => 'Suite 5',
    'description' => 'place holder text',
    'price' => 155,
    'beds' => 2,
    'sofaBeds' => 1,
    'baths' => 1,
    'guests' => 4,
    'images' => [['url' => 'https://sssef5nrxfikvijy.public.blob.vercel-storage.com/apartment2-9N8ptVybi9C0stNwAmfb0jfL50zPM4.jpg', 'alt' => 'Ruzmarin', 'featured' => true]]
  ],
  [
    'id' => 6,
    'name' => 'Studio Apartment Bor',
    'subName' => 'Studio 6',
    'description' => 'place holder text',
    'price' => 90,
    'beds' => 2,
    'sofaBeds' => 0,
    'baths' => 1,
    'guests' => 2,
    'images' => [['url' => 'https://sssef5nrxfikvijy.public.blob.vercel-storage.com/apartment1-KuIf1L14B2r2oUZ5J0qr7yKDhKDTI2.jpg', 'alt' => 'Bor', 'featured' => true]]
  ],
];
?>
<section class="apart-section">
  <div class="apart-wrap">
    <div class="apart-container">
      <h2 class="apart-title"><?= htmlspecialchars(t('page.apartments.title')) ?></h2>
      <p class="apart-sub"><?= htmlspecialchars(t('page.apartments.subtitle')) ?></p>

      <div class="apart-carousel mt-5" id="apartmentsCarousel">
        <!-- Strelice su UNUTAR viewporta da budu iznad slika -->
        <button class="apart-nav apart-prev" data-dir="prev" aria-label="Previous">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </button>
        <button class="apart-nav apart-next" data-dir="next" aria-label="Next">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </button>
        <div class="apart-viewport" data-viewport>
          <div class="apart-track" data-track>
            <?php foreach ($apartments as $ap):
              $featured = null;
              foreach (($ap['images'] ?? []) as $img) {
                if (!empty($img['featured'])) {
                  $featured = $img;
                  break;
                }
              }
              if (!$featured && !empty($ap['images']))
                $featured = $ap['images'][0];
              $photosCount = count($ap['images'] ?? []);
              ?>
              <div class="apart-slide">
                <article class="apart-card">
                  <div class="apart-media">
                    <img src="<?= htmlspecialchars($featured['url'] ?? '/placeholder.svg'); ?>"
                      alt="<?= htmlspecialchars($featured['alt'] ?? $ap['name']); ?>">
                    <?php if ($photosCount > 1): ?>
                      <div class="apart-badge"><?= $photosCount; ?> photos</div><?php endif; ?>
                  </div>
                  <div class="apart-body">
                    <h3 class="apart-name"><?= htmlspecialchars($ap['name']); ?></h3>
                    <?php if (!empty($ap['subName'])): ?>
                      <div class="apart-subname"><?= htmlspecialchars($ap['subName']); ?></div><?php endif; ?>
                    <p class="apart-desc"><?= htmlspecialchars($ap['description']); ?></p>
                    <div class="apart-meta">
                      <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M4 12V7a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v5M4 21v-3m16 3v-3M4 15h16v3H4z" />
                        </svg>
                        <?= (int) $ap['beds']; ?> beds
                      </span>
                      <?php if (!empty($ap['sofaBeds'])): ?>
                        <span>
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="8" width="18" height="4" rx="1" />
                            <rect x="2" y="12" width="20" height="6" rx="1" />
                          </svg>
                          <?= (int) $ap['sofaBeds']; ?> sofa bed<?= $ap['sofaBeds'] > 1 ? 's' : ''; ?>
                        </span>
                      <?php endif; ?>
                      <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M3 10h18v6a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5v-6Z" />
                          <path d="M7 10V5a3 3 0 1 1 6 0v5" />
                        </svg>
                        <?= (int) $ap['baths']; ?> bath
                      </span>
                      <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                          <circle cx="9" cy="7" r="4" />
                          <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                          <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <?= (int) $ap['guests']; ?> guests
                      </span>
                    </div>
                  </div>
                  <div class="apart-foot">
                    <div class="apart-price">€<?= (int) $ap['price']; ?> <small>/ night</small></div>
                    <a class="apart-btn" href="/apartments/<?= (int) $ap['id']; ?>">View Details</a>
                  </div>
                </article>
              </div>
            <?php endforeach; ?>
          </div>


        </div>

        <div class="apart-dots" data-dots></div>
      </div>
    </div>
  </div>
</section>