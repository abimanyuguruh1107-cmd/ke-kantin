<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();

            // relasi ke penjual
            $table->foreignId('id_penjual')
                  ->constrained('penjual')
                  ->onDelete('cascade');

            // relasi ke kategori produk (MASTER)
            $table->foreignId('kategori_id')
                  ->constrained('kategori_produk')
                  ->onDelete('cascade');

            $table->integer('harga');
            $table->integer('stok');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
