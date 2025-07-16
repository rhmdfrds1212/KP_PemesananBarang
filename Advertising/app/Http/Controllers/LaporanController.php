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

        // --- PARSING TANGGAL ---
        $start = null;
        $end = null;

        if ($request->filled('tanggal')) {
            $tanggalInput = trim($request->tanggal);

            try {
                if (str_contains($tanggalInput, ' - ')) {
                    [$tglAwal, $tglAkhir] = explode(' - ', $tanggalInput);
                    $start = Carbon::createFromFormat('d-m-Y', trim($tglAwal))->startOfDay();
                    $end = Carbon::createFromFormat('d-m-Y', trim($tglAkhir))->endOfDay();
                } else {
                    $start = Carbon::createFromFormat('d-m-Y', $tanggalInput)->startOfDay();
                    $end = Carbon::createFromFormat('d-m-Y', $tanggalInput)->endOfDay();
                }

                $query->whereBetween('created_at', [$start, $end]);

            } catch (\Exception $e) {
                // Format salah, abaikan filter
            }
        }

        // --- FILTER METODE PEMBAYARAN ---
        if ($request->filled('metode')) {
            $query->whereHas('pembayaran', function ($q) use ($request) {
                $q->where('metode', strtoupper($request->metode));
            });
        }

        // --- AMBIL DATA DULU ---
        $laporan = $query->latest()->get();

        // --- FILTER ID STRUK (SESUDAH DATA DIAMBIL) ---
        if ($request->filled('id_struk')) {
            $laporan = $laporan->filter(function ($item) use ($request) {
                return str_contains((string) $item->id, $request->id_struk);
            });
        }

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