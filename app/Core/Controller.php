<?php

declare(strict_types=1);

namespace App\Core;

class Controller
{
    protected array $config;

    public function __construct()
    {
        $this->config = require BASE_PATH . '/config/config.php';
    }

    protected function view(string $view, array $data = []): void
    {
        $viewPath = BASE_PATH . '/views/' . str_replace('.', '/', $view) . '.php';

        if (! is_file($viewPath)) {
            throw new \RuntimeException("View {$view} tidak ditemukan.");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        $title = $data['title'] ?? $this->config['app']['name'];

        require BASE_PATH . '/views/layouts/main.php';
    }

    protected function redirect(string $path): never
    {
        header('Location: ' . self::url($path));
        exit;
    }

    protected function back(string $fallback = '/'): never
    {
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? self::url($fallback)));
        exit;
    }

    protected function input(string $key, mixed $default = null): mixed
    {
        $value = $_POST[$key] ?? $_GET[$key] ?? $default;
        return is_string($value) ? trim($value) : $value;
    }

    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'][$type] = $message;
    }

    protected function currentUser(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    public static function url(string $path = '/'): string
    {
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $path = '/' . ltrim($path, '/');
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        $basePath = ($scriptDir === '/' || $scriptDir === '.') ? '' : rtrim($scriptDir, '/');

        return $basePath . $path;
    }
}
