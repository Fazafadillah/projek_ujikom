<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProdukTitipanController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\UserController;
use App\Models\Categories;

//login
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login/cek', [UserController::class, 'cekLogin'])->name('cekLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// Route::get('/export-pdf', [PdfController::class, 'exportPDF']);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);


    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::resource('jenis', JenisController::class);
        Route::resource('menu', MenuController::class);
        Route::resource('stok', StokController::class);
        Route::resource('categories', CategoriesController::class);
        Route::resource('meja', MejaController::class);


        Route::get('/Jenis/export-pdf', [JenisController::class, 'exportPDF'])->name('jenis.export_pdf');
        Route::get('/Menu/export-pdf', [MenuController::class, 'exportPDF'])->name('menu.export_pdf');
        Route::get('/Stok/export-pdf', [StokController::class, 'exportPDF'])->name('stok.export_pdf');
        Route::get('/Categories/export-pdf', [CategoriesController::class, 'exportPDF'])->name('categories.export_pdf');
        Route::get('/Meja/export-pdf', [MejaController::class, 'exportPDF'])->name('meja.export_pdf');
        Route::get('export/paket', [JenisController::class, 'exportData'])->name('export-jenis');
        Route::get('export/menu', [MenuController::class, 'exportData'])->name('export-menu');
        Route::get('export/stok', [StokController::class, 'exportData'])->name('export-stok');
        Route::get('export/meja', [MejaController::class, 'exportData'])->name('export-meja');
        Route::get('export/category', [CategoriesController::class, 'exportData'])->name('export-category');
        Route::post('import-jenis', [JenisController::class, 'ImportData'])->name('import-jenis');
        Route::post('import-stok', [StokController::class, 'ImportData'])->name('import-stok');
        Route::post('import-category', [CategoriesController::class, 'ImportData'])->name('import-category');
        Route::post('import-meja', [MejaController::class, 'ImportData'])->name('import-meja');
        Route::post('import-menu', [MenuController::class, 'ImportData'])->name('import-menu');

    });
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('transaksi', TransaksiController::class);
        Route::resource('produk_titipan', ProdukTitipanController::class);
        Route::resource('absensi', AbsensiController::class);
        Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
        Route::resource('ContactUs', ContactUsController::class);
        Route::resource('about', AboutController::class);

        Route::post('import-pelanggan', [PelangganController::class, 'ImportData'])->name('import-pelanggan');
        Route::patch('/absensi/{id}', 'AbsensiController@updateStatus')->name('absensi.updateStatus');
        Route::get('export/Absen', [AbsensiController::class, 'exportData'])->name('export-absensi-jenis');
        Route::post('import/Absen', [AbsensiController::class, 'importData'])->name('import-absensi-jenis');
        Route::get('/Absensi/export-pdf', [AbsensiController::class, 'exportPDF'])->name('absensi.export_pdf');
        Route::get('/Pelanggan/export-pdf', [PelangganController::class, 'exportPDF'])->name('pelanggan.export_pdf');
        Route::get('export/pelanggan', [PelangganController::class, 'exportData'])->name('export-paket-pelanggan');
        Route::get('/produk-titipan/export-pdf', [ProdukTitipanController::class, 'exportPDF'])->name('produk_titipan.export_pdf');
    });
});
