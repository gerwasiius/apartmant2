<?php
// 1) Podesive vrijednosti (po želji povuci iz baze)
$addressText = 'Fucane 122A, 52100, Medulin, Croatia';
$addressNote = 'Our location in Medulin';
$googleMapsEmbedSrc = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2813.2775429669397!2d13.95072491554301!3d44.82252397909862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47632bc5b0e7e9c3%3A0x3ae35a8456593302!2sFucane%20122A%2C%2052100%2C%20Medulin%2C%20Croatia!5e0!3m2!1sen!2sus!4v1651234567890!5m2!1sen!2sus';

$attractions = [
  ['name' => 'Medulin Beach',         'distance' => '5 min walk',  'desc' => 'Beautiful sandy beach with crystal clear waters, perfect for families'],
  ['name' => 'Kamenjak Nature Park',  'distance' => '15 min drive','desc' => 'Stunning nature reserve with cliffs, beaches, and diverse wildlife'],
  ['name' => 'Pula Arena',            'distance' => '20 min drive','desc' => 'Ancient Roman amphitheater, one of the best preserved in the world'],
  ['name' => 'Local Restaurants',     'distance' => '5–10 min walk','desc' => 'Authentic Croatian cuisine and fresh seafood in nearby restaurants'],
];
?>
<section class="loc container">
  <div class="loc-grid">
    <!-- Lijeva kolona: lista -->
    <div class="loc-left">
      <div class="loc-title-wrap">
        <h2 class="loc-title">Explore the area</h2>
        <p class="loc-sub">Everything you need is just minutes away.</p>
      </div>

      <div class="loc-list">
        <?php foreach ($attractions as $item): ?>
          <div class="loc-item">
            <span class="loc-pin" aria-hidden="true">
              <!-- mali inline SVG pin (bez vanjskih ikona) -->
              <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/>
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
      <iframe
        src="<?= htmlspecialchars($googleMapsEmbedSrc) ?>"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        title="Majstorić Apartments Location"
        class="loc-map-iframe">
      </iframe>

      <!-- Overlay s gradijentom i tekstom preko mape -->
      <div class="loc-map-overlay">
        <div class="loc-map-chip">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true">
            <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/>
          </svg>
          <span><?= htmlspecialchars($addressNote) ?></span>
        </div>
        <p class="loc-map-address"><?= htmlspecialchars($addressText) ?></p>
      </div>
    </div>
  </div>

  <!-- ukrasna “crtica” kao u v0 -->
  <div class="loc-divider">
    <div class="loc-divider-line"></div>
  </div>
</section>

<style>
/* ---- Tema / boje (preuzeto iz v0 palete) ---- */
:root{
  --med-beige:#F5EFE0;
  --med-sand:#E8DCCA;
  --med-blue:#3A7CA5;
  --med-blue-dark:#2A5F8F;
  --med-orange:#E67E22;
  --text:#1b1b1b;
  --muted:#6b7280;
}

/* ---- Layout ---- */
.container{max-width:1200px;margin:0 auto;padding:2rem;}
.loc-grid{display:grid;gap:3rem;align-items:center;}
@media (min-width:768px){.loc-grid{grid-template-columns:1fr 1fr;}}

.loc-left{display:flex;flex-direction:column;gap:1.5rem;}
.loc-title{font-size:clamp(1.6rem,2.5vw,2rem);font-weight:800;color:var(--med-blue-dark);margin:0;}
.loc-sub{color:var(--muted);margin:.25rem 0 0;}

.loc-list{display:flex;flex-direction:column;gap:1rem;}
.loc-item{display:flex;gap:.75rem;align-items:flex-start;}
.loc-pin{color:var(--med-orange);margin-top:.15rem;flex:0 0 20px;}
.loc-item-body{flex:1;min-width:0;}
.loc-item-line{display:flex;flex-wrap:wrap;align-items:center;gap:.5rem;}
.loc-item-title{font-weight:600;color:var(--med-blue-dark);margin:0;}
.loc-item-distance{color:var(--muted);font-size:.9rem;}
.loc-item-desc{color:var(--muted);margin:.2rem 0 0;font-size:.95rem;line-height:1.35;}

.loc-map-wrap{position:relative;border-radius:14px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,.08);background:#f3f4f6;}
.loc-map-iframe{display:block;width:100%;height:0;padding-bottom:100%; /* square on mobile */
  border:0;}
@media (min-width:768px){.loc-map-iframe{padding-bottom:66%;}} /* ~16:9 on desktop */

/* overlay s gradijentom kao u v0 */
.loc-map-overlay{
  pointer-events:none;
  position:absolute;inset:0;display:flex;align-items:flex-end;
  background:linear-gradient(to top, rgba(0,0,0,.55), transparent 45%);
  padding:1rem;
}
.loc-map-chip{
  display:inline-flex;align-items:center;gap:.5rem;
  background:rgba(255,255,255,.15);color:#fff;
  padding:.35rem .6rem;border-radius:999px;font-weight:600;font-size:.9rem;
  margin-bottom:.35rem;
}
.loc-map-address{color:#fff;opacity:.9;margin:.15rem 0 0;font-size:.95rem}

/* donja ukrasna crtica */
.loc-divider{position:relative;height:2rem;display:flex;justify-content:center;align-items:flex-end;}
.loc-divider-line{width:2px;height:2rem;background:var(--med-sand);}
</style>
