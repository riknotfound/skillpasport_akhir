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
    // Produk public

    public function produk()
    {
        $products = Product::with(['kategori', 'toko', 'gambarProduk'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('produk', [
            'products' => $products
        ]);
    }

    public function detail($id)
    {
        $produk = Product::with(['kategori', 'toko', 'gambarProduk'])
            ->findOrFail($id);

        return view('detail_produk', [
            'produk' => $produk
        ]);
    }

    // Produk Member

    public function index()
    {
        $toko = Store::where('id_user', Auth::id())->first();

        $products = Product::with(['kategori', 'gambarProduk'])
            ->where('id_toko', $toko->id)
            ->get();

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
        $toko = Store::where('id_user', Auth::id())->first();

        $product = Product::where('id', $id)
            ->where('id_toko', $toko->id)
            ->firstOrFail();

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
        $toko = Store::where('id_user', Auth::id())->first();

        $product = Product::where('id', $id)
            ->where('id_toko', $toko->id)
            ->firstOrFail();

        $request->validate([
            'nama_produk'     => 'required|max:100',
            'harga'           => 'required|numeric',
            'stok'            => 'required|integer',
            'deskripsi'       => 'required',
            'tanggal_upload'  => 'required|date',
            'id_kategori'     => 'required',
            'gambar_produk.*' => 'nullable|image|max:5120'
        ]);

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
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
