<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotSparepartCabangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sparepart_cabang')->truncate();
        $sparepart = DB::table('sparepart')->first();
        $cabang = DB::table('cabang')->first();
        if (!$sparepart || !$cabang) return;

        DB::table('sparepart_cabang')->insert([
            'id_sparepart' => $sparepart->id,
            'id_cabang' => $cabang->id,
            'stok' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
