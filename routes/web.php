<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DokterController as ControllersDokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\Erm\DokterController;
use App\Http\Controllers\Erm\PerawatController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\KategoriObatController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LaravoltController;
use App\Http\Controllers\MesinAntrianController;
use App\Http\Controllers\NotaPembelianController;
use App\Http\Controllers\NotaPenjualanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\OrderObatController;
use App\Http\Controllers\Pendaftaran\PendaftaranController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\SatuanObatController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\KasirController;
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
Auth::routes(['verfiy' => true]);
Route::get('verifikasi_akun', [VerificationController::class, 'verifikasi_akun'])->name('verifikasi_akun');
Route::post('verifikasi_kirim', [VerificationController::class, 'verifikasi_kirim'])->name('verifikasi_kirim');
Route::get('mesinantrian', [MesinAntrianController::class, 'mesinantrian'])->name('mesinantrian');


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

        Route::post('tarif/import',  [TarifController::class, 'import'])->name('tarif.import');
        Route::get('icd10',  [DiagnosaController::class, 'index_icd10']);
        Route::get('icd9',  [DiagnosaController::class, 'index_icd9']);
    });
    Route::middleware('permission:farmasi')->prefix('farmasi')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::post('barang/import',  [BarangController::class, 'import'])->name('barang.import');
        Route::resource('notapembelian', NotaPembelianController::class);
        Route::resource('notapenjualan', NotaPenjualanController::class);
        Route::resource('stok', StokController::class);
        Route::resource('satuanbarang', SatuanBarangController::class);
        Route::resource('kategoriobat', KategoriObatController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('transaksi', TransaksiController::class);
    });
    Route::middleware('permission:pendaftaran')->group(function () {
        Route::get('pendaftaran', [PendaftaranController::class, 'indexPendaftaran'])->name('pendaftaran');
        Route::post('datapasienbaru', [PendaftaranController::class, 'dataPasienBaru'])->name('datapasienbaru');
        Route::post('pendaftaranpasien', [PendaftaranController::class, 'formPendaftaran'])->name('pendaftaranpasien');
        Route::post('pencaripasien', [PendaftaranController::class, 'pencarianPasien'])->name('pencaripasien');
        Route::post('simpanpendaftaran', [PendaftaranController::class, 'simpanPendfataran'])->name('simpanpendaftaran');

        Route::prefix('pendaftaran')->group(function () {
            Route::resource('kunjungan', KunjunganController::class);
            Route::resource('pasien', PasienController::class);
        });
    });
    Route::middleware('permission:dokter')->group(function () {
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
        Route::post('simpantindakan', [DokterController::class, 'simpanTindakan'])->name('simpantindakan');
        Route::post('simpanttddokter', [DokterController::class, 'simpanTtdDokter'])->name('simpanttddokter');
        Route::post('ambilriwayattindakan', [DokterController::class, 'riwayatTindakan'])->name('ambilriwayattindakan');
        Route::post('simpanorderfarmasi', [DokterController::class, 'simpanOrderFarmasi'])->name('simpanorderfarmasi');
        Route::post('ambilriwayatorder', [DokterController::class, 'ambilRiwayatOrder'])->name('ambilriwayatorder');
        Route::post('detailriwayatorder', [DokterController::class, 'detailriwayatorder'])->name('detailriwayatorder');
    });
    Route::middleware('permission:perawat')->group(function () {
        Route::get('ermperawat', [PerawatController::class, 'indexPerawat'])->name('ermperawat');
        Route::post('indexermperawat', [PerawatController::class, 'indexErmPerawat'])->name('indexermperawat');
        Route::post('formcatatanmedis_perawat', [PerawatController::class, 'formCatatanMedis'])->name('formcatatanmedis_perawat');
        Route::post('formpemeriksaan_perawat', [PerawatController::class, 'formPemeriksaan'])->name('formpemeriksaan_perawat');
        Route::post('simpanpemeriksaanperawat', [PerawatController::class, 'simpanForm'])->name('simpanpemeriksaanperawat');
        Route::post('resumeperawat', [PerawatController::class, 'resumePerawat'])->name('resumeperawat');
        Route::post('simpanttdperawat', [PerawatController::class, 'simpanTtdPerawat'])->name('simpanttdperawat');
        Route::post('detailriwayatorder', [DokterController::class, 'detailriwayatorder'])->name('detailriwayatorder');
    });
    Route::middleware('permission:kasir')->group(function(){
        Route::get('pembayaran', [KasirController::class, 'index'])->name('pembayaran');
        Route::post('ambildatakunjungan', [KasirController::class, 'ambildatakunjungan'])->name('ambildatakunjungan');
        Route::post('detailbayar', [KasirController::class, 'detailbayar'])->name('detailbayar');
        Route::post('bayarlayanan', [KasirController::class, 'bayarlayanan'])->name('bayarlayanan');
        Route::post('simpanpembayaran', [KasirController::class, 'simpanpembayaran'])->name('simpanpembayaran');
    });
});
