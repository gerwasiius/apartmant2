<?php
// === SAMPLE DATA (6 kom) ============================================
$apartments = [
  [
    'id' => 1,
    'name' => 'Suite Apartment Palma',
    'subName' => 'Suite 1',
    'description' => 'place holder text',
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
<style>
  :root {
    --med-beige: #F5EFE0;
    --med-sand: #E8DCCA;
    --med-blue: #3A7CA5;
    --med-blue-dark: #2A5F8F;
    --med-orange: #E67E22;
    --med-orange-dark: #D35400;
    --border: #e6dfcf;
  }

  .apart-section {
    background: #FAF7EE;
  }

  .apart-wrap {
    padding: 3rem 1rem
  }

  .apart-container {
    max-width: 1200px;
    margin: 0 auto
  }

  .apart-title {
    font-weight: 800;
    color: var(--med-blue-dark);
    text-align: center;
    font-size: clamp(28px, 3.2vw, 40px)
  }

  .apart-sub {
    color: #667085;
    text-align: center;
    max-width: 900px;
    margin: .5rem auto 0;
    font-size: clamp(15px, 1.2vw, 18px)
  }

.apart-carousel{ position:relative; }               /* referenca za strelice */

.apart-viewport{ position:relative; overflow:hidden; }

  .apart-track {
    display: flex;
    transition: transform .35s ease-in-out;
    will-change: transform
  }

  .apart-slide {
    padding: 0 .75rem;
    flex: 0 0 100%
  }

  @media(min-width:768px) {
    .apart-slide {
      flex-basis: 33.3333%
    }
  }

  .apart-card {
    background: #fff;
    border: 1px solid var(--med-sand);
    border-radius: 12px;
    overflow: hidden;
    transition: box-shadow .2s
  }

  .apart-card:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, .07)
  }

  .apart-media {
    position: relative;
    padding-top: 75%;
    overflow: hidden
  }

  .apart-media img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s
  }

  .apart-card:hover .apart-media img {
    transform: scale(1.05)
  }

  .apart-badge {
    position: absolute;
    right: .5rem;
    bottom: .5rem;
    background: rgba(0, 0, 0, .5);
    color: #fff;
    border-radius: 999px;
    font-size: 12px;
    padding: .15rem .5rem
  }

  .apart-body {
    padding: 1rem
  }

  .apart-name {
    color: var(--med-blue-dark);
    font-weight: 700;
    font-size: 18px;
    margin: 0
  }

  .apart-subname {
    color: #98a2b3;
    font-size: 12px;
    margin-top: 2px
  }

  .apart-desc {
    color: #667085;
    font-size: 14px;
    margin: .5rem 0 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden
  }

  .apart-meta {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-top: 1rem;
    color: #0f172a;
    font-size: 14px
  }

  .apart-meta svg {
    width: 16px;
    height: 16px;
    margin-right: 4px;
    color: var(--med-blue)
  }

  .apart-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 1rem 1rem
  }

  .apart-price {
    color: var(--med-blue-dark);
    font-weight: 700
  }

  .apart-price small {
    color: #98a2b3;
    font-weight: 400
  }

  .apart-btn {
    background: var(--med-orange);
    color: #fff;
    border: 0;
    border-radius: 8px;
    padding: .5rem .75rem;
    font-size: 14px;
    cursor: pointer
  }

  .apart-btn:hover {
    background: var(--med-orange-dark)
  }

  /* Strelice – iznad slika i klikabilne */
  .apart-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #ffffffcc;
    border-radius: 999px;
    padding: .5rem;
    border: 0;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
    cursor: pointer;
    z-index: 10;
    line-height: 0
  }

  .apart-nav svg {
    color: var(--med-blue-dark);
    width: 24px;
    height: 24px
  }

.apart-prev,
.apart-next{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  width:40px; height:40px;
  display:flex; align-items:center; justify-content:center;
  background: rgb(255, 255, 255, 0.8)
  border:none; border-radius:999px;
  box-shadow:0 2px 8px rgba(0,0,0,.15);
  z-index:20; cursor:pointer;
  pointer-events:auto;
}
.apart-prev{ left:-18px; }
.apart-next{ right:-18px; }

  .apart-prev svg,
  .apart-next svg {
    width: 22px;
    height: 22px;
    color: #2A5F8F;
  }

  @media (max-width:767px) {
    .apart-prev {
      left: 8px;
    }

    .apart-next {
      right: 8px;
    }
  }
  @media (max-width:767px) {
    .apart-prev {
      left: 8px
    }

    .apart-next {
      right: 8px
    }
  }

  .apart-dots {
    display: flex;
    justify-content: center;
    gap: .5rem;
    margin-top: 1rem
  }

  .apart-dot {
    width: 8px;
    height: 8px;
    border-radius: 999px;
    background: rgba(58, 124, 165, .3);
    border: 0;
    cursor: pointer
  }

  .apart-dot.is-active {
    width: 24px;
    background: var(--med-blue);
    transition: all .2s
  }
</style>

<section class="apart-section">
  <div class="apart-wrap">
    <div class="apart-container">
      <h2 class="apart-title">Our Apartments</h2>
      <p class="apart-sub">Choose from our selection of comfortable and well-equipped apartments</p>

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

<script>
  (function () {
    const root = document.getElementById('apartmentsCarousel');
    const viewport = root.querySelector('[data-viewport]');
    const track = root.querySelector('[data-track]');
    const dotsWrap = root.querySelector('[data-dots]');
    const prevBtn = root.querySelector('.apart-prev');
    const nextBtn = root.querySelector('.apart-next');
    const slides = Array.from(track.children);

    const visibleCount = () => matchMedia('(min-width:768px)').matches ? 3 : 1;
    const pageCount = () => Math.ceil(slides.length / visibleCount());

    let page = 0;

    function updateTransform() {
      track.style.transform = `translateX(${-page * 100}%)`;
      updateDots();
    }
    function go(dir) {
      const total = pageCount();
      page = (page + (dir === 'next' ? 1 : -1) + total) % total; // wrap-around
      updateTransform();
    }

    // dots
    function buildDots() {
      dotsWrap.innerHTML = '';
      for (let i = 0; i < pageCount(); i++) {
        const b = document.createElement('button');
        b.className = 'apart-dot' + (i === page ? ' is-active' : '');
        b.addEventListener('click', () => { page = i; updateTransform(); });
        dotsWrap.appendChild(b);
      }
    }
    function updateDots() {
      dotsWrap.querySelectorAll('.apart-dot').forEach((d, i) => d.classList.toggle('is-active', i === page));
    }

    // click strelice
    prevBtn.addEventListener('click', () => go('prev'));
    nextBtn.addEventListener('click', () => go('next'));

    // (opciono) swipe bez autoplay-a
    let startX = 0, dx = 0, dragging = false;
    viewport.addEventListener('touchstart', e => { dragging = true; startX = e.touches[0].clientX; }, { passive: true });
    viewport.addEventListener('touchmove', e => { if (!dragging) return; dx = e.touches[0].clientX - startX; }, { passive: true });
    viewport.addEventListener('touchend', () => { if (Math.abs(dx) > 40) { go(dx < 0 ? 'next' : 'prev'); } dragging = false; dx = 0; });

    // init
    buildDots();
    updateTransform();

    // resize -> reset + rebuild dots
    let resizeTO = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTO);
      resizeTO = setTimeout(() => { page = 0; buildDots(); updateTransform(); }, 150);
    });
  })();
</script>