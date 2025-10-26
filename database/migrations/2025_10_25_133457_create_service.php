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
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('customer')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_operator')->constrained('operator')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_teknisi')->constrained('teknisi')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_alat')->constrained('alat')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_cabang')->constrained('cabang')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('tgl_service');
            $table->string('keluhan');
            $table->enum('status', ['selesai', 'belum selesai', 'menunggu', 'ditolak'])->default('menunggu');
            $table->timestamp('tgl_selesai')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('total_harga')->nullable();
            $table->enum('status_bayar', ['lunas', 'belum lunas'])->default('belum lunas');
            $table->string('tipe_pembayaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
