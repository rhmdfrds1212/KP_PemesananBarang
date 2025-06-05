<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function add(Request $request)
    {
        $produk = [
            'id' => $request->id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'total_harga' => $request->qty ?? 1
        ];

        $keranjang = session()->get('keranjang', []);

        if(isset($keranjang[$produk['id']])) {
            $keranjang[$produk['id']]['total_harga'] += $produk['total_harga'];
        } else {
            $keranjang[$produk['id']] = $produk;
        }

        session()->put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('keranjang.index', compact('keranjang'));
    }

    public function delete($id)
    {
    $keranjang = session()->get('keranjang', []);

    if (isset($keranjang[$id])) {
        unset($keranjang[$id]);
        session()->put('keranjang', $keranjang);
    }

    return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
