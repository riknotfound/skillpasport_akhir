<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    // Relasi: satu gambar milik satu produk
    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
