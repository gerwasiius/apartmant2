<?php
// 1) Podesive vrijednosti (po želji povuci iz baze)
$googleMapsEmbedSrc = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2813.2775429669397!2d13.95072491554301!3d44.82252397909862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47632bc5b0e7e9c3%3A0x3ae35a8456593302!2sFucane%20122A%2C%2052100%2C%20Medulin%2C%20Croatia!5e0!3m2!1sen!2sus!4v1651234567890!5m2!1sen!2sus';

$attractions = [
  ['name' => 'Medulin Beach', 'distance' => '5 min walk', 'desc' => 'Beautiful sandy beach with crystal clear waters, perfect for families'],
  ['name' => 'Kamenjak Nature Park', 'distance' => '15 min drive', 'desc' => 'Stunning nature reserve with cliffs, beaches, and diverse wildlife'],
  ['name' => 'Pula Arena', 'distance' => '20 min drive', 'desc' => 'Ancient Roman amphitheater, one of the best preserved in the world'],
  ['name' => 'Local Restaurants', 'distance' => '5–10 min walk', 'desc' => 'Authentic Croatian cuisine and fresh seafood in nearby restaurants'],
];
?>
<section class="loc container">
  <div class="loc-grid">
    <!-- Lijeva kolona: lista -->
    <div class="loc-left">
      <div class="loc-title-wrap">
        <h2 class="loc-title"><?= htmlspecialchars(t('location.title')) ?></h2>
        <p class="loc-sub"><?= htmlspecialchars(t('location.subtitle')) ?></p>
      </div>

      <div class="loc-list">
        <?php foreach ($attractions as $item): ?>
          <div class="loc-item">
            <span class="loc-pin" aria-hidden="true">
              <!-- mali inline SVG pin (bez vanjskih ikona) -->
              <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path
                  d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z" />
              </svg>
            </span>
            <div class="loc-item-body">
              <div class="loc-item-line">
                <h3 class="loc-item-title"><?= htmlspecialchars($item['name']) ?></h3>
                <span class="loc-item-distance">(<?= htmlspecialchars($item['distance']) ?>)</span>
              </div>
              <p class="loc-item-desc"><?= htmlspecialchars($item['desc']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Desna kolona: Google mapa -->
    <div class="loc-map-wrap">
      <iframe src="<?= htmlspecialchars($googleMapsEmbedSrc) ?>" loading="lazy" allowfullscreen
        referrerpolicy="no-referrer-when-downgrade" title="Majstorić Apartments Location" class="loc-map-iframe">
      </iframe>

      <!-- Overlay s gradijentom i tekstom preko mape -->
    </div>
  </div>

  <!-- ukrasna “crtica” kao u v0 -->
  <div class="loc-divider">
    <div class="loc-divider-line"></div>
  </div>
</section>