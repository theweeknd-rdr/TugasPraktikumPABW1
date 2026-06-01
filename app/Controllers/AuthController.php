<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister(): void
    {
        $this->view('auth.register', [
            'title' => 'Register',
            'roles' => User::ROLES,
        ]);
    }

    public function register(): void
    {
        try {
            (new User())->create([
                'name' => $this->input('name'),
                'email' => $this->input('email'),
                'password' => $this->input('password'),
                'role' => $this->input('role', 'buyer'),
                'phone' => $this->input('phone', ''),
                'address' => $this->input('address', ''),
                'avatar' => $this->input('avatar', ''),
            ]);

            $this->flash('success', 'Registrasi berhasil. Silakan login.');
            $this->redirect('/login');
        } catch (\Throwable $exception) {
            $this->flash('error', $exception->getMessage());
            $this->back('/register');
        }
    }

    public function showLogin(): void
    {
        $this->view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function login(): void
    {
        $user = (new User())->authenticate(
            (string) $this->input('email'),
            (string) $this->input('password')
        );

        if ($user === null) {
            $this->flash('error', 'Email atau password salah.');
            $this->back('/login');
        }

        $_SESSION['user'] = $user;
        $this->flash('success', 'Login berhasil.');

        $this->redirect($user['role'] === 'provider' ? '/provider/dashboard' : '/buyer/dashboard');
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        header('Location: ' . self::url('/login'));
        exit;
    }
}
