<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiagnosaService;
use App\Models\Service;
use App\Models\Teknisi;
use Carbon\Carbon;

class DiagnosaServiceSeeder extends Seeder
{
    public function run(): void
    {
        DiagnosaService::truncate();
        $service = Service::first();
        $teknisi = Teknisi::first();
        if (!$service || !$teknisi) return;

        DiagnosaService::create([
            'id_service' => $service->id,
            'diagnosa' => 'Fuse putus',
            'estimasi_waktu' => Carbon::now()->addDays(2),
            'estimasi_biaya' => 50000,
            'id_teknisi' => $teknisi->id,
            'tgl_diagnosa' => Carbon::now()->subDays(2),
        ]);
    }
}
