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
        Schema::create('toko', function (Blueprint $table) {
            $table->id('id_toko'); // primary key
            $table->string('nama_toko', 100); // nama toko
            $table->text('deskripsi'); // deskripsi toko
            $table->string('gambar', 100)->nullable(); // gambar toko (boleh kosong)
            $table->unsignedBigInteger('id_user'); // relasi ke tabel user
            $table->string('kontak_toko', 13); // kontak toko
            $table->text('alamat'); // alamat toko
            $table->timestamps(); // created_at & updated_at

            // Foreign key ke tabel user
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
