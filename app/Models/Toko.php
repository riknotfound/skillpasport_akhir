<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    protected $primaryKey = 'id_toko';
    public $timestamps = false;

    protected $fillable = [
        'nama_toko',
        'deskripsi',
        'gambar',
        'id_user',
        'kontak_toko',
        'alamat',
    ];

    // Relasi: satu toko dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi: satu toko punya banyak produk
    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_toko');
    }
}
