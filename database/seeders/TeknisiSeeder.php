<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('teknisi')->truncate();
        $user = DB::table('users')->where('email', 'teknisi@example.com')->first();
        $cabang = DB::table('cabang')->first();
        if (!$user || !$cabang) return;

        DB::table('teknisi')->insert([
            'id_user' => $user->id,
            'id_cabang' => $cabang->id,
            'nama' => 'Teknisi Andalan',
            'spesialisasi' => 'Elektronik',
            'no_telp' => '0813333333',
            'alamat' => 'Jalan Teknisi No.1',
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
