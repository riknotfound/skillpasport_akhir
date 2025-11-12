<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'kontak',
        'username',
        'password',
        'role',
    ];

    // Relasi: 1 user punya banyak toko
    public function tokos()
    {
        return $this->hasMany(Toko::class, 'id_user');
    }
}
