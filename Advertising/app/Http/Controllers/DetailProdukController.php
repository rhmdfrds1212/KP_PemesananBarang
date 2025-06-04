<?php

namespace App\Http\Controllers;

use App\Models\detailProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

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
    public function show($produk_id)
    {
        $produk = Produk::with('detail')->findOrFail($produk_id);
        return view('detailProduk.show', compact('produk'));
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
