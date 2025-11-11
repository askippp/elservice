<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotAlatCabangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('alat_cabang')->truncate();
        $alat = DB::table('alat')->first();
        $cabang = DB::table('cabang')->first();
        if (!$alat || !$cabang) return;

        DB::table('alat_cabang')->insert([
            'id_alat' => $alat->id,
            'id_cabang' => $cabang->id,
            'ketersediaan' => 'bisa_ditangani',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
