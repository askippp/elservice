<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotSparepartServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('service_sparepart')->truncate();
        $sparepart = DB::table('sparepart')->first();
        $service = DB::table('service')->first();
        if (!$sparepart || !$service) return;

        DB::table('service_sparepart')->insert([
            'id_service' => $service->id,
            'id_sparepart' => $sparepart->id,
            'jumlah' => 1,
            'harga_satuan' => $sparepart->harga_jual,
            'subtotal' => $sparepart->harga_jual * 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
