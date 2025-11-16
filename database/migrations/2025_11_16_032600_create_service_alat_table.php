<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_alat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_service')->constrained('service')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_alat')->constrained('alat')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();

            $table->unique(['id_service', 'id_alat']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_alat');
    }
};
