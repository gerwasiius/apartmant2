<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/init.php';
requireAdmin();
$user = adminUser();

// Get basic stats
$apartments = load_apartments();
$totalApartments = count($apartments);

admin_head('Dashboard');
?>

<div class="container px-4 md:px-0 py-4 md:py-8">
  <!-- Main Content -->
  <main>
    <h1 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6">Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-4 mb-6 md:mb-8">
      <div class="ap-card">
        <div class="ap-card-body p-3 md:p-4">
          <div class="text-2xl md:text-4xl font-bold text-mediterranean-blue"><?= $totalApartments ?></div>
          <div class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">Apartmana</div>
        </div>
      </div>

      <div class="ap-card">
        <div class="ap-card-body p-3 md:p-4">
          <div class="text-2xl md:text-4xl font-bold text-mediterranean-orange">-</div>
          <div class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">Rezervacije</div>
        </div>
      </div>

      <div class="ap-card">
        <div class="ap-card-body p-3 md:p-4">
          <div class="text-2xl md:text-4xl font-bold text-mediterranean-blue">-</div>
          <div class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">Poruke</div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="ap-card">
      <div class="ap-card-header text-sm">Akcije</div>
      <div class="ap-card-body">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4">
          <a href="apartments.php" class="block p-2 md:p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
            <div class="text-xl md:text-2xl mb-1 md:mb-2">🏠</div>
            <div class="font-medium text-xs md:text-sm">Apartmani</div>
          </a>
          <a href="audit.php" class="block p-2 md:p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
            <div class="text-xl md:text-2xl mb-1 md:mb-2">📋</div>
            <div class="font-medium text-xs md:text-sm">Audit</div>
          </a>
          <a href="settings.php" class="block p-2 md:p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
            <div class="text-xl md:text-2xl mb-1 md:mb-2">⚙️</div>
            <div class="font-medium text-xs md:text-sm">Podešavanja</div>
          </a>
          <a href="logout.php" class="block p-2 md:p-4 border border-mediterranean-sand rounded-lg hover:bg-gray-50 text-center">
            <div class="text-xl md:text-2xl mb-1 md:mb-2">🚪</div>
            <div class="font-medium text-xs md:text-sm">Odjava</div>
          </a>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-6 md:mt-8 ap-card">
      <div class="ap-card-header text-sm">Aktivnosti</div>
      <div class="ap-card-body">
        <p class="text-gray-600 text-xs md:text-sm">Pregledaj <a href="audit.php" class="text-mediterranean-blue">audit</a> za sve aktivnosti.</p>
      </div>
    </div>
  </main>
</div>

<?php admin_footer();

