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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk'); // primary key
            $table->unsignedBigInteger('id_kategori'); // foreign key ke kategori
            $table->string('nama_produk', 100);
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi');
            $table->date('tanggal_upload');
            $table->unsignedBigInteger('id_toko'); // foreign key ke toko
            $table->timestamps();

            // relasi foreign key
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->foreign('id_toko')->references('id_toko')->on('toko')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
