<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    /**
     * Display a listing of the stores.
     */
    public function index()
    {
        // ambil semua toko beserta relasi user
        $stores = Store::with('user')->get();

        return view('admin.toko.index', compact('stores'));
    }

    /**
     * Show the form for creating a new store.
     */
    public function create()
    {
        // bila butuh pilihan pemilik di form, ambil semua user
        $users = User::all();

        return view('admin.toko.create', compact('users'));
    }

    /**
     * Store a newly created store in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko'   => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|max:2048',
            'kontak_toko' => 'required|string|max:13',
            'alamat'      => 'required|string',
        ]);

        $data = $request->only(['nama_toko', 'deskripsi', 'kontak_toko', 'alamat']);

        // handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('stores', 'public'); // akan tersimpan di storage/app/public/stores
            $data['gambar'] = $path;
        }

        Store::create($data,[
            'user'
        ]);

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified store.
     */
    public function edit(Store $toko)
    {
        // model binding: pastikan route param sesuai (misal admin/toko/{toko}/edit)
        $users = User::all();

        return view('admin.toko.edit', [
            'store' => $toko,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified store in storage.
     */
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

        // replace gambar bila upload baru
        if ($request->hasFile('gambar')) {
            // hapus file lama jika ada
            if ($toko->gambar && Storage::disk('public')->exists($toko->gambar)) {
                Storage::disk('public')->delete($toko->gambar);
            }

            $path = $request->file('gambar')->store('stores', 'public');
            $data['gambar'] = $path;
        }

        $toko->update($data);

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil diubah.');
    }

    /**
     * Remove the specified store from storage.
     */
    public function destroy(Store $toko)
    {
        // hapus gambar dari storage jika ada
        if ($toko->gambar && Storage::disk('public')->exists($toko->gambar)) {
            Storage::disk('public')->delete($toko->gambar);
        }

        $toko->delete();

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil dihapus.');
    }
}
