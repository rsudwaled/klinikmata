<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DokterController as ControllersDokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\Erm\DokterController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\Pendaftaran\PendaftaranController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::middleware('permission:admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
        //apw516
        Route::get('erm', [DokterController::class, 'indexDokter'])->name('erm');
        Route::post('formpemeriksaan_dokter', [DokterController::class, 'formPemeriksaan'])->name('formpemeriksaan_dokter');
        Route::post('inputtindakan', [DokterController::class, 'formTindakan'])->name('inputtindakan');
        Route::post('orderfarmasi', [DokterController::class, 'orderFarmasi'])->name('orderfarmasi');
        Route::post('orderpenunjang', [DokterController::class, 'orderPenunjang'])->name('orderpenunjang');

        Route::get('pendaftaran', [PendaftaranController::class, 'indexPendaftaran'])->name('pendaftaran');
        Route::post('datapasienbaru', [PendaftaranController::class, 'dataPasienBaru'])->name('datapasienbaru');
        Route::post('pendaftaranpasien', [PendaftaranController::class, 'formPendaftaran'])->name('pendaftaranpasien');

        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::get('user_verifikasi/{user}', [UserController::class, 'user_verifikasi'])->name('user_verifikasi');
        Route::get('delet_verifikasi', [UserController::class, 'delet_verifikasi'])->name('delet_verifikasi');
    });

    Route::middleware('permission:admin')->prefix('administrator')->group(function () {
        Route::resource('pasien', PasienController::class);
        Route::resource('dokter', ControllersDokterController::class);
        Route::resource('kunjungan', KunjunganController::class);
        Route::resource('poliklinik', PoliklinikController::class);
        Route::resource('poliklinik', PoliklinikController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::get('icd10',  [DiagnosaController::class, 'index_icd10']);
        Route::get('icd9',  [DiagnosaController::class, 'index_icd9']);
    });
});
