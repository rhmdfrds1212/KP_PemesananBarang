<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LaporanController;
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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/keranjang/add', [KeranjangController::class, 'add'])->name('keranjang.add');
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::delete('/keranjang/delete/{id}', [KeranjangController::class, 'delete'])->name('keranjang.delete');
Route::post('/pembayaran/store/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
Route::get('/register', [RegisteredUserController::class, 'show'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::resource('lokasi', LokasiController::class);
Route::resource('produk', ProdukController::class);
Route::resource('produk/detail_produks/pemesanan', PemesananController::class);
Route::resource('produk/detail_produks', DetailProdukController::class); 
Route::resource('home', HomeController::class);
Route::resource('pembayaran', PembayaranController::class)->except(['store']);
Route::resource('pemesanan', PemesananController::class);
Route::resource('laporan',LaporanController::class);

require __DIR__.'/auth.php';