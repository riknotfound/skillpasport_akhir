<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        // eager load relasi yang dipakai di view
        $products = Product::with(['kategori', 'gambarProduk'])->get();
        return view('admin.produk.index', ['products' => $products]);
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
       $validasi =  $request->validate([
            'nama_produk'     => 'required|max:100',
            'harga'           => 'required|numeric',
            'stok'            => 'required|integer',
            'deskripsi'       => 'required',
            'id_kategori'     => 'required',
            'gambar_produk.*' => 'nullable|image|max:5120' // 5MB per file
        ]);

        $toko = Store::where('id_user', Auth::id())->first();

        $validasi['id_toko'] = $toko ? $toko->id : null;

        $validasi['tanggal_upload'] = now()->format('Y-m-d');

        // Simpan product tanpa file input
        $data = $validasi;
        unset($data['gambar_produk']);
        $product = Product::create($data);

        // Jika ada file gambar, simpan ke storage/public/product_images dan record ke product_images
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                if (!$file->isValid()) continue;

                // buat nama file unik
                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

                // simpan ke storage (public disk). Akan berada di storage/app/public/product_images/<filename>
                $file->storeAs('public/product_images', $filename);

                // simpan record ke tabel product_images
                ProductImage::create([
                    'id_produk'   => $product->id,
                    'nama_gambar' => $filename
                ]);
            }
        }

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
            'gambar_produk.*' => 'nullable|image|max:5120'
        ]);

        $product = Product::findOrFail($id);

        // update fields kecuali file
        $product->update($request->except('gambar_produk'));

        // handle new uploaded images (jika ada)
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                if (!$file->isValid()) continue;

                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/product_images', $filename);

                ProductImage::create([
                    'id_produk'   => $product->id,
                    'nama_gambar' => $filename
                ]);
            }
        }

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
