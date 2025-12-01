<?php
require_once __DIR__ . '/config/bootstrap.php';
site_head(t('page.contact.title') . ' - Apartmani');
?>
<main class="max-w-4xl mx-auto px-4 py-10 prose">
  <h1><?= htmlspecialchars(t('page.contact.title')) ?></h1>
  <p><?= htmlspecialchars(t('page.contact.text')) ?></p>
  <ul>
    <li><?= htmlspecialchars(t('page.contact.email')) ?>: info@example.com</li>
    <li><?= htmlspecialchars(t('page.contact.phone')) ?>: +385 00 000 000</li>
  </ul>
</main>
<?php site_footer(); ?>
