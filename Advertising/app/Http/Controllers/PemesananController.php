<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'a') {
            $pemesanans = User::where('role', 'u')->get();
        } else {
            $pemesanans = Pemesanan::where('id', $user->id)->get();
        }

        $pemesanans = Pemesanan::with(['produk', 'lokasi'])->latest()->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create(Request $request, $id = null)
    {
        $produkTerpilih = Produk::findOrFail($id);

        $lokasis = Lokasi::where('produk_nama', $produkTerpilih->nama)->where('status', 'tersedia')->get();

        return view('pemesanan.create', [
            'produkTerpilih' => $produkTerpilih,
            'lokasis' => $lokasis,
            'produks' => [$produkTerpilih]
        ]);
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::with('produk')->findOrFail($id);
        $produkTerpilih = $pemesanan->produk;
        $produk = Produk::all();
        $lokasis = \App\Models\Lokasi::where('produk_nama', $produkTerpilih->nama)
                    ->where('status', 'tersedia')->get();

        return view('pemesanan.edit', [
            'pemesanan' => $pemesanan,
            'produkTerpilih' => $produkTerpilih,
            'lokasis' => $lokasis
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasi_id' => 'required|exists:lokasis,id',
            'ukuran' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'lama_sewa' => 'required|integer|min:1',
            'status' => 'required|in:menunggu,diproses,selesai'
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $produk = $pemesanan->produk;
        $totalHarga = $produk->harga * $request->jumlah * $request->lama_sewa;

        $pemesanan->update([
            'lokasi_id' => $request->lokasi_id,
            'ukuran' => $request->ukuran,
            'jumlah' => $request->jumlah,
            'lama_sewa' => $request->lama_sewa,
            'total_harga' => $totalHarga,
            'status' => $request->status
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'ukuran' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'lama_sewa' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($validated['produk_id']);
        $hargaSewa = $produk->harga;
        $totalHarga = $hargaSewa * $validated['jumlah'] * $validated['lama_sewa'];

        $validated['user_id'] = Auth::id();
        $validated['harga_sewa'] = $hargaSewa;
        $validated['total_harga'] = $totalHarga;
        $validated['status'] = 'menunggu';

        $pemesanan = Pemesanan::create($validated);

        return redirect()->route('pembayaran.show', $pemesanan->id)
                        ->with('success', 'Pemesanan berhasil dibuat. Silakan lanjut ke pembayaran.');
    }


    public function show($id)
    {
        $pemesanan = Pemesanan::with(['produk', 'lokasi'])->findOrFail($id);
        return view('pemesanan.show', compact('pemesanan'));
    }

        public function histori()
    {
        $userId = Auth::id();
        $histori = \App\Models\Pemesanan::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('profile.histori', compact('histori'));
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}