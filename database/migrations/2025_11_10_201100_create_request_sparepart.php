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
        Schema::create('request_sparepart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_teknisi')->constrained('teknisi')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_operator')->constrained('operator')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_sparepart')->constrained('sparepart')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah');
            $table->enum('status', ['pending','disetujui','ditolak'])->default('pending');
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
        Schema::dropIfExists('request_sparepart');
    }
};
