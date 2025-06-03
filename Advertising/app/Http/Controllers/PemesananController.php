<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with(['produks', 'lokasis'])->latest()->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create(Request $request)
    {
        $produks = Produk::all();
        $lokasis = Lokasi::all();
        $produkTerpilih = null;

        if ($request->has('produk_id')) {
        $produkTerpilih = Produk::find($request->produk_id);
    }
        return view('pemesanan.create', compact('produks', 'lokasis', 'produkTerpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $totalHarga = $produk->harga * $request->jumlah;

        Pemesanan::create([
            'produk_id' => $request->produk_id,
            'lokasi_id' => $request->lokasi_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibuat.');
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['produk', 'lokasi'])->findOrFail($id);
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
