<?php
function site_head($title = "Apartmani") {
echo <<<HTML
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{$title}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/lucide@latest"></script>
  <style>
    :root{
      /* V0 palette (from globals.css) */
      --background: 43 38% 95%;
      --border: 39 30% 85%;
      --med-blue: 201 48% 44%;
    }
    .bg-mediterranean-beige{ background-color: hsl(var(--background)); }
    .border-mediterranean-sand{ border-color: hsl(var(--border)); }
    .text-mediterranean-blue{ color: hsl(var(--med-blue)); }
    /* glass effect as in V0 */
    .header-glass{
      background-color: hsla(43,38%,95%,0.95);
      backdrop-filter: blur(8px);
    }
    @supports (backdrop-filter: blur(1px)){
      .header-glass{ background-color: hsla(43,38%,95%,0.80); }
    }
  </style>
</head>
<body class="bg-white text-gray-900">
<header class="sticky top-0 z-40 w-full border-b border-mediterranean-sand header-glass">
  <div class="container mx-auto flex h-16 items-center justify-between px-4">
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

function site_footer() {
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
