<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SparepartSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sparepart')->truncate();
        $kategori = DB::table('kategori')->first();
        if (!$kategori) return;

        DB::table('sparepart')->insert([
            [
                'id_kategori' => $kategori->id,
                'nama_sparepart' => 'Fuse 10A',
                'merek' => 'Generic',
                'stok' => 100,
                'harga_beli' => 5000.00,
                'harga_jual' => 8000.00,
                'deskripsi' => 'Fuse ukuran 10A',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
