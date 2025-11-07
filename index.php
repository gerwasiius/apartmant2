<?php
require __DIR__ . "/head.php";
require __DIR__ . "/data.php";
$apartments = load_apartments();
site_head("Home — Apartmani");
?>
<main>
  <!-- Hero (slider + logo + calendar overlay) -->
<section class="relative w-full py-12 md:py-24 lg:py-32 xl:py-48 overflow-hidden">
  <!-- Pozadinske slike (slajder) -->
  <div class="absolute inset-0 z-0 overflow-hidden" id="heroSlides">
    <!-- Svaka slika je apsolutno pozicionirana; vidljivost kontroliramo klasom opacity -->
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-100">
      <img src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_03-sTrj0FWeVwaVLEx4LMu3XOJ1yQw7Ew.jpg"
           alt="Majstorić Apartments Medulin - Beachfront View"
           class="w-full h-full object-cover brightness-[0.7]">
    </div>
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-0">
      <img src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_01-Zb3VWXlbwrDW4oSKbkxEFakJqBsHWF.jpg"
           alt="Majstorić Apartments Medulin - Pool Area"
           class="w-full h-full object-cover brightness-[0.7]">
    </div>
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-0">
      <img src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_04-RXy7J36ANhk6TDY2xRPEv7nmFfhsSN.jpg"
           alt="Majstorić Apartments Medulin - Garden View"
           class="w-full h-full object-cover brightness-[0.7]">
    </div>
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-0">
      <img src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_05-ku1RnxiewNhyHx2STxxzU8Rg3yacLR.jpg"
           alt="Majstorić Apartments Medulin - Apartment Interior"
           class="w-full h-full object-cover brightness-[0.7]">
    </div>

    <!-- Tačkice (indikatori) -->
    <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2 z-10" id="heroDots"></div>

    <!-- Strelice -->
    <button id="heroPrev"
      class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition-colors z-10 hidden md:block"
      aria-label="Previous image">
      <!-- lucide-chevron-left -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
    </button>
    <button id="heroNext"
      class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition-colors z-10 hidden md:block"
      aria-label="Next image">
      <!-- lucide-chevron-right -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

  <!-- Overlay sadržaj (logo + „booking” kartica s kalendarom) -->
  <div class="relative z-10">
  <div class="container flex flex-col items-center justify-center text-center">
    <!-- Desktop logo (kao u V0) -->
    <div class="hidden md:block mb-8 relative w-[410px] h-[310px]">
      <img
        src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/palm-beach-logo-1-o%20Kopie-02-jdHsQrQl0cIAN4akDSRGhM6C53uZ28.svg"
        alt="Majstorić Apartments Logo - Desktop"
        class="object-contain w-full h-full drop-shadow-lg" />
    </div>
    <!-- Mobile logo (kompaktan) -->
    <div class="md:hidden mb-6 h-16 w-16">
      <img
        src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/palm-beach-logo-1-o%20icon-02-yrnUt3aNszyDhZvQJhrct0gru5qyhz.svg"
        alt="Majstorić Apartments Logo - Mobile"
        class="object-contain w-full h-full drop-shadow" />
    </div>

    <!-- Kalendar (date range) u kartici -->
    <!-- Kalendar + Guests (V0-like) -->
<div class="w-full max-w-md rounded-2xl booking-card backdrop-blur p-4 shadow">
  <div class="flex items-center gap-2 mb-3">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mediterranean-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1M6 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2"/>
    </svg>
    <span class="font-medium">Odaberite datume i goste</span>
  </div>

  <!-- grid: Date range + Guests + CTA -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
    <div class="sm:col-span-2">
      <label for="dateRange" class="sr-only">Datumi</label>
      <input id="dateRange"
             class="input-sand w-full rounded-md px-3 py-2 text-sm"
             placeholder="Od — Do" />
    </div>

    <div>
      <label for="guests" class="sr-only">Guests</label>
      <select id="guests"
              class="input-sand w-full rounded-md px-3 py-2 text-sm">
        <option value="1">1 guest</option>
        <option value="2" selected>2 guests</option>
        <option value="3">3 guests</option>
        <option value="4">4 guests</option>
        <option value="5">5 guests</option>
        <option value="6">6 guests</option>
        <option value="6plus">6+ guests</option>
      </select>
    </div>

    <button id="searchBtn"
            class="sm:col-span-3 mt-1 w-full px-4 py-2 rounded-lg bg-mediterranean-blue text-white hover:opacity-90">
      Pretraži dostupnost
    </button>
  </div>

  <p class="mt-2 text-xs text-gray-600">Range s 2 mjeseca, beige/sand tonovi kao u v0.</p>
</div>


  </div>
</div>
</section>

