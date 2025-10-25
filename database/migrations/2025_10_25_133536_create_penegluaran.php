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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service')->constrained('service')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('id_operator')->constrained('operator')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('id_cabang')->constrained('cabang')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('id_sparepart')->constrained('sparepart')->nullable()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('tgl');
            $table->string('jenis');
            $table->string('keterangan');
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penegluaran');
    }
};
