<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merek;

class MerekSeeder extends Seeder
{
    public function run(): void
    {
        Merek::truncate();
        Merek::insert([
            ['nama_merek' => 'MerekX'],
            ['nama_merek' => 'MerekY'],
        ]);
    }
}
