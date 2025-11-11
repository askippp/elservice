<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('service')->truncate();
        $customer = DB::table('customer')->first();
        $operator = DB::table('operator')->first();
        $teknisi = DB::table('teknisi')->first();
        $alat = DB::table('alat')->first();
        if (!$customer || !$operator || !$teknisi || !$alat) return;

        DB::table('service')->insert([
            [
                'id_customer' => $customer->id,
                'id_operator' => $operator->id,
                'id_teknisi' => $teknisi->id,
                'id_alat' => $alat->id,
                'jenis_service' => 'drop_off',
                'alamat_service' => null,
                'keluhan' => 'Alat tidak menyala',
                'diagnosa' => null,
                'biaya_service' => null,
                'biaya_kunjungan' => null,
                'total_biaya' => null,
                'status' => 'menunggu',
                'tanggal_masuk' => now()->subDays(3),
                'tanggal_selesai' => null,
                'catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
