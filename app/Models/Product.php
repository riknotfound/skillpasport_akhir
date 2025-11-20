<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_toko');
    }

    public function toko()
    {
        return $this->belongsTo(Store::class, 'id_toko', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_produk');
    }

    public function gambarProduk()
    {
        return $this->hasMany(ProductImage::class, 'id_produk');
    }
}
