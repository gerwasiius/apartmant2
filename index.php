<?php
require_once __DIR__ . '/config/bootstrap.php';
$apartments = load_apartments();
site_head('Home — Apartmani');
?>
<main>
  <?php include __DIR__ . '/includes/hero.php'; ?>
  <?php include __DIR__ . '/includes/featured-apartments.php'; ?>
  <?php include __DIR__ . '/includes/location.php'; ?>
  <?php include __DIR__ . '/includes/cta.php'; ?>
</main>
<?php site_footer(); ?>
