<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teknisi', function (Blueprint $table) {
            $table->string('email', 150)->unique()->after('id_cabang');
        });
    }

    public function down(): void
    {
        Schema::table('teknisi', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn('email');
        });
    }
};
