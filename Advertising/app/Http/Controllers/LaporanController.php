<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query()->with('pembayaran.pemesanan');
    
        $start = null;
        $end = null;
    
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            try {
                $start = Carbon::parse($request->tanggal_awal)->startOfDay();
                $end = Carbon::parse($request->tanggal_akhir)->endOfDay();
                $query->whereBetween('created_at', [$start, $end]);
            } catch (\Exception $e) {
                // format salah
            }
        }
    
        if ($request->filled('metode')) {
            $query->whereHas('pembayaran', function ($q) use ($request) {
                $q->where('metode', strtoupper($request->metode));
            });
        }
    
        $laporan = $query->latest()->get();
    
        if ($request->filled('id_struk')) {
            $laporan = $laporan->filter(function ($item) use ($request) {
                return str_contains((string) $item->id, $request->id_struk);
            });
        }
    
        return view('laporan.index', compact('laporan', 'start', 'end'));
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