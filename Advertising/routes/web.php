<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

    // ========================
    // 🔸 Public Pages
    // ========================
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::middleware(['auth', 'role:a|u'])->group(function () {
        Route::get('/hubungi-kami', function () {
            return view('about');
        })->name('kontak');
    });

    // ========================
    // 🔸 Auth & Verification
    // ========================
    require __DIR__ . '/auth.php';

    // ========================
    // 🔸 Halaman Setelah Login
    // ========================
    Route::middleware(['auth', 'verified'])->group(function () {
        // ========================
        // 🔹 Profile (User)
        // ========================
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::middleware(['auth', 'role:u|a'])->group(function () {
            Route::get('/profile/pemesanan', function() {
                return redirect()->route('pemesanan.index');
            })->name('profile.pemesanan');
            Route::get('/invoice', [ProfileController::class, 'invoice'])->name('profile.invoice');
        });
    });

    Route::middleware(['auth', 'role:u'])->group(function () {
        Route::get('/histori', [ProfileController::class, 'histori'])->name('profile.histori');
    });
    // ========================
    // 🔹 Dashboard (Admin Only)
    // ========================
    Route::middleware(['auth', 'role:a'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // ========================
    // 🔹 Kelola Pelanggan (Admin Only)
    // ========================
    Route::prefix('admin')->group(function () {
        Route::middleware(['auth', 'role:a'])->group(function () {
            Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
            Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
            Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
            Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
        });

        // Pembayaran (Admin Verifikasi)
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
        Route::post('/pembayaran/{id}/update-status', [PembayaranController::class, 'updateStatus'])->name('admin.pembayaran.updateStatus');
        Route::put('/admin/pembayaran/{id}/selesai', [PembayaranController::class, 'selesaikan'])->name('pembayaran.selesai');

    });

    // ========================
    // 🔹 Riwayat Transaksi (Admin)
    // ========================
    Route::middleware(['auth', 'role:a'])->group(function () {
        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
        Route::put('/riwayat/{id}', [RiwayatController::class, 'update'])->name('riwayat.update');
        Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');
    });

    // ========================
    // 🔹 Produk dan Detail Produk
    // ========================
    Route::middleware(['auth', 'role:u'])->group(function () {
        Route::resource('produk/detail_produks', DetailProdukController::class);
    });
    Route::resource('produk', ProdukController::class);

    // ========================
    // 🔹 Lokasi
    // ========================
    Route::resource('lokasi', LokasiController::class);

    // ========================
    // 🔹 Pemesanan
    // ========================
    Route::middleware(['auth', 'role:u'])->group(function () {
        Route::get('/pemesanan/create/{id}', [PemesananController::class, 'create'])->name('pemesanan.create');
        Route::put('/pemesanan/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
        Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
        Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
        Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
    });

    Route::middleware(['auth', 'role:u'])->group(function () {
        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::get('/pemesanan/{id}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
    });
    // ========================
    // 🔹 Pembayaran
    // ========================
    Route::middleware(['role:u'])->group(function () {
        Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
        Route::post('/pembayaran/store/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');
    });

    // Untuk Admin Kelola Pembayaran
    Route::get('/admin/pembayaran', [PembayaranController::class, 'adminIndex'])->name('admin.pembayaran.index');
    Route::put('/admin/pembayaran/{id}/{status}', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');


    // ========================
    // 🔹 Laporan
    // ========================
    Route::middleware(['auth', 'role:a|p'])->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

    // ========================
    // 🔹 Home (CMS)
    // ========================
    Route::resource('home', HomeController::class);
});