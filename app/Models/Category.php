<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function produks()
    {
        return $this->hasMany(Product::class, 'id_kategori');
    }
}
