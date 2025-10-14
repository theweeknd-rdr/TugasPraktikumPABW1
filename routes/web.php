<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::get('/TemuMakanan', [RestaurantController::class, 'index'])->name('dashboard.index');