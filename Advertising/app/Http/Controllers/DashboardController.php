<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('pemesanan')
            ->where('status_verifikasi', 'diterima')
            ->get();

        $totalPendapatan = $pembayarans->sum(function ($pembayaran) {
            return $pembayaran->pemesanan->total_harga ?? 0;
        });
        $chartLabels = [];
        $chartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->translatedFormat('F'); // Nama bulan dalam Bahasa Indonesia
            $chartLabels[] = $monthName;

            $jumlahPemesanan = Pemesanan::whereMonth('created_at', $i)
                                ->whereYear('created_at', now()->year)
                                ->count();

            $chartData[] = $jumlahPemesanan;
        }

        return view('admin.dashboard', [
            'totalPendapatan' => $totalPendapatan,
            'totalPemesanan' => Pemesanan::count(),
            'totalProduk' => Produk::count(),
            'totalLokasi' => Lokasi::count(),
            'totalPelanggan' => User::where('role', 'u')->count(),
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
        ]);
    }
}