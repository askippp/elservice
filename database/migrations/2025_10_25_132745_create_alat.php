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
        Schema::create('alat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_merek')->constrained('merek')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->string('nama_alat');
            $table->string('tipe_model');
            $table->string('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
