<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'tanggal_upload',
        'id_toko',
    ];

    // Relasi: produk milik satu kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi: produk milik satu toko
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }

    // Relasi: produk punya banyak gambar
    public function gambarProduk()
    {
        return $this->hasMany(GambarProduk::class, 'id_produk');
    }
}
