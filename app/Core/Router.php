<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, mixed $handler, array $middleware = []): void
    {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(string $path, mixed $handler, array $middleware = []): void
    {
        $this->add('POST', $path, $handler, $middleware);
    }

    public function add(string $method, string $path, mixed $handler, array $middleware = []): void
    {
        $this->routes[strtoupper($method)][$this->normalize($path)] = [
            'handler' => $handler,
            'middleware' => $middleware,
        ];
    }

    public function dispatch(string $method, string $path): void
    {
        $method = strtoupper($method);
        $path = $this->normalize($path);
        $route = $this->routes[$method][$path] ?? null;

        if ($route === null) {
            http_response_code(404);
            echo '404 - Halaman tidak ditemukan.';
            return;
        }

        foreach ($route['middleware'] as $middleware) {
            $this->runMiddleware($middleware);
        }

        $this->runHandler($route['handler']);
    }

    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : rtrim($path, '/');
    }

    private function runMiddleware(mixed $middleware): void
    {
        if (is_string($middleware) && class_exists($middleware)) {
            (new $middleware())->handle();
            return;
        }

        if (is_array($middleware) && is_string($middleware[0] ?? null) && class_exists($middleware[0])) {
            $class = array_shift($middleware);
            (new $class(...$middleware))->handle();
            return;
        }

        if (is_callable($middleware)) {
            $middleware();
            return;
        }

        throw new \InvalidArgumentException('Middleware tidak valid.');
    }

    private function runHandler(mixed $handler): void
    {
        if (is_array($handler) && is_string($handler[0] ?? null)) {
            [$class, $method] = $handler;
            (new $class())->{$method}();
            return;
        }

        if (is_callable($handler)) {
            $handler();
            return;
        }

        throw new \InvalidArgumentException('Route handler tidak valid.');
    }
}
