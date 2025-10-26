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
        Schema::create('diagnosa_service', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service')->constrained('service')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->string('diagnosa');
            $table->date('estimasi_waktu');
            $table->integer('estimasi_biaya');
            $table->foreignId('id_teknisi')->constrained('teknisi')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('tgl_diagnosa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosa_service');
    }
};
