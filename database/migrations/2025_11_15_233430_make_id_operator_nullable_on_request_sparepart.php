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
        Schema::table('request_sparepart', function (Blueprint $table) {
            $table->dropForeign(['id_operator']);
            $table->unsignedBigInteger('id_operator')->nullable()->change();
            $table->foreign('id_operator')
                ->references('id')
                ->on('operator')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_sparepart', function (Blueprint $table) {
            $table->dropForeign(['id_operator']);
            $table->unsignedBigInteger('id_operator')->nullable(false)->change();
            $table->foreign('id_operator')
                ->references('id')
                ->on('operator')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }
};
