<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            UserSeeder::class,
            CabangSeeder::class,
            KategoriSeeder::class,
            MerekSeeder::class,
            AlatSeeder::class,
            SparepartSeeder::class,
            AdminSeeder::class,
            OperatorSeeder::class,
            TeknisiSeeder::class,
            CustomerSeeder::class,
            ServiceSeeder::class,
            DiagnosaServiceSeeder::class,
            PivotAlatCabangSeeder::class,
            PivotSparepartCabangSeeder::class,
            PengeluaranSeeder::class,
            PemasukanSeeder::class,
            PivotSparepartServiceSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
