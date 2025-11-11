<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::truncate();
        Kategori::insert([
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Mekanik'],
        ]);
    }
}
