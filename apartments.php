<?php
require_once __DIR__ . '/config/bootstrap.php';
$apartments = load_apartments();
site_head('Apartments - Apartmani');
?>
<main class="max-w-6xl mx-auto px-4 py-10">
  <h1 class="text-3xl font-semibold mb-6">Apartments</h1>
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($apartments as $a): ?>
      <a href="<?php echo url('apartment.php?id=' . urlencode((string)$a['id'])); ?>" class="group block border rounded-xl overflow-hidden hover:shadow transition">
        <div class="aspect-video bg-gray-100 overflow-hidden">
          <img src="<?php echo htmlspecialchars($a['images'][0]['url']); ?>" alt="<?php echo htmlspecialchars($a['images'][0]['alt']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition" />
        </div>
        <div class="p-4 space-y-1">
          <div class="flex items-center justify-between">
            <h3 class="font-semibold"><?php echo htmlspecialchars($a['name']); ?></h3>
            <div class="flex items-center gap-1 text-amber-500">
              <i data-lucide="star"></i><span class="text-sm text-gray-700"><?php echo htmlspecialchars($a['rating']); ?></span>
            </div>
          </div>
          <p class="text-sm text-gray-600"><?php echo htmlspecialchars($a['description']); ?></p>
          <div class="text-sm"><span class="font-medium">$<?php echo htmlspecialchars($a['price']); ?></span> /night</div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</main>
<?php site_footer(); ?>

