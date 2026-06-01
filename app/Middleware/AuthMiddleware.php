<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Controller;

class AuthMiddleware
{
    public function handle(): void
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['flash']['error'] = 'Silakan login terlebih dahulu.';
            header('Location: ' . Controller::url('/login'));
            exit;
        }
    }
}
