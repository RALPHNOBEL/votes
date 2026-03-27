<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// Sert les fichiers statiques (CSS, JS, images) directement
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// Tout le reste va vers index.php
require_once __DIR__ . '/index.php';