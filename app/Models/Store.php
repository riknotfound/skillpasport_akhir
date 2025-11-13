<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    // Relasi: satu toko dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi: satu toko punya banyak produk
    public function produks()
    {
        return $this->hasMany(Product::class, 'id_toko');
    }
}
