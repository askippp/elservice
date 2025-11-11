<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        Cabang::truncate();
        Cabang::insert([
            [
                'nama_cabang' => 'Cabang A',
                'no_telp' => 628111111111,
                'alamat' => 'Jalan Mawar No.1',
                'kota' => 'Bandung',
                'email' => 'cabang.a@example.com',
                'foto' => null,
                'status' => 'aktif',
            ],
            [
                'nama_cabang' => 'Cabang B',
                'no_telp' => 628122222222,
                'alamat' => 'Jalan Melati No.2',
                'kota' => 'Jakarta',
                'email' => 'cabang.b@example.com',
                'foto' => null,
                'status' => 'aktif',
            ],
        ]);
    }
}
