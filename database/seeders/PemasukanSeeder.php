<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemasukanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pemasukan')->truncate();
        $service = DB::table('service')->first();
        $cabang = DB::table('cabang')->first();
        if (!$service || !$cabang) return;

        DB::table('pemasukan')->insert([
            [
                'id_service' => $service->id,
                'id_cabang' => $cabang->id,
                'jumlah' => 150000.00,
                'keterangan' => 'Pelunasan service',
                'tanggal' => now()->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
