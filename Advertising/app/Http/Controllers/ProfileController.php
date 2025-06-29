<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

class ProfileController extends Controller
{
    /**
     * Dashboard Profil User.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil histori pemesanan user
        $histori = Pemesanan::where('user_id', $user->id)->latest()->get();

        // Ringkasan Akun
        $total_pemesanan = $histori->count();
        $total_transaksi = $histori->sum('total_harga');

        return view('profile.index', compact(
            'user',
            'histori',
            'total_pemesanan',
            'total_transaksi'
        ));
    }

    /**
     * Form edit profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Halaman histori transaksi (pemesanan).
     */
    public function histori()
    {
        $user = Auth::user();
        $histori = Pemesanan::where('user_id', $user->id)->latest()->get();

        return view('profile.histori', compact('histori'));
    }

    /**
     * Halaman invoice.
     */
    public function invoice()
    {
        $user = Auth::user();

        if ($user->role === 'a') {
            // Jika admin, tampilkan semua invoice
            $invoices = Pembayaran::with('pemesanan.produk', 'pemesanan.lokasi', 'pemesanan.user')
                ->latest()
                ->get();
        } else {
            // Jika user, hanya tampilkan invoice miliknya
            $invoices = Pembayaran::whereHas('pemesanan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('pemesanan.produk', 'pemesanan.lokasi')->latest()->get();
        }

        return view('profile.invoice', compact('invoices'));
    }
    /**
     * Update profil user.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill(
            $request->except('email')
        );
        $request->user()->save();

        return Redirect::route('profile.index')->with('status', 'Nama pengguna berhasil diperbarui');
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}