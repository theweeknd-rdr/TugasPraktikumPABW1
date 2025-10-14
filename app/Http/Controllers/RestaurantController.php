<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
      public function index()
    {
        $restaurants = [
            [
                'nama' => 'Michael El Vandal',
                'tipe' => 'Fine Dining',
                'rating' => 4.8,
                'kode_reservasi' => 'RS2025-001',
                'jam_buka' => '14:30 - 22:00 WIB',
                'kategori' => 'Fine Dining',
                'spesialisasi' => 'Nasi Padang Premium',
                'lokasi' => 'Jakarta Selatan',
                'chef' => 'Chef Andi'
            ],
            [
                'nama' => 'Mahardika Dermawan',
                'tipe' => 'Warung',
                'rating' => 4.5,
                'kode_reservasi' => 'RS2025-002',
                'jam_buka' => '09:00 - 21:00 WIB',
                'kategori' => 'Street Food',
                'spesialisasi' => 'Nasi Goreng Spesial',
                'lokasi' => 'Bandung',
                'chef' => 'Chef Budi'
            ],
            [
                'nama' => 'Warung Sederhana',
                'tipe' => 'Casual Dining',
                'rating' => 4.2,
                'kode_reservasi' => 'RS2025-003',
                'jam_buka' => '08:00 - 20:00 WIB',
                'kategori' => 'Cafe',
                'spesialisasi' => 'Kopi dan Snack',
                'lokasi' => 'Depok',
                'chef' => 'Chef Sari'
            ],
            [
                'nama' => 'Buffet Royal',
                'tipe' => 'Premium Buffet',
                'rating' => 4.6,
                'kode_reservasi' => 'RS2025-004',
                'jam_buka' => '11:00 - 15:00 WIB',
                'kategori' => 'Buffet',
                'spesialisasi' => 'All You Can Eat',
                'lokasi' => 'Jakarta Pusat',
                'chef' => 'Chef Royal'
            ]
        ];

       return view('dashboard', compact('restaurants'));
    }
}
