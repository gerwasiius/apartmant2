<section class="cta-wrap">
  <div class="container">
    <h2 class="cta-title"><?= htmlspecialchars(t('cta.title')) ?></h2>
    <p class="cta-sub"><?= htmlspecialchars(t('cta.subtitle')) ?></p>
    <div class="mt-6 flex justify-center gap-4">
      <a class="btn btn-primary" href="<?php echo htmlspecialchars(url('apartments.php')); ?>">
        <?= htmlspecialchars(t('cta.view_all')) ?>
      </a>
      <a class="btn btn-ghost" href="<?php echo htmlspecialchars(url('contact.php')); ?>">
        <?= htmlspecialchars(t('cta.contact_us')) ?>
      </a>
    </div>
  </div>
</section>
