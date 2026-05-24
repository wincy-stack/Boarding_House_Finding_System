<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\RentalController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/listings', [HomeController::class, 'listings']);

Route::get('/rent', [RentalController::class, 'index'])->name('rentals.index');
Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
Route::post('/rentals/{rental}/end', [RentalController::class, 'endRental'])->name('rentals.end');

Route::resource('boarding-houses', BoardingHouseController::class);