<?php
require_once __DIR__ . '/../config/bootstrap.php';
site_head(t('page.contact.title') . ' - ' . t('app.name'));
?>
<main class="min-h-[60vh] bg-[#FAF7EE] py-10">
  <div class="container mx-auto px-4 flex items-center justify-center">
    <div class="w-full max-w-xl bg-white rounded-xl border border-mediterranean-sand shadow-sm">
      <!-- Header -->
      <div class="px-6 py-6 border-b border-mediterranean-sand text-center">
        <h1 class="text-2xl md:text-3xl font-semibold text-mediterranean-blue-dark mb-2">
          <?= htmlspecialchars(t('page.contact.title')) ?>
        </h1>
        <p class="text-gray-600 text-sm md:text-base">
          <?= htmlspecialchars(t('page.contact.text')) ?>
        </p>
      </div>

      <!-- Form + kontakt info -->
      <div class="px-6 py-6 space-y-6">
        <!-- Kontakt forma -->
        <form action="#" method="post" class="space-y-4">
          <div class="space-y-1">
            <label for="name" class="block text-sm font-medium text-gray-700">
              <?= htmlspecialchars(t('page.contact.form_name_label')) ?>
            </label>
            <input type="text" id="name" name="name" required
              class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
              placeholder="<?= htmlspecialchars(t('page.contact.form_name_placeholder')) ?>" />
          </div>

          <div class="space-y-1">
            <label for="email" class="block text-sm font-medium text-gray-700">
              <?= htmlspecialchars(t('page.contact.form_email_label')) ?>
            </label>
            <input type="email" id="email" name="email" required
              class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
              placeholder="<?= htmlspecialchars(t('page.contact.form_email_placeholder')) ?>" />
          </div>

          <div class="space-y-1">
            <label for="phone" class="block text-sm font-medium text-gray-700">
              <?= htmlspecialchars(t('page.contact.form_phone_label')) ?>
            </label>
            <input type="tel" id="phone" name="phone"
              class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
              placeholder="<?= htmlspecialchars(t('page.contact.form_phone_placeholder')) ?>" />
          </div>

          <div class="space-y-1">
            <label for="message" class="block text-sm font-medium text-gray-700">
              <?= htmlspecialchars(t('page.contact.form_message_label')) ?>
            </label>
            <textarea id="message" name="message" rows="4" required
              class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
              placeholder="<?= htmlspecialchars(t('page.contact.form_message_placeholder')) ?>"></textarea>
          </div>

          <button type="submit"
            class="w-full h-11 inline-flex items-center justify-center rounded-md bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white text-sm font-medium transition-colors">
            <?= htmlspecialchars(t('page.contact.form_submit')) ?>
          </button>
        </form>


        <!-- Stalni kontakt podaci kao fallback -->
        <div class="border-t border-mediterranean-sand pt-4 text-sm text-gray-700 space-y-1">
          <p class="font-medium">Kontakt podaci</p>
          <p>
            <?= htmlspecialchars(t('page.contact.email')) ?>:
            <a href="mailto:info@example.com" class="text-mediterranean-blue hover:underline">
              info@example.com
            </a>
          </p>
          <p>
            <?= htmlspecialchars(t('page.contact.phone')) ?>:
            <a href="tel:+38500000000" class="text-mediterranean-blue hover:underline">
              +385 00 000 000
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</main>
<?php site_footer(); ?>
