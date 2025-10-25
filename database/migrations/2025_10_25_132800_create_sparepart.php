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
        Schema::create('sparepart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_merek')->constrained('merek')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->string('nama_sparepart');
            $table->string('satuan');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stok');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sparepart');
    }
};
