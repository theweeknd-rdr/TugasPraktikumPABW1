<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Menampilkan form reservasi.
     */
    public function create($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('user.reservation.form', compact('restaurant'));
    }

    /**
     * Menyimpan data reservasi.
     */
    public function store(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'pax' => 'required|integer|min:1|max:20',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ], [
            'date.required' => 'Tanggal reservasi wajib diisi.',
            'date.after_or_equal' => 'Tanggal reservasi tidak boleh di masa lalu.',
            'time.required' => 'Waktu reservasi wajib diisi.',
            'pax.required' => 'Jumlah orang wajib diisi.',
            'pax.min' => 'Minimal 1 orang.',
            'pax.max' => 'Maksimal 20 orang per reservasi.',
            'name.required' => 'Nama wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
        ]);

        $restaurant = Restaurant::findOrFail($id);

        // Buat reservasi baru
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurant->id,
            'date' => $validated['date'],
            'time' => $validated['time'],
            'pax' => $validated['pax'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('reservation.form', $id)
            ->with('success', 'Reservasi berhasil dibuat! Kami akan segera mengkonfirmasi pesanan Anda.');
    }

    /**
     * Menampilkan detail reservasi.
     */
    public function show($id)
    {
        $reservation = Reservation::with(['restaurant', 'user'])->findOrFail($id);

        // Pastikan user hanya bisa melihat reservasinya sendiri
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        return view('user.reservation.show', compact('reservation'));
    }

    /**
     * Menampilkan daftar reservasi user.
     */
    public function index()
    {
        $reservations = Reservation::with('restaurant')
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(10);

        return view('user.reservation.index', compact('reservations'));
    }

    /**
     * Membatalkan reservasi.
     */
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Pastikan user hanya bisa membatalkan reservasinya sendiri
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // Cek apakah reservasi masih bisa dibatalkan
        if ($reservation->status === 'cancelled') {
            return back()->with('error', 'Reservasi sudah dibatalkan sebelumnya.');
        }

        if ($reservation->status === 'completed') {
            return back()->with('error', 'Reservasi yang sudah selesai tidak bisa dibatalkan.');
        }

        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
