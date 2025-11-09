<?php
declare(strict_types=1);

function site_head(string $title = 'Apartmani'): void {
  $base = rtrim(APP_BASE, '/');
  $year = date('Y');

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
  <link rel="stylesheet" href="{$base}/assets/css/style.css">
  <link rel="stylesheet" href="{$base}/assets/css/cta.css">
<link rel="stylesheet" href="{$base}/assets/css/location.css">
</head>
<body class="bg-mediterranean-beige text-gray-900">
  <header class="sticky top-0 z-40 w-full border-b border-mediterranean-sand header-glass">
    <div class="container flex h-16 items-center justify-between">
      <a href="{$base}/index.php" class="flex items-center space-x-2">
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

      <nav class="hidden md:flex items-center gap-6">
        <a href="{$base}/index.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">Početna</a>
        <a href="{$base}/apartments.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">Apartmani</a>
        <a href="{$base}/about.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">O nama</a>
        <a href="{$base}/contact.php" class="text-sm font-medium transition-colors hover:text-mediterranean-blue">Kontakt</a>
        <a href="{$base}/contact.php"
           class="inline-flex items-center gap-2 rounded-full bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white px-4 py-2 text-sm font-medium">
          <span class="inline-block w-2 h-2 rounded-full bg-white/90"></span>
          Book Now
        </a>
      </nav>

      <button id="menuBtn" class="md:hidden inline-flex items-center justify-center rounded-md p-2 hover:bg-black/5" aria-label="Open menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <div id="mobileNav" class="md:hidden hidden border-t border-mediterranean-sand bg-mediterranean-beige/95 backdrop-blur">
      <nav class="container mx-auto px-4 py-3 flex flex-col gap-3">
        <a href="{$base}/index.php" class="text-sm font-medium">Početna</a>
        <a href="{$base}/apartments.php" class="text-sm font-medium">Apartmani</a>
        <a href="{$base}/about.php" class="text-sm font-medium">O nama</a>
        <a href="{$base}/contact.php"
           class="mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white px-4 py-2 text-sm font-medium">
          <span class="inline-block w-2 h-2 rounded-full bg-white/90"></span>
          Book Now
        </a>
      </nav>
    </div>
  </header>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const btn = document.getElementById('menuBtn');
      const nav = document.getElementById('mobileNav');
      if (btn && nav) btn.addEventListener('click', () => nav.classList.toggle('hidden'));
    });
  </script>
HTML;
}

function site_footer(): void {
  $base = rtrim(APP_BASE, '/');
  $year = date('Y');

  echo <<<HTML
  <footer class="border-t bg-mediterranean-beige">
    <div class="container foot-grid">
      <!-- Brand -->
      <div class="foot-brand">
        <div class="foot-logo">Majstorić Apartments</div>
      </div>

      <!-- Quick links -->
      <nav class="foot-col">
        <ul class="foot-links">
          <li><a href="{$base}/index.php">Home</a></li>
          <li><a href="{$base}/apartments.php">Apartments</a></li>
          <li><a href="{$base}/about.php">About</a></li>
          <li><a href="{$base}/contact.php">Contact</a></li>
        </ul>
      </nav>

      <!-- Contact -->
      <div class="foot-col">
        <address class="foot-contact">
          <div>123 Coastal Road, Medulin, Croatia</div>
          <div><a href="tel:+385123456789">+385 12 345 6789</a></div>
          <div><a href="mailto:info@majstoricapartments.com">info@majstoricapartments.com</a></div>
        </address>
      </div>

      <!-- Social + Newsletter -->
      <div class="foot-col">
        <div class="foot-social">
          <a aria-label="Facebook" href="#">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true">
              <path d="M22 12.06C22 6.51 17.52 2 12 2S2 6.51 2 12.06c0 5.02 3.66 9.19 8.44 9.94v-7.03H7.9V12.1h2.54V9.93c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.87h-2.34V22c4.78-.75 8.44-4.92 8.44-9.94z"/>
            </svg>
          </a>
          <a aria-label="Instagram" href="#">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true">
              <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5a5.5 5.5 0 1 1 0 11 5.5 5.5 0 0 1 0-11zm0 2a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zm4.75-.9a1.15 1.15 0 1 1 0 2.3 1.15 1.15 0 0 1 0-2.3z"/>
            </svg>
          </a>
          <a aria-label="Twitter" href="#">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true">
              <path d="M22 5.8c-.7.3-1.4.5-2.1.6.8-.5 1.3-1.2 1.6-2.1-.7.4-1.6.8-2.4 1A3.63 3.63 0 0 0 12 7.9c0 .3 0 .7.1 1A10.3 10.3 0 0 1 3 5.2a3.63 3.63 0 0 0 1.1 4.8c-.6 0-1.2-.2-1.7-.4v.1c0 1.7 1.2 3.2 2.9 3.5-.3.1-.7.1-1.1.1-.3 0-.5 0-.8-.1.5 1.4 1.9 2.4 3.6 2.4A7.29 7.29 0 0 1 2 18.4a10.28 10.28 0 0 0 5.6 1.6c6.7 0 10.4-5.6 10.4-10.4v-.5c.7-.5 1.3-1.1 1.8-1.8z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>

    <div class="container foot-copy">
      <hr />
      <p>© {$year} Majstorić Apartments.</p>
    </div>
  </footer>
  <script src="{$base}/assets/js/slider.js"></script>
  <script src="{$base}/assets/js/calendar.js"></script>
  <script src="{$base}/assets/js/featured-carousel.js"></script>
  <script>if (window.lucide) { lucide.createIcons(); }</script>
</body>
</html>
HTML;
}

