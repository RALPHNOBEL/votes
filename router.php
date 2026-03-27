<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Si le fichier existe, le servir directement
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Sinon, router vers la page demandée
$page = ltrim($uri, '/');
$file = __DIR__ . '/' . ($page ?: 'index') . '.php';

if (file_exists($file)) {
    require $file;
} else {
    http_response_code(404);
    require __DIR__ . '/404.php'; // ou index.php si vous n'avez pas de page 404
}