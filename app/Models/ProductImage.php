<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    // Relasi
    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    // Helper
    public function url()
    {
        return asset('storage/product_images/' . $this->nama_gambar);
    }
}
