<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengeluaran;
use App\Models\Service;
use App\Models\Operator;
use App\Models\Cabang;
use App\Models\Sparepart;
use Carbon\Carbon;

class PengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        Pengeluaran::truncate();
        $service = Service::first();
        $operator = Operator::first();
        $cabang = Cabang::first();
        $sparepart = Sparepart::first();
        if (!$service || !$operator || !$cabang || !$sparepart) return;

        Pengeluaran::insert([
            [
                'id_service' => $service->id,
                'id_operator' => $operator->id,
                'id_cabang' => $cabang->id,
                'id_sparepart' => $sparepart->id,
                'tgl' => Carbon::now()->subDays(2),
                'jenis' => 'Pembelian sparepart',
                'keterangan' => 'Pembelian fuse',
                'jumlah' => 30000,
            ],
        ]);
    }
}
