<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MappingController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\ManajemenControllerAdmin;
use App\Http\Controllers\upload\simple_interest\tblcorporateController;
use App\Http\Controllers\upload\simple_interest\tblmasterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


use App\Http\Controllers\MappingAdminController;

use App\Http\Controllers\report\Report_Accrual_Interest\simpleinterestController as acrualsiControler;
use App\Http\Controllers\report\Report_Accrual_Interest\effectiveController as acrualeffControler;
use App\Http\Controllers\report\Report_Amortised_Cost\simpleinterestController as amorcostsiController;
use App\Http\Controllers\report\Report_Amortised_Cost\effectiveController as amorcosteffControler;

use App\Http\Controllers\report\Report_Amortised_Initial_Cost\simpleinterestController as amorinitcostsiControler;
use App\Http\Controllers\report\Report_Amortised_Initial_Cost\effectiveController as amorinitcosteffControler;

use App\Http\Controllers\report\Report_Amortised_Initial_Fee\simpleinterestController as amorinitfeesiControler;
use App\Http\Controllers\report\Report_Amortised_Initial_Fee\effectiveController as amorinitfeeeffControler;

use App\Http\Controllers\report\Report_Expective_Cash_Flow\simpleinterestController as expectcfsiControler;
use App\Http\Controllers\report\Report_Expective_Cash_Flow\effectiveController as expectcfeffControler;

use App\Http\Controllers\report\Report_Interest_Deffered\simpleinterestController as interestdeffsiControler;
use App\Http\Controllers\report\Report_Interest_Deffered\effectiveController as interestdeffeffControler;

use App\Http\Controllers\report\Report_Journal\simpleinterestController as journalsiControler;
use App\Http\Controllers\report\Report_Journal\effectiveController as journaleffControler;

use App\Http\Controllers\report\Report_Outstanding\simpleinterestController as outstandsiControler;
use App\Http\Controllers\report\Report_Outstanding\effectiveController as outstandeffControler;


use App\Models\Mapping;

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
Route::get('/pricing', [MappingController::class, 'show'])->name('pricing.show');
Route::post('/mapping/save', [MappingController::class, 'save'])->name('mapping.save');


// Rute untuk manajemen user (Super Admin)
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/usermanajemen', [ManajemenController::class, 'index'])->name('usermanajemen');
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
    Route::get('/admin/usermanajemen', [ManajemenControllerAdmin::class, 'index'])->name('admin.usermanajemen');
    Route::get('/admin/add/user', [ManajemenControllerAdmin::class, 'loadadduseradmin'])->name('load.admin.add.user');
    Route::post('/admin/add/user', [ManajemenControllerAdmin::class, 'AddUserAdmin'])->name('AddUserAdmin');
    Route::get('/admin/edit/user/{user_id}', [ManajemenControllerAdmin::class, 'loadeditadmin'])->name('admin.edit.user');
    Route::post('/admin/edit/user/{user_id}', [ManajemenControllerAdmin::class, 'EditUserAdmin'])->name('admin.update.user');
    Route::get('/admin/delete/user/{user_id}', [ManajemenControllerAdmin::class, 'deleteadmin'])->name('admin.delete.user');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mappings', [MappingAdminController::class, 'index'])->name('mappings.index');
    Route::get('/mappings/{userId}', [MappingAdminController::class, 'show'])->name('mappings.show');
});

// Rute untuk report accrual simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-accrual-simple-interest', [acrualsiControler::class, 'index'])->name('report-acc-si.index');
    Route::get('/report-accrual-simple-interest/view/{no_acc}', [acrualsiControler::class, 'view'])->name('report-acc-si.view');
    Route::get('/report-accrual-simple-interest/export-pdf/{no_acc}', [acrualsiControler::class, 'exportPdf'])->name('report-acc-si.exportPdf');
    Route::get('/report-accrual-simple-interest/export-excel/{no_acc}', [acrualsiControler::class, 'exportExcel'])->name('report-acc-si.exportExcel');
});
// Rute untuk report accrual effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-accrual-effective', [acrualeffControler::class, 'index'])->name('report-acc-eff.index');
    Route::get('/report-accrual-effective/view/{no_acc}', [acrualeffControler::class, 'view'])->name('report-acc-eff.view');
    Route::get('/report-accrual-effective/export-pdf/{no_acc}', [acrualeffControler::class, 'exportPdf'])->name('report-acc-eff.exportPdf');
    Route::get('/report-accrual-effective/export-excel/{no_acc}', [acrualeffControler::class, 'exportExcel'])->name('report-acc-eff.exportExcel');
});

