<?php
// Load apartments from database
$apartments = load_apartments();
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
                    <?php
                    $imgUrl = $featured['url'] ?? '/placeholder.svg';
                    $imgUrl = str_replace(['/image/','image/','/images/','images/'], 'assets/images/', $imgUrl);
                    ?>
                    <img src="<?= htmlspecialchars($imgUrl); ?>"
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
                        <img src="<?= htmlspecialchars(url('assets/images/beds.svg')); ?>" alt="krevet" class="meta-icon">
                        <?= (int) $ap['beds']; ?> krevet
                      </span>
                      <?php if (!empty($ap['sofaBeds'])): ?>
                        <span>
                          <img src="<?= htmlspecialchars(url('assets/images/sofabed.svg')); ?>" alt="secija" class="meta-icon">
                            <?= (int) $ap['sofaBeds']; ?> secija<?= $ap['sofaBeds'] > 1 ? 's' : ''; ?>
                        </span>
                      <?php endif; ?>
                      <span>
                        <img src="<?= htmlspecialchars(url('assets/images/baths.svg')); ?>" alt="kupatilo" class="meta-icon">
                        <?= (int) $ap['baths']; ?> kupatilo
                      </span>
                      <span>
                        <img src="<?= htmlspecialchars(url('assets/images/guests.svg')); ?>" alt="gosti" class="meta-icon">
                        <?= (int) $ap['guests']; ?> gosti
                      </span>
                    </div>
                  </div>
                  <div class="apart-foot">
                    <div class="apart-price">€<?= (int) $ap['price']; ?> <small>/ night</small></div>
                    <a
                      class="apart-btn"
                      href="<?= htmlspecialchars(url('pages/apartment.php?id=' . (int) $ap['id'])); ?>">
                      <?= htmlspecialchars(t('page.apartments.view_details')); ?>
                    </a>
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
