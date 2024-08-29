<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AccountController;



use App\Http\Controllers\SummaryController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('login', 'checkLogin')->name('checklogin');
});

Route::group(['middleware' => ['auth', 'acl:web']], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::controller(ReportController::class)->group(function () {
        Route::get('/progres-lapor-kerusakan', 'index')->name('reportasset.progress');
        Route::get('/lapor-kerusakan', 'form')->name('reportasset.add');
        Route::post('/lapor-kerusakan/store', 'save')->name('report.store');

        Route::get('/menilai-kelayakan-aset', 'check')->name('reportasset.check');
        Route::post('/menilai-kelayakan-aset/approved', 'approved')->name('report.approved');
        Route::post('/menilai-kelayakan-aset/rejected', 'rejected')->name('report.rejected');

    });

    Route::controller(ProposalController::class)->group(function () {
        Route::get('/melihat-progress-pengajuan-ph', 'index')->name('ph.progress');
        Route::get('/mengajukan-proposal-harga', 'form')->name('ph.submit');
        Route::post('/mengajukan-proposal-harga/store', 'save')->name('ph.store');

        Route::get('/meninjau-proposal-harga', 'check')->name('review.index');

        Route::post('/meninjau-proposal-harga/approved', 'approved')->name('review.approved');
        Route::post('/meninjau-proposal-harga/rejected', 'rejected')->name('review.rejected');

    });

    Route::controller(PurchaseOrderController::class)->group(function () {
        Route::get('/melihat-purchase-order', 'index')->name('po.index');
        Route::get('/membuat-purchase-order', 'form')->name('po.add');
        Route::post('/membuat-purchase-order/store', 'save')->name('po.store');
        Route::get('/purchase-order/{id}', 'pdf')->name('po.pdf');
    });
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/melihat-progress-invoice', 'index')->name('invoice.index');
        Route::get('/mengunggah-invoice', 'form')->name('invoice.add');
        Route::post('/mengunggah-invoice/store', 'save')->name('invoice.store');
        Route::get('/pembayaran-invoice', 'payment')->name('payment.index');
        Route::post('/pembayaran-invoice/save', 'savePayment')->name('payment.save');
    });
    Route::controller(AssetController::class)->group(function () {
        Route::get('/melihat-database-aset', 'index')->name('asset.index');
        Route::get('/mengisi-asset-register', 'form')->name('asset.add');
        Route::post('/mengisi-asset-register/store', 'save')->name('asset.store');
        Route::get('/data-purchase-order-detail/{id}', 'getPoDetails')->name('asset.podetail');
    });

    Route::controller(AccountController::class)->group(function () {
        Route::get('/melihat-database-account', 'index')->name('account.index');
        Route::get('/daftar-account', 'form')->name('account.add');
        Route::post('/daftar-account/store', 'save')->name('account.store');
        Route::get('/daftar-account/edit/{id}', 'edit')->name('account.edit');
        Route::get('/daftar-account/delete/{id}', 'delete')->name('account.delete');
        Route::post('/daftar-account/update/{id}', 'update')->name('account.update');
    });

    Route::controller(SummaryController::class)->group(function(){
        Route::get('/melihat-progress-summary', 'index')->name('summary.index');
        Route::get('/mengunggah-summary', 'form')->name('summary.add');
        Route::post('/mengunggah-summary/store', 'save')->name('summary.store');
    });

});

// Route::get('/pegawai/homepage', function () {
//     return view('/pegawai/homepage');
// });

Route::get('/cgm/homepage', function () {
    return view('/cgm/homepage');
});

Route::get('/procurement/homepage', function () {
    return view('/procurement/homepage');
});

Route::get('/adminAset/homepage', function () {
    return view('/adminAset/homepage');
});

Route::get('/adminFinance/homepage', function () {
    return view('/adminFinance/homepage');
});

Route::get('/hod/homepage', function () {
    return view('/hod/homepage');
});


// Route::resource('/pegawai', LaporanController::class);
