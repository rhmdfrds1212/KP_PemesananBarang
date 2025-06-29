<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        // Menampilkan semua pembayaran untuk admin
        $pembayarans = Pembayaran::with('pemesanan')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:transfer_bank,bca,qris',
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan' => 'nullable|string',
        ]);

        $pemesanan = Pemesanan::with('produk')->findOrFail($id);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Buat pembayaran
        $pembayaran = Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'metode' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'menunggu pembayaran',
            'status_verifikasi' => 'pending',
            'catatan' => $request->catatan,
        ]);

        // Buat laporan otomatis
        Laporan::create([
            'pembayaran_id' => $pembayaran->id,
        ]);

        return redirect()->route('profile.pemesanan')
                         ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['produk', 'lokasi'])->findOrFail($id);
        return view('pembayaran.show', compact('pemesanan'));
    }

    public function updateStatus($id, $status)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if (!in_array($status, ['pending', 'diterima', 'ditolak'])) {
            return back()->with('error', 'Status tidak valid.');
        }

        $pembayaran->update([
            'status_verifikasi' => $status,
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return back()->with('success', 'Data pembayaran berhasil dihapus.');
    }
}