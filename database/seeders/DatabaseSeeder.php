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

        // Admin
        User::create([
            'username' => 'admin123',
            'nama' => 'Administrator',
            'kontak' => '0837465738473',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Member
        User::create([
            'username' => 'member123',
            'nama' => 'Member Biasa',
            'kontak' => '0837465738474',
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);
    }
}
