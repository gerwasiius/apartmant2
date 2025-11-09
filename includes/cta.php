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

<style>
  :root {
    --med-bg: #FFFCF4;
    --med-cream: #FBF3E3;
    --med-blue: #3A7CA5;
    --med-blue-dark: #2A5F8F;
    --text: #1b1b1b;
    --muted: #6b7280;
    --stroke: #FBF3E3;
    --btn-shadow: 0 6px 16px rgba(58, 124, 165, .25);
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
  }


  .cta-wrap {
    background: #FAF7EE;
    text-align: center;
    padding: 3rem 2rem;
    border-top: 1px solid #FBF3E3;
  }

  /* CTA */
  .cta {
    text-align: center;
    padding: 3rem 2rem;
  }

  .cta-hr {
    border: 0;
    height: 1px;
    background: var(--stroke);
    max-width: 74rem;
    margin: 0 auto 2rem;
  }

  .cta-title {
    font-size: clamp(1.8rem, 3.5vw, 3rem);
    color: var(--med-blue-dark);
    margin: 0 0 .5rem;
    font-weight: 800;
    letter-spacing: .2px;
  }

  .cta-sub {
    color: var(--muted);
    margin: 0 0 1.25rem;
  }

  .cta-actions {
    display: flex;
    gap: .75rem;
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    border-radius: .5rem;
    padding: .7rem 1.1rem;
    font-weight: 700;
    text-decoration: none;
  }

  .btn-primary {
    background: var(--med-blue);
    color: #fff;
    box-shadow: var(--btn-shadow);
  }

  .btn-primary:hover {
    filter: brightness(.96);
  }

  .btn-ghost {
    background: #fff;
    color: var(--med-blue-dark);
    border: 1px solid #d6d9de;
  }

  .btn-ghost:hover {
    background: #f6f7f9;
  }

  /* FOOTER */
  .foot {
    background: var(--med-cream);
  }

  .foot-grid {
    display: grid;
    gap: 2rem;
    align-items: start;
  }

  @media (min-width:860px) {
    .foot-grid {
      grid-template-columns: 1.2fr .8fr 1.2fr 1fr;
    }
  }

  .foot-logo {
    font-weight: 800;
    color: var(--med-blue-dark);
    font-size: 1.2rem;
  }

  .foot-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: .5rem;
  }

  .foot-links a {
    color: var(--text);
    text-decoration: none;
  }

  .foot-links a:hover {
    text-decoration: underline;
  }

  .foot-contact {
    font-style: normal;
    color: var(--text);
    display: grid;
    gap: .35rem;
  }

  .foot-contact a {
    color: var(--med-blue-dark);
    text-decoration: none;
  }

  .foot-contact a:hover {
    text-decoration: underline;
  }

  .foot-social {
    display: flex;
    gap: .75rem;
    margin-top: .75rem;
  }

  .foot-social a {
    color: var(--med-blue);
    background: #fff;
    border: 1px solid #e5e7eb;
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: .5rem;
  }

  .foot-social a:hover {
    background: #f1f5f9;
  }

  .foot-newsletter {
    display: flex;
    align-items: center;
    gap: .5rem;
  }

  .foot-newsletter input {
    flex: 1;
    min-width: 0;
    height: 38px;
    border: 1px solid #e5e7eb;
    padding: 0 .75rem;
    border-radius: .5rem;
    background: #fff;
  }

  .foot-newsletter button {
    height: 38px;
    width: 42px;
    border: 0;
    border-radius: .5rem;
    background: #f7a556;
    color: #fff;
  }

  .foot-newsletter button:hover {
    filter: brightness(.95);
  }

  .visually-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
  }

  .foot-copy {
    text-align: center;
    padding-top: 1rem;
  }

  .foot-copy hr {
    border: 0;
    height: 1px;
    background: var(--stroke);
    margin: 1rem 0;
  }

  .foot-copy p {
    color: #6b7280;
    margin: .5rem 0 1rem;
    font-size: .95rem;
  }
</style>