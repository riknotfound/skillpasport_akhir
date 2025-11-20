<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
USE App\Models\Toko;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    public function index()
    {
        $stores = Store::with('user')->get();
        return view('admin.toko.index', compact('stores'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.toko.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko'   => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|max:2048',
            'id_user'     => 'required|exists:user,id',
            'kontak_toko' => 'required|string|max:13',
            'alamat'      => 'required|string',
        ]);

        $data = $request->only([
            'nama_toko',
            'deskripsi',
            'id_user',
            'kontak_toko',
            'alamat',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('stores', 'public');
            $data['gambar'] = $path;
        }

        Store::create($data);

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil dibuat.');
    }

    public function edit(Store $toko)
    {
        $users = User::all();

        return view('admin.toko.edit', [
            'toko' => $toko,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Store $toko)
    {
        $request->validate([
            'nama_toko'   => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|max:2048',
            'id_user'     => 'required|exists:user,id',
            'kontak_toko' => 'required|string|max:13',
            'alamat'      => 'required|string',
        ]);

        $data = $request->only(['nama_toko', 'deskripsi', 'id_user', 'kontak_toko', 'alamat']);

        if ($request->hasFile('gambar')) {
            if ($toko->gambar && Storage::disk('public')->exists($toko->gambar)) {
                Storage::disk('public')->delete($toko->gambar);
            }

            $path = $request->file('gambar')->store('stores', 'public');
            $data['gambar'] = $path;
        }

        $toko->update($data);

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil diubah.');
    }

    public function destroy(Store $toko)
    {
        if ($toko->gambar && Storage::disk('public')->exists($toko->gambar)) {
            Storage::disk('public')->delete($toko->gambar);
        }

        $toko->delete();

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil dihapus.');
    }

    // Toko public
    public function toko()
    {
        $stores = Store::with('user')->get();
        return view('toko', compact('stores'));
    }

    public function detail_toko($id)
    {
        $store = Store::with('user')->findOrFail($id);
        return view('detail_toko', compact('store'));
    }
}
