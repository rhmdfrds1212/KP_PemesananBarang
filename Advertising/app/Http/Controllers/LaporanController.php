<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Laporan::query()->with('pembayaran.pemesanan');

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $tanggal = explode(' - ', $request->tanggal);
            try {
                $start = \Carbon\Carbon::createFromFormat('d F Y', trim($tanggal[0]))->startOfDay();
                $end = \Carbon\Carbon::createFromFormat('d F Y', trim($tanggal[1]))->endOfDay();

                $query->whereHas('pembayaran.pemesanan', function ($q) use ($start, $end) {
                    $q->whereBetween('created_at', [$start, $end]);
                });
            } catch (\Exception $e) {
                // Handle error format tanggal jika salah
            }
        }

        // Filter metode pembayaran
        if ($request->filled('metode')) {
            $query->whereHas('pembayaran', function ($q) use ($request) {
                $q->where('metode', $request->metode);
            });
        }

        // Filter tipe transaksi
        if ($request->filled('tipe')) {
            $query->whereHas('pembayaran', function ($q) use ($request) {
                $q->where('tipe_pembayaran', $request->tipe);
            });
        }

        // Filter ID struk
        if ($request->filled('id_struk')) {
            $query->where('id', 'like', '%' . $request->id_struk . '%');
        }

        $laporan = $query->latest()->get();

        return view('laporan.index', compact('laporan'));
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
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
