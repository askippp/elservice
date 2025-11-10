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
            $table->enum('jenis_service', ['drop_off', 'on_site']);
            $table->text('alamat_service')->nullable();
            $table->text('keluhan');
            $table->text('diagnosa')->nullable();
            $table->decimal('biaya_service', 12, 2)->nullable();
            $table->decimal('biaya_kunjungan', 12, 2)->nullable();
            $table->decimal('total_biaya', 12, 2)->nullable();
            $table->enum('status', ['menunggu','dalam_proses','selesai','batal'])->default('menunggu');
            $table->dateTime('tanggal_masuk');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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

