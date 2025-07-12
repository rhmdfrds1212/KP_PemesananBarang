<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Pemesanan::with(['produk', 'lokasi']);

        if ($user->role === 'a') {
            // Admin lihat semua yang belum selesai
            $query->whereIn('status', ['menunggu', 'diproses']);
        } else {
            // User lihat hanya pesanan sendiri yang belum selesai
            $query->where('user_id', Auth::id())
                ->where('status', '!=', 'selesai');
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('telepon', 'like', '%' . $request->search . '%')
                ->orWhereHas('lokasi', function($q) use ($request) {
                    $q->where('alamat', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('produk', function($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%');
                });
            });
        }

        $pemesanans = $query->latest()->get();

        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create(Request $request, $id = null)
    {
        if ($id) {
            $produkTerpilih = Produk::findOrFail($id);
            $lokasis = Lokasi::where('produk_nama', $produkTerpilih->nama)
                            ->where('status', 'tersedia')->get();

            $lastOrder = Pemesanan::where('user_id', Auth::id())->latest()->first();

            return view('pemesanan.create', [
                'produkTerpilih' => $produkTerpilih,
                'lokasis' => $lokasis,
                'produks' => Produk::all(),
                'lastOrder' => $lastOrder
            ]);
        } 
        // Jika tidak ada ID produk
        else {
            $produks = Produk::all();
            $lokasis = Lokasi::where('status', 'tersedia')->get();
            $lastOrder = Pemesanan::where('user_id', Auth::id())->latest()->first();

            return view('pemesanan.create', [
                'produkTerpilih' => null,
                'lokasis' => $lokasis,
                'produks' => $produks,
                'lastOrder' => $lastOrder
            ]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'jumlah' => 'required|integer|min:1',
            'lama_sewa' => 'required|integer|min:1',
        ]);

        $lokasi = Lokasi::findOrFail($validated['lokasi_id']);
        $produk = Produk::findOrFail($validated['produk_id']);

        if ($produk->stok < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'error', 'Stok tidak mencukupi untuk pemesanan ini.'. $produk->stok])->withInput();
        }

        $hargaSewa = $lokasi->harga;
        $totalHarga = $hargaSewa * $validated['jumlah'] * $validated['lama_sewa'];

        $produk->stok -= $validated['jumlah'];
        $produk->save();

        $pemesanan = Pemesanan::create([
            'produk_id'   => $validated['produk_id'],
            'lokasi_id'   => $validated['lokasi_id'],
            'user_id'     => Auth::id(),
            'nama'        => $validated['nama'],
            'email'       => $validated['email'],
            'telepon'     => $validated['telepon'],
            'ukuran'      => $lokasi->ukuran,
            'jumlah'      => $validated['jumlah'],
            'lama_sewa'   => $validated['lama_sewa'],
            'harga_sewa'  => $hargaSewa,
            'total_harga' => $totalHarga,
            'status'      => 'menunggu',
        ]);

        return redirect()->route('pembayaran.show', $pemesanan->id)
                        ->with('success', 'Pemesanan berhasil dibuat. Silakan lanjut ke pembayaran.');
    }


    public function edit($id)
    {
        $pemesanan = Pemesanan::with('produk')->findOrFail($id);
        $produkTerpilih = $pemesanan->produk;
        $lokasis = Lokasi::where('produk_nama', $produkTerpilih->nama)->get();

        return view('pemesanan.edit', [
            'pemesanan' => $pemesanan,
            'produkTerpilih' => $produkTerpilih,
            'lokasis' => $lokasis
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'lokasi_id' => 'required|exists:lokasis,id',
            'jumlah' => 'required|integer|min:1',
            'lama_sewa' => 'required|integer|min:1',
        ];

        if (Auth::user()->role === 'a') {
            $rules['status'] = 'required|in:menunggu,diproses,selesai';
        }

        $validated = $request->validate($rules);

        $pemesanan = Pemesanan::findOrFail($id);
        $lokasi = Lokasi::findOrFail($validated['lokasi_id']);

        $totalHarga = $lokasi->harga * $validated['jumlah'] * $validated['lama_sewa'];

        $updateData = [
            'lokasi_id' => $validated['lokasi_id'],
            'ukuran' => $lokasi->ukuran,
            'jumlah' => $validated['jumlah'],
            'lama_sewa' => $validated['lama_sewa'],
            'total_harga' => $totalHarga,
        ];

        if (Auth::user()->role === 'a') {
            $updateData['status'] = $validated['status'];
        }

        $pemesanan->update($updateData);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }


    public function show($id)
    {
        $pemesanan = Pemesanan::with(['produk', 'lokasi'])->findOrFail($id);
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function histori()
    {
        $histori = Pemesanan::with(['produk', 'lokasi'])
                    ->where('user_id', Auth::id())
                    ->where('status', 'selesai')
                    ->latest()
                    ->get();

        return view('profile.histori', compact('histori'));
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->produk) {
            $pemesanan->produk->stok += $pemesanan->jumlah;
            $pemesanan->produk->save();
        }
        
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}
