<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cabang')->truncate();
        DB::table('cabang')->insert([
            [
                'nama_cabang' => 'Cabang A',
                'alamat' => 'Jalan Mawar No.1',
                'no_telp' => '0811111111',
                'status' => 'aktif',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cabang' => 'Cabang B',
                'alamat' => 'Jalan Melati No.2',
                'no_telp' => '0822222222',
                'status' => 'aktif',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
