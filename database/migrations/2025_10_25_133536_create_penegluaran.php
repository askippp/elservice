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
            $table->foreignId('id_cabang')->constrained('cabang')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_teknisi')->constrained('teknisi')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_sparepart')->constrained('sparepart')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->decimal('jumlah', 12, 2);
            $table->text('keterangan')->nullable();
            $table->dateTime('tanggal');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};

