<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi
    public function produks()
    {
        return $this->hasMany(Product::class, 'id_toko');
    }
}
