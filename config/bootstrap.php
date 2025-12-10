<?php
declare(strict_types=1);

// Detektuj application root baziran na REQUEST_URI ili SCRIPT_FILENAME
// Ovo omogućava ispravno određivanje APP_BASE bez obzira da li se stranica 
// učitava kao pages/index.php ili kroz index.php proxy
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/';
$requestUri = $_SERVER['REQUEST_URI'] ?? $scriptName;

// Ako se stranica učitava kroz /pages/*.php direktno, trebamo originalni path
// Ako se učitava kroz / (root), trebamo samo APP_BASE
$parsed = parse_url($requestUri);
$path = $parsed['path'] ?? $scriptName;

// Korak 1: Detektuj APP_BASE iz putanje
// Zamijeni /pages/... sa / za točnu kalkuaciju APP_BASE
$cleanPath = preg_replace('#/pages/[^/]*$#', '/', $path);
// Zamijeni /admin/... sa / za točnu kalkuaciju APP_BASE  
$cleanPath = preg_replace('#/admin/[^/]*$#', '/', $cleanPath);

$scriptDir = rtrim(dirname($cleanPath), '\\/');
if ($scriptDir === '.' || $scriptDir === '/' || $scriptDir === '') {
    $appBase = '';
} else {
    $appBase = $scriptDir;
}
define('APP_BASE', $appBase);

if (!function_exists('url')) {
    function url(string $path = ''): string {
        $base = defined('APP_BASE') ? rtrim(APP_BASE, '/') : '';
        $p = '/' . ltrim($path, '/'); // ensure leading slash for target
        return ($base !== '' ? $base : '') . $p;
    }
}

require_once __DIR__ . '/../src/data.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/../includes/layout.php';
