<?php
// --- podesivi podaci ---
$cta_title = 'Ready to Book Your Stay?';
$cta_subtitle = 'Contact us today to reserve your perfect apartment in Medulin';
$cta_primary_label = 'View All Apartments';
$cta_primary_href = '/apartments';
$cta_secondary_label = 'Contact Us';
$cta_secondary_href = '/contact';

$brand_name = 'Majstorić Apartments';
$nav_links = [
  ['Home', '/'],
  ['Apartments', '/apartments'],
  ['About', '/about'],
  ['Contact', '/contact'],
];
$address = '123 Coastal Road, Medulin, Croatia';
$phone = '+385 12 345 6789';
$email = 'info@majstoricapartments.com';
$copyright = '© 2025 Majstorić Apartments.';
?>
<!-- ========== CTA SECTION ========== -->
<?php
$cta_title = 'Ready to Book Your Stay?';
$cta_subtitle = 'Contact us today to reserve your perfect apartment in Medulin';
?>
<section class="cta-wrap">
  <div class="container">
    <h2 class="cta-title"><?= htmlspecialchars($cta_title) ?></h2>
    <p class="cta-sub"><?= htmlspecialchars($cta_subtitle) ?></p>
    <div class="cta-actions">
      <a class="btn btn-primary" href="/apartments">View All Apartments</a>
      <a class="btn btn-ghost" href="/contact">Contact Us</a>
    </div>
  </div>
</section>