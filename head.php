<?php
function site_head($title = "Apartmani")
{
  echo <<<HTML
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{$title}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <style>
    :root{
  /* HSL sistem iz v0 (ostavi ako ti treba), ali dodamo i tačne HEX nijanse koje v0 koristi */
  --background: 43 38% 95%;
  --border: 39 30% 85%;
  --med-blue: 201 48% 44%;

  /* V0 HEX nijanse — ovo daje "zuckasti" ton */
  --mediterranean-beige: #F5EFE0; /* header/papir */
  --mediterranean-sand:  #E8DCCA; /* border */
  --mediterranean-blue:  #3A7CA5; /* akcente */
  --mediterranean-blue-dark: #2A5F8F;
  --mediterranean-orange: #E67E22;
  --mediterranean-orange-dark: #cf6d19;
}
    .bg-mediterranean-beige { background-color: var(--mediterranean-beige); }
    .border-mediterranean-sand { border-color: var(--mediterranean-sand); }
    .text-mediterranean-blue { color: var(--mediterranean-blue); }
    .bg-mediterranean-orange { background-color: var(--mediterranean-orange); }
    .hover\:bg-mediterranean-orange-dark:hover { background-color: var(--mediterranean-orange-dark); }
    /* glass effect as in V0 */
    .header-glass {
      background-color: rgba(245, 239, 224, 0.95); /* #F5EFE0, 95% */
      backdrop-filter: blur(8px);
    }
    @supports (backdrop-filter: blur(1px)) {
      .header-glass { background-color: rgba(245, 239, 224, 0.80); }
    }

    .container{
  margin-left: auto;
  margin-right: auto;
  padding-left: 1rem;
  padding-right: 1rem;
}
@media (min-width: 768px){
  .container{ padding-left: 2rem; padding-right: 2rem; }
}
/* POPUP KALENDAR: sada potpuno bijel */
.flatpickr-calendar {
  background: #fff;                 /* BIJELO */
  border: 1px solid #E8DCCA;        /* sand obrub */
  box-shadow: 0 10px 20px rgba(0,0,0,.08);
}
.flatpickr-months,
.flatpickr-weekdays {
  background: #fff;                 /* bijela zaglavlja */
  color: #2A5F8F;                   /* blue-dark */
  font-weight: 600;
  border-bottom: 1px solid #E8DCCA; /* suptilan separator */
}
.flatpickr-weekdays .flatpickr-weekday {
  color: #2A5F8F;
  opacity: .9;
}
.flatpickr-day { border-radius: 8px; }
.flatpickr-day:hover { background: rgba(58,124,165,0.10); }
.flatpickr-day.today { border-color: #E8DCCA; }
.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange {
  background: #3A7CA5;
  border-color: #3A7CA5;
  color: #fff;
}
.flatpickr-day.inRange {
  background: rgba(58,124,165,0.12);
  border-color: transparent;
}

/* V0-like bež input prije fokusa; bijeli na focus/open */
.input-sand{
  background:#F5EFE0;              /* bež kao u v0 */
  border:1px solid #E8DCCA;        /* sand rub */
  color:#1f2937;
  transition: background .15s, box-shadow .15s, border-color .15s;
}
.input-sand::placeholder{ color:#6b7280; }
.input-sand:focus,
.input-sand.is-open{               /* kad je kalendar otvoren */
  background:#fff;
  border-color:#3A7CA5;
  outline:0;
  box-shadow:0 0 0 3px rgba(58,124,165,.15);
}
  </style>
</head>
<body class="bg-mediterranean-beige text-gray-900">
  <header class="sticky top-0 z-40 w-full border-b border-mediterranean-sand header-glass">
  <div class="container flex h-16 items-center justify-between">
    <!-- Logo (desktop + mobile) -->
    <a href="/apartmani-php/index.php" class="flex items-center space-x-2">
      <div class="relative hidden md:block h-[50px] w-[120px] overflow-hidden">
        <img
          src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/palm-beach-logo-1-o%20Kopie-02%20mob%20blau-02-55IjFxINMD4fA8tYUd47aMhzYXriaZ.svg"
          alt="Majstorić Apartments Logo"
          class="object-contain h-full w-full" />
      </div>
      <div class="relative md:hidden h-10 w-10 overflow-hidden">
        <img
          src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/palm-beach-logo-1-o%20icon-02-yrnUt3aNszyDhZvQJhrct0gru5qyhz.svg"
          alt="Majstorić Apartments Logo Mobile"
          class="object-contain h-full w-full" />
      </div>
      <span class="sr-only">Majstorić Apartments</span>
    </a>

    <!-- Desktop nav -->
 <nav class="hidden md:flex items-center gap-6">
   <a href="/apartmani-php/index.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">Početna</a>
   <a href="/apartmani-php/apartments.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">Apartmani</a>
   <a href="/apartmani-php/about.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">O nama</a>
   <a href="/apartmani-php/contact.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">Kontakt</a>
   <a href="/apartmani-php/contact.php"
      class="inline-flex items-center gap-2 rounded-full bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white px-4 py-2 text-sm font-medium">
     <span class="inline-block w-2 h-2 rounded-full bg-white/90"></span>
     Book Now
   </a>
</nav>

    <!-- Mobile menu button -->
    <button id="menuBtn" class="md:hidden inline-flex items-center justify-center rounded-md p-2 hover:bg-black/5" aria-label="Open menu">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
  </div>

  <!-- Mobile nav -->
  <div id="mobileNav" class="md:hidden hidden border-t border-mediterranean-sand bg-mediterranean-beige/95 backdrop-blur">
    <nav class="container mx-auto px-4 py-3 flex flex-col gap-3">
      <a href="/apartmani-php/index.php" class="text-sm font-medium">Početna</a>
      <a href="/apartmani-php/apartments.php" class="text-sm font-medium">Apartmani</a>
      <a href="/apartmani-php/about.php" class="text-sm font-medium">O nama</a>
      <a href="/apartmani-php/contact.php"
         class="mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white px-4 py-2 text-sm font-medium">
        <span class="inline-block w-2 h-2 rounded-full bg-white/90"></span>
        Book Now
      </a>
    </nav>
  </div>
</header>
<script>
  // Mobile menu toggle (simulates V0 MobileMenu component)
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('menuBtn');
    const nav = document.getElementById('mobileNav');
    if (btn && nav) btn.addEventListener('click', () => nav.classList.toggle('hidden'));
  });
</script>
HTML;
}

function site_footer()
{
  echo <<<HTML
<footer class="border-t mt-12">
  <div class="max-w-6xl mx-auto px-4 py-8 text-sm text-gray-500 flex items-center justify-between">
    <span>&copy; <?php echo date('Y'); ?> Apartmani</span>
    <span class="flex items-center gap-2"><i data-lucide="star"></i> <span>Made to match V0</span></span>
  </div>
</footer>
<script>if (window.lucide) { lucide.createIcons(); }</script>
</body>
</html>
HTML;
}
?>