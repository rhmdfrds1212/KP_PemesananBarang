<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('produk_id')->constrained('produks')->onDelete('cascade');
            $table->foreignUuid('lokasi_id')->constrained('lokasis')->onDelete('cascade');
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('jumlah');
            $table->integer('lama_sewa');
            $table->integer('harga_sewa');
            $table->integer('total_harga');
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
