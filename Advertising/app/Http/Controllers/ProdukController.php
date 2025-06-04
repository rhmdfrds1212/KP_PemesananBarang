<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produk = Produk::all();
         $query = Produk::query();

         if ($request->has('cari') && $request->cari != '') {
            $query->where('nama', 'like', '%' . $request->cari . '%')
                ->orWhere('kategori', 'like', '%' . $request->cari . '%');
        }

        $produks = $query->get();

        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|max:2048',
            'kategori' => 'nullable|string|max:255',
        ]);

        $data = $request->only('nama', 'deskripsi', 'harga', 'stok', 'kategori');

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('upload/produk'), $fotoName);
            $data['foto'] = $fotoName;
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function beli($id)
    {
        $produk = Produk::findOrFail($id);

        return redirect()->route('produk.index')->with('success', 'Anda telah membeli produk: ' . $produk->nama);
    }

    public function Pembayaran($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.pembayaran', compact('produk'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit')->with('produk', $produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'harga' => 'required|numeric|min:0',
                'stok' => 'required|integer|min:0',
                'foto' => 'nullable|image|max:2048',
                'kategori' => 'nullable|string|max:255',
            ]);

            $data = $request->only('nama', 'deskripsi', 'harga', 'stok', 'kategori');

            if ($request->hasFile('foto')) {
                if ($produk->foto && file_exists(public_path('upload/produk/' . $produk->foto))) {
                    unlink(public_path('upload/produk/' . $produk->foto));
                }

                $fotoName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('upload/produk'), $fotoName);
                $data['foto'] = $fotoName;
            }

            $produk->update($data);

            return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk-> delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
