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
    // ==========================
    // 1. PRODUK PUBLIC (GUEST)
    // ==========================
    public function produk()
    {
        // Ambil semua produk + relasi
        $products = Product::with(['kategori', 'toko', 'gambarProduk'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('produk', [
            'products' => $products
        ]);
    }

    // Detail produk public
    public function detail($id)
    {
        $produk = Product::with(['kategori', 'toko', 'gambarProduk'])
            ->findOrFail($id);

        return view('detail_produk', [
            'produk' => $produk
        ]);
    }

    // ==========================
    // 2. PRODUK MEMBER (CRUD)
    // ==========================

    public function index()
    {
        $products = Product::with(['kategori', 'gambarProduk'])->get();
        return view('admin.produk.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('admin.produk.create', compact('categories', 'stores'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_produk'     => 'required|max:100',
            'harga'           => 'required|numeric',
            'stok'            => 'required|integer',
            'deskripsi'       => 'required',
            'id_kategori'     => 'required',
            'gambar_produk.*' => 'nullable|image|max:5120'
        ]);

        $toko = Store::where('id_user', Auth::id())->first();

        $validasi['id_toko'] = $toko ? $toko->id : null;
        $validasi['tanggal_upload'] = now()->format('Y-m-d');

        $data = $validasi;
        unset($data['gambar_produk']);
        $product = Product::create($data);

        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                if (!$file->isValid()) continue;

                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('image-product'), $filename);

                ProductImage::create([
                    'id_produk'   => $product->id,
                    'nama_gambar' => $filename
                ]);
            }
        }

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $stores = Store::all();

        return view('admin.produk.edit', [
            'produk' => $product,
            'categories' => $categories,
            'stores' => $stores
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk'     => 'required|max:100',
            'harga'           => 'required|numeric',
            'stok'            => 'required|integer',
            'deskripsi'       => 'required',
            'tanggal_upload'  => 'required|date',
            'id_kategori'     => 'required',
            'gambar_produk.*' => 'nullable|image|max:5120'
        ]);

        $product = Product::findOrFail($id);

        $product->update($request->except('gambar_produk'));

        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                if (!$file->isValid()) continue;

                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/image-product', $filename);

                ProductImage::create([
                    'id_produk'   => $product->id,
                    'nama_gambar' => $filename
                ]);
            }
        }

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
