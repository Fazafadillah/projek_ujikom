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
use App\Http\Controllers\PdfController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MejaController;
use App\Models\Categories;

// Route::get('/export-pdf', [PdfController::class, 'exportPDF']);
Route::get('/', [HomeController::class, 'index']);
Route::resource('jenis', JenisController::class);
Route::get('/Jenis/export-pdf', [JenisController::class, 'exportPDF'])->name('jenis.export_pdf');
Route::get('export/paket', [JenisController::class, 'exportData'])->name('export-paket-jenis');
Route::resource('menu', MenuController::class);
Route::get('/Menu/export-pdf', [MenuController::class, 'exportPDF'])->name('menu.export_pdf');
Route::get('export/menu', [MenuController::class, 'exportData'])->name('export-paket-menu');
Route::resource('pelanggan', PelangganController::class);
Route::get('/Pelanggan/export-pdf', [PelangganController::class, 'exportPDF'])->name('pelanggan.export_pdf');
Route::get('export/pelanggan', [PelangganController::class, 'exportData'])->name('export-paket-pelanggan');
Route::resource('stok', StokController::class);
Route::get('/Stok/export-pdf', [StokController::class, 'exportPDF'])->name('stok.export_pdf');
Route::get('export/stok', [StokController::class, 'exportData'])->name('export-paket-stok');
Route::resource('transaksi', TransaksiController::class);
Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
Route::resource('about', AboutController::class);
Route::resource('produk_titipan', ProdukTitipanController::class);
Route::get('/produk-titipan/export-pdf', [ProdukTitipanController::class, 'exportPDF'])->name('produk_titipan.export_pdf');
Route::resource('meja', MejaController::class);
Route::get('/Meja/export-pdf', [MejaController::class, 'exportPDF'])->name('meja.export_pdf');
Route::resource('categories', CategoriesController::class);
Route::get('/Categories/export-pdf', [CategoriesController::class, 'exportPDF'])->name('categories.export_pdf');
