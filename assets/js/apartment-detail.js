// assets/js/apartment-detail.js
(function () {
  // ---- Gallery ----
  const thumbs = Array.from(document.querySelectorAll('#thumbs [data-index]'));
  const hero = document.getElementById('hero');
  const counter = document.getElementById('imgCounter');

  if (thumbs.length && hero && counter) {
    thumbs.forEach((btn) => {
      btn.addEventListener('click', () => {
        const i = parseInt(btn.dataset.index, 10) || 0;
        const img = btn.querySelector('img');
        if (!img) return;

        hero.src = img.src;
        hero.alt = img.alt || '';
        counter.textContent = (i + 1) + '/' + thumbs.length;

        thumbs.forEach((t) => t.classList.remove('border-blue-300'));
        btn.classList.add('border-blue-300');
      });
    });
  }

  // ---- Tabs ----
  const tabs = document.querySelectorAll('.tab-btn');
  const panels = {
    desc: document.getElementById('panel-desc'),
    amen: document.getElementById('panel-amen'),
    rules: document.getElementById('panel-rules'),
  };

  function show(panel) {
    Object.values(panels).forEach((p) => p && p.classList.add('hidden'));
    if (panels[panel]) {
      panels[panel].classList.remove('hidden');
    }
    tabs.forEach((t) => t.classList.remove('font-medium'));
    const active = Array.from(tabs).find((t) => t.dataset.tab === panel);
    if (active) {
      active.classList.add('font-medium');
    }
  }

  if (tabs.length) {
    tabs.forEach((t) => t.addEventListener('click', () => show(t.dataset.tab)));
    show('desc');
  }

  // ---- Booking calc ----
  const fmt = new Intl.NumberFormat('hr-HR', { style: 'currency', currency: 'EUR' });

  const priceEl = document.getElementById('priceTop');
  const PRICE = priceEl ? Number(priceEl.textContent.replace(/[^\d]/g, '')) : 0;

  const CLEANING_FEE = 50; // isto kao v0
  const SERVICE_RATE = 0.10;

  const dateInput  = document.getElementById('dateRange'); // isti ID kao na listingu
  const guests     = document.getElementById('guests');
  const nightsEl   = document.getElementById('nights');
  const subtotalEl = document.getElementById('subtotal');
  const serviceEl  = document.getElementById('service');
  const totalEl    = document.getElementById('total');
  const fromH      = document.getElementById('from');
  const toH        = document.getElementById('to');
  const guestsH    = document.getElementById('guestsInput');
  const nightsH    = document.getElementById('nightsInput');
  const totalH     = document.getElementById('totalInput');
  const bookBtn    = document.getElementById('bookBtn');

  // Ako ključni elementi ne postoje, ne radi booking logiku da ne puca JS.
  if (
    !nightsEl ||
    !subtotalEl ||
    !serviceEl ||
    !totalEl ||
    !fromH ||
    !toH ||
    !guestsH ||
    !nightsH ||
    !totalH ||
    !bookBtn
  ) {
    return;
  }

  function parseRange(val) {
    // Pokušaj parsirati ISO datume iz inputa; ako ne uspije, padaj na URL query parametre.
    let from = null;
    let to = null;

    if (val) {
      const normalized = val.replace(/\s*[\u2013-]\s*/g, ' - ');
      const m = normalized.match(/(\d{4}-\d{2}-\d{2}).*?(\d{4}-\d{2}-\d{2})/);
      if (m) {
        from = new Date(m[1] + 'T00:00:00');
        to = new Date(m[2] + 'T00:00:00');
      }
    }

    if (!from || !to) {
      try {
        const url = new URL(window.location.href);
        const fromQ = url.searchParams.get('from');
        const toQ = url.searchParams.get('to');
        if (fromQ && toQ) {
          from = new Date(fromQ + 'T00:00:00');
          to = new Date(toQ + 'T00:00:00');
        }
      } catch (e) {
        // Stari browser bez URL API-ja – samo ignoriraj.
      }
    }

    return { from, to };
  }

  function diffNights(a, b) {
    const MS = 86400000;
    return Math.max(0, Math.round((b - a) / MS));
  }

  function recalc() {
    const range = parseRange(dateInput ? dateInput.value : '');
    const from = range.from;
    const to   = range.to;

    const n = (from && to) ? diffNights(from, to) : 0;
    nightsEl.textContent = String(n);

    const room = PRICE * n;
    const service = Math.round(room * SERVICE_RATE);
    const total = n > 0 ? (room + CLEANING_FEE + service) : 0;

    subtotalEl.textContent = fmt.format(room);
    serviceEl.textContent = fmt.format(service);
    totalEl.textContent = fmt.format(total);

    nightsH.value = String(n);
    totalH.value = String(total);
    guestsH.value = guests ? (guests.value || '') : '';

    const guestsOk = !!(guests && guests.value);
    if (from && to && n > 0 && guestsOk) {
      fromH.value = from.toISOString().slice(0, 10);
      toH.value = to.toISOString().slice(0, 10);
      bookBtn.disabled = false;
    } else {
      fromH.value = '';
      toH.value = '';
      bookBtn.disabled = true;
    }
  }

  if (dateInput) dateInput.addEventListener('change', recalc);
  if (guests) guests.addEventListener('change', recalc);
  recalc();
})();
