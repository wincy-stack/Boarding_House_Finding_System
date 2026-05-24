<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/listings', [HomeController::class, 'listings']);

Route::get('/rent', [RentalController::class, 'index'])->name('rentals.index');
Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
Route::post('/rentals/{rental}/end', [RentalController::class, 'endRental'])->name('rentals.end');

Route::resource('boarding-houses', BoardingHouseController::class);

// Bookings / Inquiries
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::post('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');

// Tenants
Route::post('/tenants/{tenant}/move-out', [TenantController::class, 'moveOut'])->name('tenants.move-out');
Route::resource('tenants', TenantController::class);

// Payments
Route::resource('payments', PaymentController::class)->only(['index', 'create', 'store', 'destroy']);