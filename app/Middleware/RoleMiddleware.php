<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Controller;

class RoleMiddleware
{
    public function __construct(private readonly string $role)
    {
    }

    public function handle(): void
    {
        $userRole = $_SESSION['user']['role'] ?? null;

        if ($userRole !== $this->role) {
            $_SESSION['flash']['error'] = 'Anda tidak memiliki akses ke halaman tersebut.';
            header('Location: ' . Controller::url($this->fallbackPath($userRole)));
            exit;
        }
    }

    private function fallbackPath(?string $role): string
    {
        return match ($role) {
            'buyer' => '/buyer/dashboard',
            'provider' => '/provider/dashboard',
            default => '/login',
        };
    }
}
