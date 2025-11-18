<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'kontak',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function username()
    {
        return 'username';
    }

    // Relasi: satu toko dimiliki oleh satu user
    public function store()
    {
        return $this->hasOne(Store::class, 'id_user'); // contoh jika kolom id_user di stores
    }

}
