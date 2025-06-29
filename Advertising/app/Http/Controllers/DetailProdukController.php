<?php

namespace App\Http\Controllers;

use App\Models\detailProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailProdukController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $detail_foto = \App\Models\DetailProduk::where('produk_id', $id)->get();

        // Cek jika admin tidak boleh akses halaman detail produk
        if (Auth::check() && Auth::user()->role === 'a' || Auth::user()->role === 'p') {
            abort(403, 'tidak diizinkan mengakses halaman ini.');
        }

        return view('detail_produks.show', compact('produk', 'detail_foto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailProduk $detailProduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailProduk $detailProduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailProduk $detailProduk)
    {
        //
    }
}
