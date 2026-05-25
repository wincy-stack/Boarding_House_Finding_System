<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/listings', [HomeController::class, 'listings']);
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Guest-only auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated-only logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin-only management routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('boarding-houses', BoardingHouseController::class)->except(['index', 'show']);
    
    Route::get('/rent', [RentalController::class, 'index'])->name('rentals.index');
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::post('/rentals/{rental}/end', [RentalController::class, 'endRental'])->name('rentals.end');

    // Bookings admin
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');

    // Tenants
    Route::post('/tenants/{tenant}/move-out', [TenantController::class, 'moveOut'])->name('tenants.move-out');
    Route::resource('tenants', TenantController::class);

    // Payments
    Route::resource('payments', PaymentController::class)->only(['index', 'create', 'store', 'destroy']);
});

// Public resource view routes (keep index/show public)
Route::resource('boarding-houses', BoardingHouseController::class)->only(['index', 'show']);