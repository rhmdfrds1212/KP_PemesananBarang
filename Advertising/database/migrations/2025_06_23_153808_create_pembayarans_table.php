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
            $table->foreignUuId('pemesanan_id')->constrained()->onDelete('cascade');
            $table->enum('metode', ['bca', 'mandiri']);
            $table->string('bukti_pembayaran');
            $table->string('status_pembayaran')->default('menunggu pembayaran');
            $table->text('catatan')->nullable();
            $table->enum('status_verifikasi', ['pending', 'diterima', 'ditolak'])->default('pending');
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
