<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Merek;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        Alat::truncate();
        $kategori = Kategori::first();
        $merek = Merek::first();
        if (!$kategori || !$merek) return;

        Alat::insert([
            [
                'id_kategori' => $kategori->id,
                'id_merek' => $merek->id,
                'nama_alat' => 'Multimeter',
                'tipe_model' => 'MM-100',
                'deskripsi' => 'Alat ukur listrik',
                'foto' => null,
                'status' => 'aktif',
            ],
        ]);
    }
}
