<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat 1 Akun ADMIN
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Buat 1 Akun RESTORAN (Owner)
        $owner = User::create([
            'name' => 'Kang Asep',
            'email' => 'restoran@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'restoran',
        ]);

        // Buat Data Restoran milik Owner tersebut (Lengkap dengan Jenis Restoran)
        Restaurant::create([
            'user_id' => $owner->id,
            'name' => 'Warung Nasi Ampera',
            'type' => 'Sunda', // Jenis Restoran
            'address' => 'Jl. Soekarno Hatta No. 123, Bandung',
            'description' => 'Menyajikan masakan khas Sunda dengan suasana yang nyaman dan asri.',
            'status' => 'verified', // Status langsung verified agar bisa dipakai testing
        ]);

        // 3. Buat 1 Akun USER (Pelanggan)
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
