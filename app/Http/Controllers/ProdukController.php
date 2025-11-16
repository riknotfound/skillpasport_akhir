<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;

class ProdukController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        $products = Product::with(['category', 'store'])->get();
        return view('admin.produk.index', compact('products'));
    }

    // Tampilan tambah produk
    public function create()
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('admin.produk.create', compact('categories', 'stores'));
    }

    // Simpan data produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'     => 'required|max:100',
            'harga'           => 'required|numeric',
            'stok'            => 'required|integer',
            'deskripsi'       => 'required',
            'tanggal_upload'  => 'required|date',
            'id_kategori'     => 'required',
            'id_toko'         => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Halaman edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $stores = Store::all();

        return view('admin.produk.edit', compact('product', 'categories', 'stores'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk'     => 'required|max:100',
            'harga'           => 'required|numeric',
            'stok'            => 'required|integer',
            'deskripsi'       => 'required',
            'tanggal_upload'  => 'required|date',
            'id_kategori'     => 'required',
            'id_toko'         => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
