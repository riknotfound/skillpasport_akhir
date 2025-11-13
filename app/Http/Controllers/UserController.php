<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.pengguna.index', compact('users'));
    }

    // Form tambah pengguna
    public function create()
    {
        return view('admin.pengguna.create');
    }

    // Simpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'kontak'   => 'nullable|string|max:100',
            'username' => 'required|string|max:100|unique:user,username',
            'password' => 'required|min:6',
            'role'     => 'required|string'
        ]);

        User::create([
            'nama'     => $request->nama,
            'kontak'   => $request->kontak,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

    // Update data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|max:100',
            'kontak'   => 'nullable|string|max:100',
            'username' => 'required|string|max:100|unique:user,username,' . $user->id . ',id',
            'password' => 'nullable|min:6',
            'role'     => 'required|string'
        ]);

        $data = [
            'nama'     => $request->nama,
            'kontak'   => $request->kontak,
            'username' => $request->username,
            'role'     => $request->role
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // Hapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
