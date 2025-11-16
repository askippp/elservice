<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperatorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('operator')->truncate();
        $user = DB::table('users')->where('email', 'operator@example.com')->first();
        $cabang = DB::table('cabang')->first();
        if (!$user || !$cabang) return;

        DB::table('operator')->insert([
            'id_user' => $user->id,
            'id_cabang' => $cabang->id,
            'email' => 'operator@example.com',
            'nama' => 'Operator Satu',
            'no_telp' => '0812222222',
            'alamat' => 'Jalan Operator No.1',
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
