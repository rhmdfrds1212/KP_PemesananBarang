<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'u')->get();
        return view('pelanggan.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pelanggan.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $id,
            'role'    => 'required|string',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'role'    => $request->role,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}