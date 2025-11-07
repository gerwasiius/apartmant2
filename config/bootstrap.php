<?php
declare(strict_types=1);

define('APP_BASE', '/apartmani-php'); // prilagođeno tvom XAMPP folderu
require_once __DIR__ . '/../src/data.php';
require_once __DIR__ . '/../includes/layout.php';

function url(string $path): string {
  $base = rtrim(APP_BASE, '/');
  $p = '/' . ltrim($path, '/');
  return $base . $p;
}
