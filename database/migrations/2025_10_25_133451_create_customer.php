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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer');
            $table->string('email');
            $table->integer('no_telp');
            $table->string('alamat');
            $table->integer('id_operator')->constrained('operator')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('id_cabang')->constrained('cabang')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
