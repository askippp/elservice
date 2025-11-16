<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->string('provinsi', 100)->nullable()->after('alamat');
            $table->string('kota', 100)->nullable()->after('provinsi');
            $table->index(['provinsi', 'kota'], 'customer_provinsi_kota_index');
        });
    }

    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropIndex('customer_provinsi_kota_index');
            $table->dropColumn(['provinsi', 'kota']);
        });
    }
};
