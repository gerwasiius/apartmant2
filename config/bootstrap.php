<?php
declare(strict_types=1);

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/';
$scriptDir  = rtrim(dirname($scriptName), '\\/'); // e.g. '/apartmani-php' or '.'
if ($scriptDir === '.' || $scriptDir === '/') {
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