<script>
// --- HERO slider (V0-like): auto-rotacija, tačkice, strelice ---
// Logika prati V0 ponašanje: auto-rotate na 5s, glatke tranzicije, dot/arrow navigacija
// (u V0: automatska promjena slike, 1000ms fade, strelice i tačkice) :contentReference[oaicite:3]{index=3} :contentReference[oaicite:4]{index=4} :contentReference[oaicite:5]{index=5}
(function(){
  const slidesRoot = document.getElementById('heroSlides');
  const slides = Array.from(slidesRoot.children).filter(n => n.classList.contains('absolute'));
  const dotsRoot = document.getElementById('heroDots');
  const btnPrev = document.getElementById('heroPrev');
  const btnNext = document.getElementById('heroNext');
  let current = 0;
  let transitioning = false;

  // create dots
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.className = 'w-2 h-2 rounded-full transition-all ' + (i===0 ? 'w-6 bg-white' : 'bg-white/50');
    b.setAttribute('aria-label', 'Go to slide ' + (i+1));
    b.addEventListener('click', ()=>goTo(i));
    dotsRoot.appendChild(b);
  });
  const dots = Array.from(dotsRoot.children);

  function show(index){
    slides.forEach((el, i)=>{
      el.classList.toggle('opacity-100', i===index);
      el.classList.toggle('opacity-0', i!==index);
    });
    dots.forEach((d, i)=>{
      d.className = 'w-2 h-2 rounded-full transition-all ' + (i===index ? 'w-6 bg-white' : 'bg-white/50');
    });
  }

  function goTo(index){
    if (transitioning) return;
    transitioning = true;
    current = (index + slides.length) % slides.length;
    show(current);
    setTimeout(()=>{ transitioning = false; }, 500); // kao u v0 reset nakon animacije :contentReference[oaicite:6]{index=6}
  }

  function next(){ goTo(current+1); }
  function prev(){ goTo(current-1); }

  let timer = setInterval(next, 5000); // 5s auto-rotate (kao v0) :contentReference[oaicite:7]{index=7}
  function resetTimer(){ clearInterval(timer); timer = setInterval(next, 5000); }

  btnNext.addEventListener('click', ()=>{ next(); resetTimer(); });
  btnPrev.addEventListener('click', ()=>{ prev(); resetTimer(); });

  // init
  show(0);
})();

// --- Date range (Flatpickr) ---
// V0 ima range picker s 2 mjeseca (popover); ovdje ga prikazujemo u inputu s istim range ponašanjem. :contentReference[oaicite:8]{index=8}
// --- Date range (Flatpickr) — V0-like tema i ponašanje ---
document.addEventListener('DOMContentLoaded', function () {
  if (window.flatpickr) {
    flatpickr('#dateRange', {
      mode: 'range',
      dateFormat: 'M d, Y',
      defaultDate: [new Date(), new Date(Date.now() + 7*24*60*60*1000)],
      showMonths: 2,           // dva mjeseca side-by-side kao v0
      minDate: 'today',
      disableMobile: true,     // forsiraj web kalendar i na mobitelu
      weekNumbers: false,      // (uključi ako v0 prikazuje sedmice)
      // prev/next strelice mogu ostati default; Flatpickr boje smo prebojili CSS-om
    });

    // (opcionalno) klik na CTA skuplja filtere
    const btn = document.getElementById('searchBtn');
    if (btn) {
      btn.addEventListener('click', () => {
        const dates = (document.getElementById('dateRange').value || '').trim();
        const guests = (document.getElementById('guests').value || '2');
        // TODO: ovdje možeš dodati redirect/search sa query parametrima
        // npr: window.location.href = `/apartmani-php/apartments.php?dates=${encodeURIComponent(dates)}&guests=${encodeURIComponent(guests)}`;
        console.log('Search params ->', { dates, guests });
      });
    }
  }
});
</script>

  <!-- Featured Apartments -->
  <section class="max-w-6xl mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-semibold">Featured apartments</h2>
      <a class="text-sm underline" href="/apartmani-php/apartments.php">View all</a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach (array_slice($apartments, 0, 6) as $a): ?>
        <a href="/apartmani-php/apartment.php?id=<?php echo htmlspecialchars($a['id']); ?>" class="group block border rounded-xl overflow-hidden hover:shadow transition">
          <div class="aspect-video bg-gray-100 overflow-hidden">
            <img src="<?php echo htmlspecialchars($a['images'][0]['url']); ?>" alt="<?php echo htmlspecialchars($a['images'][0]['alt']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition" />
          </div>
          <div class="p-4 space-y-1">
            <div class="flex items-center justify-between">
              <h3 class="font-semibold"><?php echo htmlspecialchars($a['name']); ?></h3>
              <div class="flex items-center gap-1 text-amber-500">
                <i data-lucide="star"></i><span class="text-sm text-gray-700"><?php echo htmlspecialchars($a['rating']); ?></span>
              </div>
            </div>
            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($a['description']); ?></p>
            <div class="text-sm"><span class="font-medium">$<?php echo htmlspecialchars($a['price']); ?></span> /night</div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php site_footer(); ?>
