<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\ManajemenControllerAdmin;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('landing/home');
});

// Normal User
Route::get('/dashboard', function () {
    return view('user/dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

// Super Admin Dashboard
Route::get('/superadmin/dashboard', function () {
    return view('superadmin/dashboard');
})->middleware(['auth', 'verified', 'superadmin'])->name('superadmin.dashboard');

// Rute untuk profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk halaman pricing
require __DIR__.'/auth.php';
Route::get('/pricing', [PricingController::class, 'show'])->name('pricing.show');
Route::get('/pricing', [PricingController::class, 'showsuperadmin'])->name('superadmin.pricing.show');

// Rute untuk manajemen user (Super Admin)
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/usermanajemen', [ManajemenController::class, 'index'])->name('usermanajemen');
    
    // Rute untuk menambah user superadmin
    Route::get('/add/user', [ManajemenController::class, 'tambahuser'])->name('superadmin.add.user');
    Route::post('/add/user', [ManajemenController::class, 'AddUser'])->name('superadmin.AddUser');

    // Rute untuk edit user superadmin
    Route::get('/edit/user/{id}', [ManajemenController::class, 'loadedit'])->name('superadmin.edit.user');
    Route::post('/edit/user/{id}', [ManajemenController::class, 'EditUser'])->name('superadmin.EditUser');

    // Rute untuk delete user superadmin
    Route::get('/delete/user/{id}', [ManajemenController::class, 'delete'])->name('superadmin.delete.user');
});

// Rute untuk manajemen user (Admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/usermanajemen', [ManajemenControllerAdmin::class, 'index'])->name('admin.usermanajemen');
    
    // Rute untuk menambah user admin
    Route::get('/admin/add/user', [ManajemenControllerAdmin::class, 'tambahuseradmin'])->name('admin.add.user');
    Route::post('/admin/add/user', [ManajemenControllerAdmin::class, 'AddUserAdmin'])->name('AddUserAdmin');

    // Rute untuk edit user admin
    Route::get('/admin/edit/user/{id}', [ManajemenControllerAdmin::class, 'loadeditadmin'])->name('admin.edit.user');
    Route::post('/admin/edit/user/{id}', [ManajemenControllerAdmin::class, 'EditUserAdmin'])->name('admin.update.user');

    // Rute untuk delete user admin
    Route::get('/admin/delete/user/{id}', [ManajemenControllerAdmin::class, 'deleteadmin'])->name('admin.delete.user');
});
