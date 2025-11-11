<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerekSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('merek')->truncate();
        DB::table('merek')->insert([
            [
                'nama_merek' => 'MerekX',
                'negara_asal' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_merek' => 'MerekY',
                'negara_asal' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
