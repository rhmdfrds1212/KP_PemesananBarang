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
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,dibatalkan'
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = $request->status;
        $pemesanan->save();

        return redirect()->route('riwayat.index')
                         ->with('success', 'Status pemesanan berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('riwayat.index')->with('success', 'Pemesanan berhasil dihapus.');
    }    
}