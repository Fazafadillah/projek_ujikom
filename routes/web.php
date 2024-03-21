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
use App\Http\Controllers\MejaController;

// Route::get('/export-pdf', [PdfController::class, 'exportPDF']);
Route::get('/', [HomeController::class, 'index']);
Route::resource('jenis', JenisController::class);
Route::get('/jeniS/export-excel', [ProdukTitipanController::class, 'exportExcel'])->name('jenis.export_excel');
Route::get('/Jenis/export-pdf', [JenisController::class, 'exportPDF'])->name('jenis.export_pdf');
Route::resource('menu', MenuController::class);
Route::get('/Menu/export-pdf', [MenuController::class, 'exportPDF'])->name('menu.export_pdf');
Route::resource('pelanggan', PelangganController::class);
Route::get('/Pelanggan/export-pdf', [PelangganController::class, 'exportPDF'])->name('pelanggan.export_pdf');
Route::resource('stok', StokController::class);
Route::get('/Stok/export-pdf', [StokController::class, 'exportPDF'])->name('stok.export_pdf');
Route::resource('transaksi', TransaksiController::class);
Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
Route::resource('about', AboutController::class);
Route::resource('produk_titipan', ProdukTitipanController::class);
Route::get('/produk-titipan/export-excel', [ProdukTitipanController::class, 'exportExcel'])->name('produk_titipan.export_excel');
Route::post('/produk-titipan/import-excel', [ProdukTitipanController::class, 'Excelimport'])->name('produk_titipan.import_excel');
Route::get('/produk-titipan/export-pdf', [ProdukTitipanController::class, 'exportPDF'])->name('produk_titipan.export_pdf');
Route::resource('meja', MejaController::class);
