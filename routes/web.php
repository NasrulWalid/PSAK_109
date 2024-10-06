<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricingController;

Route::get('/', function () {
    return view('landing/home');
});

// Normal User
Route::get('/dashboard', function () {
    return view('user/dashboard');
})->middleware(['auth', 'verified','user'])->name('dashboard');

// Admin
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified','admin'])->name('admin.dashboard');

// Super Admin
Route::get('/superadmin/dashboard', function () {
    return view('superadmin/dashboard');
})->middleware(['auth', 'verified','superadmin'])->name('superadmin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// Route untuk menampilkan halaman price
Route::get('/pricing', [PricingController::class, 'show'])->name('pricing.show');