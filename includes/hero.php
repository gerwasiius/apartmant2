<?php
?>
<section class="relative w-full py-12 md:py-24 lg:py-32 xl:py-48 overflow-hidden">
  <div class="absolute inset-0 z-0 overflow-hidden" id="heroSlides">
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-100 slide pointer-events-none">
      <img
        src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_03-sTrj0FWeVwaVLEx4LMu3XOJ1yQw7Ew.jpg"
        alt="Majstorić Apartments Medulin - Beachfront View" class="w-full h-full object-cover brightness-[0.7]">
    </div>
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-0 slide pointer-events-none">
      <img
        src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_01-Zb3VWXlbwrDW4oSKbkxEFakJqBsHWF.jpg"
        alt="Majstorić Apartments Medulin - Pool Area" class="w-full h-full object-cover brightness-[0.7]">
    </div>
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-0 slide pointer-events-none">
      <img
        src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_04-RXy7J36ANhk6TDY2xRPEv7nmFfhsSN.jpg"
        alt="Majstorić Apartments Medulin - Garden View" class="w-full h-full object-cover brightness-[0.7]">
    </div>
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-0 slide pointer-events-none">
      <img
        src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/cim_associated_05-ku1RnxiewNhyHx2STxxzU8Rg3yacLR.jpg"
        alt="Majstorić Apartments Medulin - Apartment Interior" class="w-full h-full object-cover brightness-[0.7]">
    </div>

<div id="heroDots" class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2 z-20 pointer-events-auto"></div>

    <button id="heroPrev"
  class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition-colors z-20 pointer-events-auto hidden md:block"
  aria-label="Previous image">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>
    <button id="heroNext"
  class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition-colors z-20 pointer-events-auto hidden md:block"
  aria-label="Next image">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>

  <div class="relative z-10">
    <div class="container flex flex-col items-center justify-center text-center">
      <div class="hidden md:block mb-8 relative w-[410px] h-[310px]">
        <img
          src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/palm-beach-logo-1-o%20Kopie-02-jdHsQrQl0cIAN4akDSRGhM6C53uZ28.svg"
          alt="Majstorić Apartments Logo - Desktop" class="object-contain w-full h-full drop-shadow-lg" />
      </div>
      <div class="md:hidden mb-6 h-16 w-16">
        <img
          src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/palm-beach-logo-1-o%20icon-02-yrnUt3aNszyDhZvQJhrct0gru5qyhz.svg"
          alt="Majstorić Apartments Logo - Mobile" class="object-contain w-full h-full drop-shadow" />
      </div>

      <div class="w-full max-w-md rounded-2xl booking-card backdrop-blur p-4 shadow">
        <div class="flex items-center gap-2 mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mediterranean-blue" viewBox="0 0 24 24"
            fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1M6 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2" />
          </svg>
          <span class="font-medium">Odaberite datum:</span>
        </div>

        <div class="grid grid-cols-1 gap-2">
          <!-- 1) Datumski raspon preko cijele širine -->
          <label for="dateRange" class="sr-only">Datumi</label>
          <input id="dateRange" class="input-sand w-full rounded-md px-3 py-2 text-sm" placeholder="Od — Do" />

          <div class="flex items-center gap-2 mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mediterranean-blue" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              aria-hidden="true">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            <span class="font-medium">Odaberite broj gostiju:</span>
          </div>
          <label for="guests" class="sr-only">Gosti</label>
          <select id="guests" class="input-sand rounded-md px-3 py-2 text-sm">
            <option value="1">1 gost</option>
            <option value="2" selected>2 gosta</option>
            <option value="3">3 gosta</option>
            <option value="4">4 gosta</option>
          </select>

          <!-- 3) Veliki gumb -->
          <button id="searchBtn"
            class="mt-1 w-full px-4 py-2 rounded-lg bg-mediterranean-blue text-white hover:opacity-90">
            Pretraži dostupnost
          </button>
        </div>
      </div>

    </div>
  </div>
</section>