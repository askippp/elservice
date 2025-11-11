<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestSparepartSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('request_sparepart')->truncate();
        $teknisi = DB::table('teknisi')->first();
        $operator = DB::table('operator')->first();
        $sparepart = DB::table('sparepart')->first();
        if (!$teknisi || !$operator || !$sparepart) return;

        DB::table('request_sparepart')->insert([
            [
                'id_teknisi' => $teknisi->id,
                'id_operator' => $operator->id,
                'id_sparepart' => $sparepart->id,
                'jumlah' => 2,
                'status' => 'disetujui',
                'catatan' => 'Kebutuhan perbaikan awal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
