<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemasukan;
use App\Models\Service;
use App\Models\Cabang;
use Carbon\Carbon;

class PemasukanSeeder extends Seeder
{
    public function run(): void
    {
        Pemasukan::truncate();
        $service = Service::first();
        $cabang = Cabang::first();
        if (!$service || !$cabang) return;

        Pemasukan::insert([
            [
                'id_service' => $service->id,
                'id_cabang' => $cabang->id,
                'tgl' => Carbon::now()->subDay(),
                'sumber' => 'Pelunasan service',
                'jumlah' => 150000,
            ],
        ]);
    }
}