// Rute untuk report amortised cost simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-amortised-cost-simple-interest', [amorcostsiController::class, 'index'])->name('report-amorcost-si.index');
    Route::get('/report-amortised-cost-simple-interest/view/{no_acc}', [amorcostsiController::class, 'view'])->name('report-amorcost-si.view');
    Route::get('/report-amortised-cost-simple-interest/export-pdf/{no_acc}', [amorcostsiController::class, 'exportPdf'])->name('report-amorcost-si.exportPdf');
    Route::get('/report-amortised-cost-simple-interest/export-excel/{no_acc}', [amorcostsiController::class, 'exportExcel'])->name('report-amorcost-si.exportExcel');
});
// Rute untuk report amortised cost effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-amortised-cost-effective', [amorcosteffControler::class, 'index'])->name('report-amorcost-eff.index');
    Route::get('/report-amortised-cost-effective/view/{no_acc}', [amorcosteffControler::class, 'view'])->name('report-amorcost-eff.view');
    Route::get('/report-amortised-cost-effective/export-pdf/{no_acc}', [amorcosteffControler::class, 'exportPdf'])->name('report-amorcost-eff.exportPdf');
    Route::get('/report-amortised-cost-effective/export-excel/{no_acc}', [amorcosteffControler::class, 'exportExcel'])->name('report-amorcost-eff.exportExcel');
});


// Rute untuk report amortised initial cost simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-amortised-initial-cost-simple-interest', [amorinitcostsiControler::class, 'index'])->name('report-amorinitcost-si.index');
    Route::get('/report-amortised-initial-cost-simple-interest/view/{no_acc}', [amorinitcostsiControler::class, 'view'])->name('report-amorinitcost-si.view');
    Route::get('/report-amortised-initial-cost-simple-interest/export-pdf/{no_acc}', [amorinitcostsiControler::class, 'exportPdf'])->name('report-amorinitcost-si.exportPdf');
    Route::get('/report-amortised-initial-cost-simple-interest/export-excel/{no_acc}', [amorinitcostsiControler::class, 'exportExcel'])->name('report-amorinitcost-si.exportExcel');
});
// Rute untuk report amortised-initial-cost effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-amortised-initial-cost-effective', [amorinitcosteffControler::class, 'index'])->name('report-amorinitcost-eff.index');
    Route::get('/report-amortised-initial-cost-effective/view/{no_acc}', [amorinitcosteffControler::class, 'view'])->name('report-amorinitcost-eff.view');
    Route::get('/report-amortised-initial-cost-effective/export-pdf/{no_acc}', [amorinitcosteffControler::class, 'exportPdf'])->name('report-amorinitcost-eff.exportPdf');
    Route::get('/report-amortised-initial-cost-effective/export-excel/{no_acc}', [amorinitcosteffControler::class, 'exportExcel'])->name('report-amorinitcost-eff.exportExcel');
});

// Rute untuk report amortised initial fee simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-amortised-initial-fee-simple-interest', [amorinitfeesiControler::class, 'index'])->name('report-amorinitfee-si.index');
    Route::get('/report-amortised-initial-fee-simple-interest/view/{no_acc}', [amorinitfeesiControler::class, 'view'])->name('report-amorinitfee-si.view');
    Route::get('/report-amortised-initial-fee-simple-interest/export-pdf/{no_acc}', [amorinitfeesiControler::class, 'exportPdf'])->name('report-amorinitfee-si.exportPdf');
    Route::get('/report-amortised-initial-fee-simple-interest/export-excel/{no_acc}', [amorinitfeesiControler::class, 'exportExcel'])->name('report-amorinitfee-si.exportExcel');
});
// Rute untuk report amortised-initial-cost effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-amortised-initial-fee-effective', [amorinitfeeeffControler::class, 'index'])->name('report-amorinitfee-eff.index');
    Route::get('/report-amortised-initial-fee-effective/view/{no_acc}', [amorinitfeeeffControler::class, 'view'])->name('report-amorinitfee-eff.view');
    Route::get('/report-amortised-initial-fee-effective/export-pdf/{no_acc}', [amorinitfeeeffControler::class, 'exportPdf'])->name('report-amorinitfee-eff.exportPdf');
    Route::get('/report-amortised-initial-fee-effective/export-excel/{no_acc}', [amorinitfeeeffControler::class, 'exportExcel'])->name('report-amorinitfee-eff.exportExcel');
});

// Rute untuk report expective cash flow simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-expective-cash-flow-simple-interest', [expectcfsiControler::class, 'index'])->name('report-expectcf-si.index');
    Route::get('/report-expective-cash-flow-simple-interest/view/{no_acc}', [expectcfsiControler::class, 'view'])->name('report-expectcf-si.view');
    Route::get('/report-expective-cash-flow-simple-interest/export-pdf/{no_acc}', [expectcfsiControler::class, 'exportPdf'])->name('report-expectcf-si.exportPdf');
    Route::get('/report-expective-cash-flow-simple-interest/export-excel/{no_acc}', [expectcfsiControler::class, 'exportExcel'])->name('report-expectcf-si.exportExcel');
});
// Rute untuk report expective cash flow effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-expective-cash-flow-effective', [expectcfeffControler::class, 'index'])->name('report-expectcfeff-eff.index');
    Route::get('/report-expective-cash-flow-effective/view/{no_acc}', [expectcfeffControler::class, 'view'])->name('report-expectcfeff-eff.view');
    Route::get('/report-expective-cash-flow-effective/export-pdf/{no_acc}', [expectcfeffControler::class, 'exportPdf'])->name('report-expectcfeff-eff.exportPdf');
    Route::get('/report-expective-cash-flow-effective/export-excel/{no_acc}', [expectcfeffControler::class, 'exportExcel'])->name('report-expectcfeff-eff.exportExcel');
});

