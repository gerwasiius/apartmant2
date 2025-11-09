// Extracted from includes/featured-apartments.php to keep markup clean
(function () {
  const root = document.getElementById('apartmentsCarousel');
  if (!root) return;
  const viewport = root.querySelector('[data-viewport]');
  const track = root.querySelector('[data-track]');
  const dotsWrap = root.querySelector('[data-dots]');
  const prevBtn = root.querySelector('.apart-prev');
  const nextBtn = root.querySelector('.apart-next');
  const slides = Array.from(track.children || []);

  const visibleCount = () => matchMedia('(min-width:768px)').matches ? 3 : 1;
  const pageCount = () => Math.ceil(slides.length / visibleCount());

  let page = 0;

  function updateTransform() {
    if (!track) return;
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
    if (!dotsWrap) return;
    dotsWrap.innerHTML = '';
    for (let i = 0; i < pageCount(); i++) {
      const b = document.createElement('button');
      b.className = 'apart-dot' + (i === page ? ' is-active' : '');
      b.addEventListener('click', () => { page = i; updateTransform(); });
      dotsWrap.appendChild(b);
    }
  }
  function updateDots() {
    if (!dotsWrap) return;
    dotsWrap.querySelectorAll('.apart-dot').forEach((d, i) => d.classList.toggle('is-active', i === page));
  }

  // click handlers
  prevBtn && prevBtn.addEventListener('click', () => go('prev'));
  nextBtn && nextBtn.addEventListener('click', () => go('next'));

  // touch swipe
  let startX = 0, dx = 0, dragging = false;
  viewport && viewport.addEventListener('touchstart', e => { dragging = true; startX = e.touches[0].clientX; }, { passive: true });
  viewport && viewport.addEventListener('touchmove', e => { if (!dragging) return; dx = e.touches[0].clientX - startX; }, { passive: true });
  viewport && viewport.addEventListener('touchend', () => { if (Math.abs(dx) > 40) { go(dx < 0 ? 'next' : 'prev'); } dragging = false; dx = 0; });

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

