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
        $histori = Pemesanan::where('user_id', Auth::id())
                            ->where('status', 'selesai')
                            ->with(['produk', 'lokasi'])
                            ->latest()
                            ->get();

        return view('profile.histori', compact('histori'));
    }

    /**
     * Halaman invoice.
     */
    public function invoice(Request $request)
    {
        $user = Auth::user();
        $query = Pembayaran::query()->with('pemesanan.produk', 'pemesanan.lokasi');

        // Jika user bukan admin, tampilkan hanya invoice miliknya
        if ($user->role != 'a') {
            $query->whereHas('pemesanan', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Filter search
        if ($request->search) {
            $query->whereHas('pemesanan', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhereHas('produk', function($p) use ($request) {
                    $p->where('nama', 'like', '%' . $request->search . '%');
                })
                ->orWhere('id', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->status) {
            $query->where('status_verifikasi', $request->status);
        }

        $invoices = $query->latest()->get();

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