<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alat;
use App\Models\Cabang;
use App\Models\AlatCabang;

class PivotAlatCabangSeeder extends Seeder
{
    public function run(): void
    {
        AlatCabang::truncate();
        $alat = Alat::first();
        $cabang = Cabang::first();
        if (!$alat || !$cabang) return;

        AlatCabang::create([
            'id_alat' => $alat->id,
            'id_cabang' => $cabang->id,
        ]);
    }
}
