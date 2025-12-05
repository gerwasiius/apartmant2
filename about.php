<?php
require_once __DIR__ . '/config/bootstrap.php';
site_head(t('page.about.title') . ' - ' . t('app.name'));
?>

<main class="min-h-[60vh] bg-mediterranean-beige">
  <!-- Gornja hero slika kao na v0-medulin /about -->
  <section class="relative w-full h-[320px] md:h-[420px] overflow-hidden">
    <img
      src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/zeljkoxveronika-qKwqAGveXOIsXyL44kZxnyk8jqJ9fH.png"
      alt="Veronika i Željko Majstorić u Medulinu"
      class="w-full h-full object-cover"
    />
  </section>

  <!-- Tekstualni dio (sredina stranice) -->
  <section class="py-12 md:py-16">
    <div class="container mx-auto px-4">
      <div class="max-w-3xl mx-auto text-gray-700 text-base md:text-lg leading-relaxed space-y-5">
        <!-- SEO /11, ali vizualno sakriveno (na v0 stranici se ne vidi naslov) -->
        <h1 class="sr-only">
          <?= htmlspecialchars(t('page.about.title')) ?>
        </h1>

        <p>
          Živimo u prekrasnoj Švicarskoj i već oko 30 godina imamo posebnu vezu s Medulinom u Hrvatskoj.
          Sredinom 1990-ih odlučili smo pustiti novo korijenje u malom ribarskom mjestu i od tada provodimo
          svoje slobodno vrijeme u Medulinu, s ljubavlju održavajući kuću i vrt živima.
        </p>

        <p>
          Naša ljubav prema ovom slikovitom mjestu na jadranskoj obali, mnogi sunčani dani u godini i miris
          limuna, smokava i maslina nadahnuli su nas da drugima pružimo priliku da dožive ljepotu i
          gostoljubivost Medulina.
        </p>

        <p>
          Kao ponosni roditelji triju kćeri koje su sada osnovale vlastite obitelji, uživamo provoditi vrijeme
          s njima, posebno tijekom naših zajedničkih odmora.
        </p>

        <p>
          Ovi zajednički trenuci u Medulinu su nam neprocjenjivi i radujemo se što ćemo vam pružiti nezaboravan
          boravak u našim apartmanima.
        </p>

        <p>
          Pozivamo vas da postanete dio naše povijesti i otkrijete ljepotu Medulina!
        </p>

        <div class="pt-2 space-y-1">
          <p class="font-semibold text-mediterranean-blue-dark">Dobrodošli!</p>
          <p class="text-mediterranean-blue-dark">Veronika i Željko Majstorić</p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php site_footer(); ?>
