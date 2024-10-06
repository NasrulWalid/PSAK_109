<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ManajemenController;

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

// Route untuk menampilkan halaman manajemen user
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/usermanajemen', [ManajemenController::class, 'index'])->name('usermanajemen');
});

// Route untuk menambah user
Route::get('/add/user', [ManajemenController::class, 'tambahuser']);
Route::post('/add/user', [ManajemenController::class, 'AddUser'])->name('AddUser');

// Route untuk edit user
Route::get('/edit/{id}', [ManajemenController::class,'loadedit']);
Route::get('/delete/{id}', [ManajemenController::class,'delete']);

Route::post('/edit/user', [ManajemenController::class,'EditUser'])->name('EditUser');
