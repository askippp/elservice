<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->truncate();
        $user = DB::table('users')->where('email', 'admin@example.com')->first();
        if (!$user) return;

        DB::table('admin')->insert([
            'id_user' => $user->id,
            'nama' => 'Admin Utama',
            'no_telp' => '0811111111',
            'alamat' => 'Jalan Admin No.1',
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
