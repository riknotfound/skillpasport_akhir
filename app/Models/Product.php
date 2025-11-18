<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // Relasi ke kategori (bhs inggris)
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }

    // Alias relasi kategori
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    // Relasi ke store (bhs inggris)
    public function store()
    {
        return $this->belongsTo(Store::class, 'id_toko');
    }

    // 🔥 Relasi tambahan agar $product->toko TIDAK ERROR
    public function toko()
    {
        return $this->belongsTo(Store::class, 'id_toko', 'id');
    }

    // Relasi gambar
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_produk');
    }

    // Alias gambarProduk
    public function gambarProduk()
    {
        return $this->hasMany(ProductImage::class, 'id_produk');
    }
}
