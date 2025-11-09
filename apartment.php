<?php
require_once __DIR__ . '/config/bootstrap.php';
$id = $_GET['id'] ?? null;
$apt = $id ? find_apartment($id) : null;
if (!$apt) { http_response_code(404); echo "Not found"; exit; }
site_head($apt['name'] . ' - Apartmani');
?>
<main class="max-w-5xl mx-auto px-4 py-10">
  <a href="<?php echo url('apartments.php'); ?>" class="text-sm underline">&larr; Back</a>
  <div class="grid md:grid-cols-2 gap-6 mt-4">
    <div class="space-y-3">
      <?php foreach ($apt['images'] as $img): ?>
        <img class="w-full rounded-xl border" src="<?php echo htmlspecialchars($img['url']); ?>" alt="<?php echo htmlspecialchars($img['alt']); ?>" />
      <?php endforeach; ?>
    </div>
    <div class="space-y-4">
      <h1 class="text-3xl font-semibold"><?php echo htmlspecialchars($apt['name']); ?></h1>
      <div class="flex items-center gap-2 text-amber-500"><i data-lucide="star"></i><span class="text-gray-700"><?php echo htmlspecialchars($apt['rating']); ?> · <?php echo htmlspecialchars($apt['reviews']); ?> reviews</span></div>
      <p class="text-gray-700"><?php echo htmlspecialchars($apt['longDescription']); ?></p>
      <ul class="grid grid-cols-2 gap-2 text-sm">
        <li><strong>Beds:</strong> <?php echo htmlspecialchars($apt['beds']); ?></li>
        <li><strong>Baths:</strong> <?php echo htmlspecialchars($apt['baths']); ?></li>
        <li><strong>Guests:</strong> <?php echo htmlspecialchars($apt['guests']); ?></li>
      </ul>
      <div class="pt-4">
        <span class="text-2xl font-semibold">$<?php echo htmlspecialchars($apt['price']); ?></span> <span class="text-gray-600">/night</span>
      </div>
    </div>
  </div>
</main>
<?php site_footer(); ?>

