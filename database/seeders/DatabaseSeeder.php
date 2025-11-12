<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus semua user lama (opsional)
        User::truncate();

        // Admin
        User::create([
            'username' => 'admin123',
            'name' => 'Administrator',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Member
        User::create([
            'username' => 'member123',
            'name' => 'Member Biasa',
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);
    }
}
