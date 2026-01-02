<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant; // Jangan lupa import ini
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan view register untuk USER biasa.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Tampilkan view register untuk RESTORAN (Method Baru).
     */
    public function createRestaurant(): View
    {
        return view('auth.register-restaurant');
    }

    /**
     * Handle registrasi user baru (bisa user atau restoran).
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Validasi Role: hanya boleh 'user' atau 'restoran' (admin tidak boleh register sendiri)
            'role' => ['required', 'in:user,restoran'],

            // Validasi Data Restoran: Wajib diisi JIKA role-nya 'restoran'
            'restaurant_name' => ['required_if:role,restoran', 'nullable', 'string', 'max:255'],
            'restaurant_type' => ['required_if:role,restoran', 'nullable', 'string', 'max:100'], // Validasi Jenis Restoran
        ]);

        // 2. Buat Data User (Akun Login)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Simpan role ('user' atau 'restoran')
        ]);

        // 3. Jika Role adalah 'restoran', Buat Data Profil Restorannya
        if ($request->role === 'restoran') {
            Restaurant::create([
                'user_id' => $user->id,
                'name' => $request->restaurant_name,
                'type' => $request->restaurant_type, // Simpan Jenis Restoran
                'status' => 'pending', // Status awal: menunggu verifikasi admin
            ]);
        }

        // 4. Login Otomatis & Redirect
        event(new Registered($user));

        Auth::login($user);

        // Redirect user ke dashboard
        return redirect(route('dashboard', absolute: false));
    }
}
