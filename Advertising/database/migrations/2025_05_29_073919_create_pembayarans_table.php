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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('produk_id')->constrained('produks')->onDelete('cascade');
            $table->foreignUuid('lokasi_id')->constrained('lokasis')->onDelete('cascade');
            $table->integer('jumlah_stok');
            $table->integer('total_harga');
            $table->string('metode_pembayaran');
            $table->string('ukuran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
