<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvoiceStatusNotification;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('pemesanan')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:transfer_bank,bca,qris',
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan' => 'nullable|string',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
        ]);

        $pemesanan = Pemesanan::with('produk')->findOrFail($id);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $pembayaran = Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'metode' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            '   _pembayaran' => 'menunggu pembayaran',
            'status_verifikasi' => 'pending',
            'catatan' => $request->catatan,
        ]);

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
        $pembayaran = Pembayaran::with('pemesanan.user')->findOrFail($id);

        if (!in_array($status, ['pending', 'diterima', 'ditolak'])) {
            return back()->with('error', 'Status tidak valid.');
        }

        $pembayaran->update(['status_verifikasi' => $status]);

        $user = $pembayaran->pemesanan->user ?? null;
        if ($user) {
            $user->notify(new InvoiceStatusNotification($status, $pembayaran->id));
        }

        $message = $status === 'diterima' 
            ? 'Invoice berhasil diterima.' 
            : ($status === 'ditolak' ? 'Invoice ditolak.' : 'Status diperbarui.');

        return back()->with('success', $message);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return back()->with('success', 'Data pembayaran berhasil dihapus.');
    }
}