<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('lokasi.index')->with('lokasi', $lokasi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'alamat'        => 'required|string|max:100',
            'status'        => 'required|in:tersedia,tersewa',
            'produk_nama'   => 'required|string|max:50',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $val['foto'] = $request->file('foto')->store('lokasi', 'public');
        }

        lokasi::create($val);
        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit')->with('lokasi', $lokasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $val = $request->validate([
            'alamat'        => 'required|string|max:100',
            'status'        => 'required|in:tersedia,tersewa',
            'produk_nama'   => 'required|string|max:50',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->hasFile('foto')) {
            $val['foto'] = $request->file('foto')->store('lokasi', 'public');
        }


        $lokasi->update($val);
        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        //
    }
}
