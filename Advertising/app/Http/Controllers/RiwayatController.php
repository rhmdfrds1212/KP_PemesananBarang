<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Pemesanan::with(['user', 'produk', 'lokasi'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat.index', compact('riwayat'));
    }
    
}