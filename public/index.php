<?php

declare(strict_types=1);

use App\Core\Router;
use Dotenv\Dotenv;

define('BASE_PATH', dirname(__DIR__));

if (! is_file(BASE_PATH . '/vendor/autoload.php')) {
    http_response_code(500);
    echo 'Dependency belum terpasang. Jalankan composer install terlebih dahulu.';
    exit;
}

require BASE_PATH . '/vendor/autoload.php';

Dotenv::createImmutable(BASE_PATH)->safeLoad();

$config = require BASE_PATH . '/config/config.php';

session_name($config['session']['name']);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

$router = new Router();

require BASE_PATH . '/routes/web.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));

if ($scriptDir !== '/' && $scriptDir !== '.' && str_starts_with($uri, $scriptDir)) {
    $uri = substr($uri, strlen($scriptDir)) ?: '/';
}

try {
    $router->dispatch($method, $uri);
} catch (Throwable $exception) {
    http_response_code(500);

    if ($config['app']['debug']) {
        echo '<h1>Application Error</h1>';
        echo '<pre>' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
        echo '<pre>' . htmlspecialchars($exception->getTraceAsString(), ENT_QUOTES, 'UTF-8') . '</pre>';
        exit;
    }

    echo 'Terjadi kesalahan pada server.';
}
