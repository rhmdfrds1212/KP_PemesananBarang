<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/tentang-kami', function () {
    return view('about');
})->name('tentangkami');

Route::get('/home', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');


Route::post('/keranjang/add', [KeranjangController::class, 'add'])->name('keranjang.add');
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::delete('/keranjang/delete/{id}', [KeranjangController::class, 'delete'])->name('keranjang.delete');
Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
Route::post('/pembayaran/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');

Route::resource('lokasi', LokasiController::class);
Route::resource('produk', ProdukController::class);
Route::resource('pembayaran', PembayaranController::class);
Route::resource('pemesanan', PemesananController::class);
Route::resource('detail_produks', DetailProdukController::class); 
Route::resource('home', HomeController::class);
Route::resource('pembayaran', PembayaranController::class)->except(['store']);

require __DIR__.'/auth.php';