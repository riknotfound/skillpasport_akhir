<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // Relasi: produk milik satu kategori
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    // Relasi: produk milik satu toko
    public function toko()
    {
        return $this->belongsTo(Store::class, 'id_toko');
    }

    // Relasi: produk punya banyak gambar
    public function gambarProduk()
    {
        return $this->hasMany(ProductImage::class, 'id_produk');
    }
}
