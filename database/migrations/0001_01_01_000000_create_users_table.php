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
        // =======================
        // TABLE: user
        // =======================
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama', 100);
            $table->string('kontak', 13);
            $table->string('username', 20)->unique();
            $table->string('password', 100);
            $table->enum('role', ['admin', 'member']);
            $table->timestamps();
        });

        // =======================
        // TABLE: toko
        // =======================
        Schema::create('toko', function (Blueprint $table) {
            $table->id('id_toko');
            $table->string('nama_toko', 100);
            $table->text('deskripsi');
            $table->string('gambar', 100)->nullable();
            $table->unsignedBigInteger('id_user');
            $table->string('kontak_toko', 13);
            $table->text('alamat');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });

        // =======================
        // TABLE: kategori
        // =======================
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori', 50);
            $table->timestamps();
        });

        // =======================
        // TABLE: produk
        // =======================
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk', 100);
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi');
            $table->date('tanggal_upload');
            $table->unsignedBigInteger('id_toko');
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->foreign('id_toko')->references('id_toko')->on('toko')->onDelete('cascade');
        });

        // =======================
        // TABLE: gambar_produk
        // =======================
        Schema::create('gambar_produk', function (Blueprint $table) {
            $table->id('id_gambar');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_gambar', 50);
            $table->timestamps();

            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
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
