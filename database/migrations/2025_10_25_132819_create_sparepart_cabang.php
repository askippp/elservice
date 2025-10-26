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
        Schema::create('sparepart_cabang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sparepart')->constrained('sparepart')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_cabang')->constrained('cabang')
                ->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sparepart_cabang');
    }
};
