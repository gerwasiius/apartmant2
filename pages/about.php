<?php
require_once __DIR__ . '/../config/bootstrap.php';
site_head(t('page.about.title') . ' - ' . t('app.name'));
?>

<main class="min-h-[60vh] bg-mediterranean-beige">
  <!-- Gornja hero slika kao na v0-medulin /about -->
      <!-- src="https://sssef5nrxfikvijy.public.blob.vercel-storage.com/zeljkoxveronika-qKwqAGveXOIsXyL44kZxnyk8jqJ9fH.png" -->

  <section class="relative w-full h-[320px] md:h-[420px] overflow-hidden">
    <picture>
      <source
        media="(max-width: 767px)"
        srcset="/assets/images/about/zeljkoxveronika-cropped-picture.webp"
      />
      <img
        src="/assets/images/about/zeljkoxveronika-full-picture.webp"
        alt="Veronika i Željko Majstorić u Medulinu"
        class="w-full h-full object-cover"
      />
    </picture>
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
          <?= htmlspecialchars(t('page.about.para1')) ?>
        </p>

        <p>
          <?= htmlspecialchars(t('page.about.para2')) ?>
        </p>

        <p>
          <?= htmlspecialchars(t('page.about.para3')) ?>
        </p>

        <p>
          <?= htmlspecialchars(t('page.about.para4')) ?>
        </p>

        <p>
          <?= htmlspecialchars(t('page.about.para5')) ?>
        </p>

        <div class="pt-2 space-y-1">
          <p class="font-semibold text-mediterranean-blue-dark"><?= htmlspecialchars(t('page.about.footer_greeting')) ?></p>
          <p class="text-mediterranean-blue-dark"><?= htmlspecialchars(t('page.about.footer_names')) ?></p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php site_footer(); ?>
