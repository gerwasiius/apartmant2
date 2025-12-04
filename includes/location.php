<!-- Kontakt forma -->
<form action="#" method="post" class="space-y-4">
  <div class="space-y-1">
    <label for="name" class="block text-sm font-medium text-gray-700">
      <?= htmlspecialchars(t('page.contact.form_name_label')) ?>
    </label>
    <input
      type="text"
      id="name"
      name="name"
      required
      class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
      placeholder="<?= htmlspecialchars(t('page.contact.form_name_placeholder')) ?>"
    />
  </div>

  <div class="space-y-1">
    <label for="email" class="block text-sm font-medium text-gray-700">
      <?= htmlspecialchars(t('page.contact.form_email_label')) ?>
    </label>
    <input
      type="email"
      id="email"
      name="email"
      required
      class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
      placeholder="<?= htmlspecialchars(t('page.contact.form_email_placeholder')) ?>"
    />
  </div>

  <div class="space-y-1">
    <label for="phone" class="block text-sm font-medium text-gray-700">
      <?= htmlspecialchars(t('page.contact.form_phone_label')) ?>
    </label>
    <input
      type="tel"
      id="phone"
      name="phone"
      class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
      placeholder="<?= htmlspecialchars(t('page.contact.form_phone_placeholder')) ?>"
    />
  </div>

  <div class="space-y-1">
    <label for="message" class="block text-sm font-medium text-gray-700">
      <?= htmlspecialchars(t('page.contact.form_message_label')) ?>
    </label>
    <textarea
      id="message"
      name="message"
      rows="4"
      required
      class="w-full rounded-md border border-mediterranean-sand px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-mediterranean-blue focus:border-mediterranean-blue bg-white"
      placeholder="<?= htmlspecialchars(t('page.contact.form_message_placeholder')) ?>"
    ></textarea>
  </div>

  <button
    type="submit"
    class="w-full h-11 inline-flex items-center justify-center rounded-md bg-mediterranean-orange hover:bg-mediterranean-orange-dark text-white text-sm font-medium transition-colors"
  >
    <?= htmlspecialchars(t('page.contact.form_submit')) ?>
  </button>
</form>
