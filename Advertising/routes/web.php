<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/histori', [ProfileController::class, 'histori'])->name('profile.histori');
    Route::get('/profile/pemesanan', [ProfileController::class, 'pemesanan'])->name('profile.pemesanan');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::put('/riwayat/{id}', [RiwayatController::class, 'update'])->name('riwayat.update');
});

// pemesanan
Route::get('/pemesanan/create{id}', [PemesananController::class, 'create'])->name('pemesanan.create');
Route::get('/pemesanan/{id}edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
Route::put('/pemesanan/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');

// pembayaran
Route::post('/pembayaran/store/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');

// register
Route::get('/register', [RegisteredUserController::class, 'show'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

// login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::resource('lokasi', LokasiController::class);
Route::resource('produk', ProdukController::class);
Route::resource('produk/detail_produks', DetailProdukController::class); 
Route::resource('home', HomeController::class);
Route::resource('laporan',LaporanController::class);

Route::get('/email/verify', function (){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('status', 'Email berhasil diverifikasi');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


require __DIR__.'/auth.php';