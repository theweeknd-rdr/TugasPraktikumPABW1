<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', fn() => view('welcome'));

Route::get('/explore', function (Request $request) {
    $query = Restaurant::where('status', 'verified');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
        });
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    return view('user.explore', [
        'restaurants' => $query->paginate(12)
    ]);
})->name('explore');

Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::get('/reservation/{id}', [ReservationController::class, 'create'])->name('reservation.form');

// ==========================================
// AUTHENTICATED ROUTES
// ==========================================
Route::middleware('auth')->group(function () {
    // User Reservations
    Route::prefix('my-reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::get('/{id}', [ReservationController::class, 'show'])->name('show');
        Route::post('/{id}/cancel', [ReservationController::class, 'cancel'])->name('cancel');
    });

    Route::post('/reservation/{id}', [ReservationController::class, 'store'])->name('reservation.store');

    // User Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Restoran Routes
    Route::prefix('restoran')->name('restoran.')->group(function () {
        Route::get('/dashboard', fn() => view('restoran.dashboard'))->name('dashboard');
        Route::get('/profile', fn() => view('restoran.profile'))->name('profile');
        Route::post('/profile/update', [RestaurantController::class, 'update'])->name('profile.update');

        // Route untuk Kelola Reservasi & Kedatangan
        Route::get('/reservasi-kedatangan', fn() => view('restoran.kelolaRestoran-kedatangan'))->name('reservasi-kedatangan');
    });
});

// ==========================================
// DASHBOARD (Multi-Role)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => view('admin.dashboard'),
            'restoran' => view('restoran.dashboard'),
            default => view('user.dashboard', [
                'restaurants' => Restaurant::where('status', 'verified')
                    ->orWhere(fn($q) => $q->limit(4))
                    ->take(4)
                    ->get()
            ])
        };
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