// Rute untuk report interest deferred simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-interest-deferred-simple-interest', [interestdeffsiControler::class, 'index'])->name('report-interestdeff-si.index');
    Route::get('/report-interest-deferred-simple-interest/view/{no_acc}', [interestdeffsiControler::class, 'view'])->name('report-interestdeff-si.view');
    Route::get('/report-interest-deferred-simple-interest/export-pdf/{no_acc}', [interestdeffsiControler::class, 'exportPdf'])->name('report-interestdeff-si.exportPdf');
    Route::get('/report-interest-deferred-simple-interest/export-excel/{no_acc}', [interestdeffsiControler::class, 'exportExcel'])->name('report-interestdeff-si.exportExcel');
});
// Rute untuk report interest deferred effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-interest-deferred-effective', [interestdeffeffControler::class, 'index'])->name('report-interestdeff-eff.index');
    Route::get('/report-interest-deferred-effective/view/{no_acc}', [interestdeffeffControler::class, 'view'])->name('report-interestdeff-eff.view');
    Route::get('/report-interest-deferred-effective/export-pdf/{no_acc}', [interestdeffeffControler::class, 'exportPdf'])->name('report-interestdeff-eff.exportPdf');
    Route::get('/report-interest-deferred-effective/export-excel/{no_acc}', [interestdeffeffControler::class, 'exportExcel'])->name('report-interestdeff-eff.exportExcel');
});

// Rute untuk report journal simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-journal-simple-interest', [journalsiControler::class, 'index'])->name('report-journal-si.index');
    Route::get('/report-journal-simple-interest/view/{no_acc}', [journalsiControler::class, 'view'])->name('report-journal-si.view');
    Route::get('/report-journal-simple-interest/export-pdf/{no_acc}', [journalsiControler::class, 'exportPdf'])->name('report-journal-si.exportPdf');
    Route::get('/report-journal-simple-interest/export-excel/{no_acc}', [journalsiControler::class, 'exportExcel'])->name('report-journal-si.exportExcel');
});
// Rute untuk report journal effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-journal-effective', [journaleffControler::class, 'index'])->name('report-journal-eff.index');
    Route::get('/report-journal-effective/view/{no_acc}', [journaleffControler::class, 'view'])->name('report-journal-eff.view');
    Route::get('/report-journal-effective/export-pdf/{no_acc}', [journaleffControler::class, 'exportPdf'])->name('report-journal-eff.exportPdf');
    Route::get('/report-journal-effective/export-excel/{no_acc}', [journaleffControler::class, 'exportExcel'])->name('report-journal-eff.exportExcel');
});

// Rute untuk report outstanding simple interest
Route::middleware(['auth'])->group(function () {
    Route::get('/report-outstanding-simple-interest', [outstandsiControler::class, 'index'])->name('report-outstanding-si.index');
    Route::get('/report-outstanding-simple-interest/view/{no_acc}', [outstandsiControler::class, 'view'])->name('report-outstanding-si.view');
    Route::get('/report-outstanding-simple-interest/export-pdf/{no_acc}', [outstandsiControler::class, 'exportPdf'])->name('report-outstanding-si.exportPdf');
    Route::get('/report-outstanding-simple-interest/export-excel/{no_acc}', [outstandsiControler::class, 'exportExcel'])->name('report-outstanding-si.exportExcel');
});
// Rute untuk report outstanding effective
Route::middleware(['auth'])->group(function () {
    Route::get('/report-outstanding-effective', [outstandeffControler::class, 'index'])->name('report-outstanding-eff.index');
    Route::get('/report-outstanding-effective/view/{no_acc}', [outstandeffControler::class, 'view'])->name('report-outstanding-eff.view');
    Route::get('/report-outstanding-effective/export-pdf/{no_acc}', [outstandeffControler::class, 'exportPdf'])->name('report-outstanding-eff.exportPdf');
    Route::get('/report-outstanding-effective/export-excel/{no_acc}', [outstandeffControler::class, 'exportExcel'])->name('report-outstanding-eff.exportExcel');
});



Route::get('/sedang-dalam-pengembangan', function () {
    return view('sedang-dalam-pengembangan');
})->name('under');

Route::middleware(['auth'])->group(function () {
    Route::get('/upload/tblcorporate', [tblcorporateController::class, 'index'])->name('corporate.index');

});
Route::post('/execute-stored-procedure', [tblcorporateController::class, 'executeStoredProcedure'])->name('execute.stored.procedure');
Route::post('/import-excel', [tblcorporateController::class, 'importExcel'])->name('import.excel');

Route::get('/tblmaster', [tblmasterController::class, 'index'])->name('tblmaster.index');
Route::post('/tblmaster/import', [tblmasterController::class, 'importExcel'])->name('tblmaster.import');
Route::post('/execute-stored-procedure', [tblmasterController::class, 'executeStoredProcedure'])->name('execute.stored.procedure');
