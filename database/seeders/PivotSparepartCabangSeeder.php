<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sparepart;
use App\Models\Cabang;
use App\Models\SparepartCabang;

class PivotSparepartCabangSeeder extends Seeder
{
    public function run(): void
    {
        SparepartCabang::truncate();
        $sparepart = Sparepart::first();
        $cabang = Cabang::first();
        if (!$sparepart || !$cabang) return;

        SparepartCabang::create([
            'id_sparepart' => $sparepart->id,
            'id_cabang' => $cabang->id,
        ]);
    }
}
