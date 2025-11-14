<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // <-- FIX PENTING

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

    // Biar auth() pake 'username' bukan email
    public function username()
    {
        return 'username';
    }
}
