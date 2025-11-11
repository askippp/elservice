<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customer')->truncate();
        $user = DB::table('users')->where('email', 'customer@example.com')->first();
        if (!$user) return;

        DB::table('customer')->insert([
            'id_user' => $user->id,
            'nama' => 'PT Pelanggan Jaya',
            'no_telp' => '08144444444',
            'alamat' => 'Jalan Kenanga No.3',
            'email' => 'customer@example.com',
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
