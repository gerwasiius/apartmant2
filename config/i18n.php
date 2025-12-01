<?php
declare(strict_types=1);

const SUPPORTED_LANGS = ['hr', 'en', 'de', 'fr'];
const DEFAULT_LANG = 'hr';

function detect_lang(): string
{
    $lang = $_GET['lang'] ?? ($_COOKIE['lang'] ?? '');
    $lang = strtolower(substr((string)$lang, 0, 2));

    if (!in_array($lang, SUPPORTED_LANGS, true)) {
        $lang = DEFAULT_LANG;
    }

    // zapamti cookie (1 godina)
    if (!isset($_COOKIE['lang']) || $_COOKIE['lang'] !== $lang) {
        setcookie('lang', $lang, time() + 365*24*60*60, '/');
    }

    return $lang;
}

function current_lang(): string
{
    static $lang;
    if ($lang === null) {
        $lang = detect_lang();
    }
    return $lang;
}

function t(string $key, array $replace = []): string
{
    static $cache = [];

    $lang = current_lang();

    if (!isset($cache[$lang])) {
        $file = __DIR__ . '/../lang/' . $lang . '.php';
        $cache[$lang] = file_exists($file) ? require $file : [];
    }

    $text = $cache[$lang][$key] ?? $key;

    foreach ($replace as $k => $v) {
        $text = str_replace('{' . $k . '}', (string)$v, $text);
    }

    return $text;
}
