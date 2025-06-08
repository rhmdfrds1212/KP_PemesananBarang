<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:transfer_bank,qris,cod',
            'catatan' => 'nullable|string',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        $pembayaran = Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'metode' => $request->metode_pembayaran,
            'status' => 'menunggu pembayaran',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('pemesanan.index')
                 ->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with('produk', 'lokasi')->findOrFail($id);
        return view('pembayaran.show', compact('pemesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
