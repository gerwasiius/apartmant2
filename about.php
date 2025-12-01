<?php
require_once __DIR__ . '/config/bootstrap.php';
site_head('About - Apartmani');
?>
<main class="max-w-4xl mx-auto px-4 py-10 prose">
  <h1><?= htmlspecialchars(t('page.about.title')) ?></h1>
  <p><?= htmlspecialchars(t('page.about.text')) ?></p>
</main>
<?php site_footer(); ?>

