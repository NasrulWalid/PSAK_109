<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricingController;

Route::get('/', function () {
    return view('landing/home');
});

Route::get('/dashboard', function () {
    return view('user/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/dashboard',[HomeController::class,'index'])->
middleware(['auth','admin']);

// Route untuk menampilkan halaman price
Route::get('/pricing', [PricingController::class, 'show'])->name('pricing.show');