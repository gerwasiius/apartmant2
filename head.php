<?php
function site_head($title = "Apartmani") {
echo <<<HTML
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{$title}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-white text-gray-900">
<header class="border-b">
  <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
    <a href="/apartmani-php/index.php" class="text-2xl font-semibold">Apartmani</a>
    <nav class="space-x-4">
      <a class="hover:underline" href="/apartmani-php/apartments.php">Apartments</a>
      <a class="hover:underline" href="/apartmani-php/about.php">About</a>
    </nav>
  </div>
</header>
HTML;
}
function site_footer() {
echo <<<HTML
<footer class="border-t mt-12">
  <div class="max-w-6xl mx-auto px-4 py-8 text-sm text-gray-500 flex items-center justify-between">
    <span>&copy; <?php echo date('Y'); ?> Apartmani</span>
    <span class="flex items-center gap-2"><i data-lucide="star"></i> <span>Made to match V0</span></span>
  </div>
</footer>
<script>lucide && lucide.createIcons();</script>
</body>
</html>
HTML;
}
?>
