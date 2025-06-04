<?php

use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});
Route::get('/tentang-kami', function () {
    return view('about');
})->name('tentangkami');

Route::resource('lokasi', LokasiController::class);
Route::resource('produk', ProdukController::class);
Route::resource('pembayaran', PembayaranController::class);
Route::resource('pemesanan', PemesananController::class);
Route::resource('detailProduk', DetailProdukController::class); 
Route::resource('home', HomeController::class);
