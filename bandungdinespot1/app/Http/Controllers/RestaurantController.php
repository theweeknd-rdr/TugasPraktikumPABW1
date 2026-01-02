<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Menampilkan halaman detail restoran untuk user.
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('user.restaurants.show', compact('restaurant'));
    }

    /**
     * Update profil restoran (untuk pemilik).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi role
        if ($user->role !== 'restoran') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        // Ambil restoran milik user
        $restaurant = Restaurant::where('user_id', $user->id)->firstOrFail();

        // Validasi input (Upload foto dihapus)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'type' => 'required|string',
            'total_tables' => 'required|integer|min:1|max:1000',
            'address' => 'required|string|max:500',
        ]);

        // Update data (tanpa upload foto)
        $restaurant->update($validated);

        return redirect()->back()->with('success', 'Profil restoran berhasil diperbarui!');
    }
}
