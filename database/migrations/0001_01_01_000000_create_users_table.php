<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // User
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('kontak', 13);
            $table->string('username', 20)->unique();
            $table->string('password', 100);
            $table->enum('role', ['admin', 'member']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_produk');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('toko');
        Schema::dropIfExists('user');
    }
};
