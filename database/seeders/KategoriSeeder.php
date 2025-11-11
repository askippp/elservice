<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->truncate();
        DB::table('kategori')->insert([
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Perangkat elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Mekanik',
                'deskripsi' => 'Komponen mekanik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
