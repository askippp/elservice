<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sparepart;
use App\Models\Service;
use App\Models\SparepartService;

class PivotSparepartServiceSeeder extends Seeder
{
    public function run(): void
    {
        SparepartService::truncate();
        $sparepart = Sparepart::first();
        $service = Service::first();
        if (!$sparepart || !$service) return;

        SparepartService::create([
            'id_sparepart' => $sparepart->id,
            'id_service' => $service->id,
            'jumlah' => 1,
            'subtotal' => $sparepart->harga_jual,
        ]);
    }
}
