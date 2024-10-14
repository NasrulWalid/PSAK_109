<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\PricingControllerSuperAdmin;
use App\Http\Controllers\PricingControllerAdmin;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\ManajemenControllerAdmin;
use App\Http\Controllers\ReportEffectiveController;
use App\Http\Controllers\report\Report_Accrual_Interest\Reportcontroller;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('landing/home');
});

// Rute untuk profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// auth laravel breeze
require __DIR__.'/auth.php';

// Rute untuk dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    // Normal User Dashboard
    Route::get('/dashboard', function () {
        return view('user/dashboard');
    })->middleware('user')->name('dashboard');

    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin/dashboard');
    })->middleware('admin')->name('admin.dashboard');

    // Super Admin Dashboard
    Route::get('/superadmin/dashboard', function () {
        return view('superadmin/dashboard');
    })->middleware('superadmin')->name('superadmin.dashboard');
});

// Rute untuk halaman pricing user
Route::get('/pricing', [PricingController::class, 'show'])->name('pricing.show');

// Rute untuk manajemen user (Super Admin)
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/usermanajemen', [ManajemenController::class, 'index'])->name('usermanajemen');
    Route::get('/superadmin/pricing', [PricingControllerSuperAdmin::class, 'showsuperadmin'])->name('superadmin.pricing.show');
    Route::get('/add/user', [ManajemenController::class, 'tambahuser'])->name('superadmin.add.user');
    Route::post('/add/user', [ManajemenController::class, 'AddUser'])->name('superadmin.AddUser');

    // Rute untuk edit user superadmin
    Route::get('/edit/user/{user_id}', [ManajemenController::class, 'loadedit'])->name('superadmin.edit.user');
    Route::post('/edit/user/{user_id}', [ManajemenController::class, 'EditUser'])->name('superadmin.update.user');

    // Rute untuk delete user superadmin
    Route::get('/delete/user/{user_id}', [ManajemenController::class, 'delete'])->name('superadmin.delete.user');
});

// Rute untuk manajemen user (Admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/pricing', [PricingControllerAdmin::class, 'showadmin'])->name('admin.pricing.show');
    Route::get('/admin/usermanajemen', [ManajemenControllerAdmin::class, 'index'])->name('admin.usermanajemen');
    Route::get('/admin/add/user', [ManajemenControllerAdmin::class, 'loadadduseradmin'])->name('load.admin.add.user');
    Route::post('/admin/add/user', [ManajemenControllerAdmin::class, 'AddUserAdmin'])->name('AddUserAdmin');
    Route::get('/admin/edit/user/{user_id}', [ManajemenControllerAdmin::class, 'loadeditadmin'])->name('admin.edit.user');
    Route::post('/admin/edit/user/{user_id}', [ManajemenControllerAdmin::class, 'EditUserAdmin'])->name('admin.update.user');
    Route::get('/admin/delete/user/{user_id}', [ManajemenControllerAdmin::class, 'deleteadmin'])->name('admin.delete.user');

    // Rute Report
    Route::get('/admin/amortisedcost', [ReportEffectiveController::class, 'showreportamortisedcost'])->name('admin.amortise.cost');
});

// Rute untuk report
Route::middleware(['auth'])->group(function () {
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/view/{no_acc}', [ReportController::class, 'view'])->name('report.view');
    Route::get('/report/export-pdf/{no_acc}', [ReportController::class, 'exportPdf'])->name('report.exportPdf');
    Route::get('/report/export-excel/{no_acc}', [ReportController::class, 'exportExcel'])->name('report.exportExcel');
});

Route::get('/sedang-dalam-pengembangan', function () {
    return view('sedang-dalam-pengembangan');
})->name('under');
