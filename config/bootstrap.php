<?php
declare(strict_types=1);

// Auto-detect APP_BASE (works when site is in a subfolder like /apartmani-php or in root)
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/';
$scriptDir  = rtrim(dirname($scriptName), '\\/'); // e.g. '/apartmani-php' or '.'
if ($scriptDir === '.' || $scriptDir === '/') {
    $appBase = '';
} else {
    $appBase = $scriptDir;
}
define('APP_BASE', $appBase);

// url() helper - always returns path prefixed with APP_BASE and leading slash
if (!function_exists('url')) {
    function url(string $path = ''): string {
        $base = defined('APP_BASE') ? rtrim(APP_BASE, '/') : '';
        $p = '/' . ltrim($path, '/'); // ensure leading slash for target
        // if base empty return path starting with '/', else '/base/path'
        return ($base !== '' ? $base : '') . $p;
    }
}

// now include rest of bootstrap dependencies (adjust path if needed)
require_once __DIR__ . '/../src/data.php';
require_once __DIR__ . '/../includes/layout.php';
