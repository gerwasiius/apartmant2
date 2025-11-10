<?php
declare(strict_types=1);

// Auto-detect APP_BASE (works when site is in a subfolder like /apartmani-php or in root)
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/';
$scriptDir  = rtrim(dirname($scriptName), '\/');
if ($scriptDir === '.' || $scriptDir === '/') {
    $appBase = '';
} else {
    $appBase = $scriptDir;
}
define('APP_BASE', $appBase);
// prilagođeno tvom XAMPP folderu
require_once __DIR__ . '/../src/data.php';
require_once __DIR__ . '/../includes/layout.php';

function url(string $path): string {
  $base = rtrim(APP_BASE, '/');
  $p = '/' . ltrim($path, '/');
  return $base . $p;
}
