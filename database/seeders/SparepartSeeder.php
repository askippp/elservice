<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sparepart;
use App\Models\Kategori;
use App\Models\Merek;

class SparepartSeeder extends Seeder
{
    public function run(): void
    {
        Sparepart::truncate();
        $kategori = Kategori::first();
        $merek = Merek::first();
        if (!$kategori || !$merek) return;

        Sparepart::insert([
            [
                'id_kategori' => $kategori->id,
                'id_merek' => $merek->id,
                'nama_sparepart' => 'Fuse 10A',
                'satuan' => 'pcs',
                'harga_beli' => 5000,
                'harga_jual' => 8000,
                'stok' => 100,
                'foto' => null,
            ],
        ]);
    }
}
