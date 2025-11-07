<?php
require __DIR__ . "/head.php";
require __DIR__ . "/data.php";
$apartments = load_apartments();
site_head("Home — Apartmani");
?>
<main>
  <!-- Hero -->
  <section class="bg-gray-50 border-b">
    <div class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 items-center gap-8">
      <div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Find your perfect seaside stay</h1>
        <p class="text-gray-600 mb-6">Modern apartments with balconies, sea view and everything you need for a relaxing holiday.</p>
        <div class="flex gap-3">
          <a href="/apartmani-php/apartments.php" class="px-5 py-3 rounded-lg bg-black text-white">Browse apartments</a>
          <a href="/apartmani-php/about.php" class="px-5 py-3 rounded-lg border">About us</a>
        </div>
      </div>
      <div class="aspect-video md:aspect-square bg-[url('https://images.unsplash.com/photo-1505691723518-36a5ac3b2d51?q=80&w=1200&auto=format&fit=crop')] bg-cover bg-center rounded-2xl shadow"></div>
    </div>
  </section>

  <!-- Featured Apartments -->
  <section class="max-w-6xl mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-semibold">Featured apartments</h2>
      <a class="text-sm underline" href="/apartmani-php/apartments.php">View all</a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach (array_slice($apartments, 0, 6) as $a): ?>
        <a href="/apartmani-php/apartment.php?id=<?php echo htmlspecialchars($a['id']); ?>" class="group block border rounded-xl overflow-hidden hover:shadow transition">
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
  </section>
</main>
<?php site_footer(); ?>
