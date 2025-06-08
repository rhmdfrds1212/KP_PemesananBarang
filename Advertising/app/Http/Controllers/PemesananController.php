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
        $pemesanans = Pemesanan::with(['produk', 'lokasi'])->latest()->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create(Request $request)
    {
        $produks = Produk::all();
        $lokasis = Lokasi::all();
        $produk_id = $request->produk_id ?? null;
        $produkTerpilih = $request->has('produk_id') ? Produk::find($request->produk_id) : null;
        return view('pemesanan.create', compact('produks', 'lokasis', 'produk_id', 'produkTerpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'ukuran' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'lama_sewa' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $hargaSewa = $produk->harga;
        $totalHarga = $hargaSewa * $request->jumlah * $request->lama_sewa;

        Pemesanan::create([
            'produk_id' => $request->produk_id,
            'lokasi_id' => $request->lokasi_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'ukuran' => $request->ukuran,
            'jumlah' => $request->jumlah,
            'lama_sewa' => $request->lama_sewa,
            'harga_sewa' => $hargaSewa,
            'total_harga' => $totalHarga,
            'status' => 'menunggu',
        ]);

        $pemesanan = Pemesanan::create($request->all());

        return redirect()->route('pembayaran.show', $pemesanan->id)
                     ->with('success', 'Pemesanan berhasil, silakan lanjut ke pembayaran.');
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