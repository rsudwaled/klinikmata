<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DokterController as ControllersDokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\Erm\DokterController;
use App\Http\Controllers\Erm\PerawatController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\KategoriObatController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LaravoltController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\OrderObatController;
use App\Http\Controllers\Pendaftaran\PendaftaranController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SatuanObatController;
use App\Http\Controllers\StokObatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UnitController;
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
    return view('landingpage');
});
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('get_provinsi', [LaravoltController::class, 'get_provinsi'])->name('get_provinsi');
    Route::get('get_kabupaten', [LaravoltController::class, 'get_kabupaten'])->name('get_kabupaten');
    Route::get('get_kecamatan', [LaravoltController::class, 'get_kecamatan'])->name('get_kecamatan');
    Route::get('get_desa', [LaravoltController::class, 'get_desa'])->name('get_desa');


    Route::middleware('permission:admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
        //apw516
        Route::get('erm', [DokterController::class, 'indexDokter'])->name('erm');
        Route::post('indexerm', [DokterController::class, 'indexErm'])->name('indexerm');
        Route::post('formcatatanmedis', [DokterController::class, 'formCatatanMedis'])->name('formcatatanmedis');
        Route::post('formpemeriksaan_dokter', [DokterController::class, 'formPemeriksaan'])->name('formpemeriksaan_dokter');
        Route::post('inputtindakan', [DokterController::class, 'formTindakan'])->name('inputtindakan');
        Route::post('orderfarmasi', [DokterController::class, 'orderFarmasi'])->name('orderfarmasi');
        Route::post('orderpenunjang', [DokterController::class, 'orderPenunjang'])->name('orderpenunjang');
        Route::post('resumedokter', [DokterController::class, 'resumeDokter'])->name('resumedokter');
        Route::post('gambarmata1', [DokterController::class, 'gambarMata1'])->name('gambarmata1');
        Route::post('gambarmata2', [DokterController::class, 'gambarMata2'])->name('gambarmata2');
        Route::post('simpanpemeriksaandokter', [DokterController::class, 'simpanForm'])->name('simpanpemeriksaandokter');

        Route::get('ermperawat', [PerawatController::class, 'indexPerawat'])->name('ermperawat');
        Route::post('indexermperawat', [PerawatController::class, 'indexErmPerawat'])->name('indexermperawat');
        Route::post('formcatatanmedis_perawat', [PerawatController::class, 'formCatatanMedis'])->name('formcatatanmedis_perawat');
        Route::post('formpemeriksaan_perawat', [PerawatController::class, 'formPemeriksaan'])->name('formpemeriksaan_perawat');
        Route::post('simpanpemeriksaanperawat', [PerawatController::class, 'simpanForm'])->name('simpanpemeriksaanperawat');
        Route::post('resumeperawat', [PerawatController::class, 'resumePerawat'])->name('resumeperawat');
        Route::post('simpanttdperawat', [PerawatController::class, 'simpanTtdPerawat'])->name('simpanttdperawat');

        Route::get('pendaftaran', [PendaftaranController::class, 'indexPendaftaran'])->name('pendaftaran');
        Route::post('datapasienbaru', [PendaftaranController::class, 'dataPasienBaru'])->name('datapasienbaru');
        Route::post('pendaftaranpasien', [PendaftaranController::class, 'formPendaftaran'])->name('pendaftaranpasien');
        Route::post('pencaripasien', [PendaftaranController::class, 'pencarianPasien'])->name('pencaripasien');

        Route::post('simpanpendaftaran', [PendaftaranController::class, 'simpanPendfataran'])->name('simpanpendaftaran');

        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::get('user_verifikasi/{user}', [UserController::class, 'user_verifikasi'])->name('user_verifikasi');
        Route::get('delet_verifikasi', [UserController::class, 'delet_verifikasi'])->name('delet_verifikasi');
    });

    Route::middleware('permission:admin')->prefix('administrator')->group(function () {
        Route::resource('pasien', PasienController::class);
        Route::resource('dokter', ControllersDokterController::class);
        Route::resource('kunjungan', KunjunganController::class);
        Route::resource('poliklinik', PoliklinikController::class);
        Route::resource('jadwaldokter', JadwalDokterController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('unit', UnitController::class);
        Route::resource('tarif', TarifController::class);
        Route::resource('obat', ObatController::class);
        Route::resource('satuanobat', SatuanObatController::class);
        Route::resource('kategoriobat', KategoriObatController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('stokobat', StokObatController::class);
        Route::resource('transaksi', TransaksiController::class);
        Route::post('tarif/import',  [TarifController::class, 'import'])->name('tarif.import');
        Route::post('obat/import',  [ObatController::class, 'import'])->name('obat.import');
        Route::get('icd10',  [DiagnosaController::class, 'index_icd10']);
        Route::get('icd9',  [DiagnosaController::class, 'index_icd9']);
    });
    Route::middleware('permission:farmasi')->prefix('farmasi')->group(function () {
        Route::resource('orderobat', OrderObatController::class);
    });
    Route::middleware('permission:pendaftaran')->prefix('pendaftaran')->group(function () {
        Route::resource('kunjungan', KunjunganController::class);
    });
});
