<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_siswa')
                  ->constrained('siswa')
                  ->onDelete('restrict');

            $table->foreignId('id_penjual')
                  ->constrained('penjual')
                  ->onDelete('restrict');

            $table->enum('status', ['pending', 'dibayar', 'dibatalkan', 'selesai'])
                  ->default('pending');

            $table->integer('total_harga');
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
