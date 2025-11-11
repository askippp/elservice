<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Operator;
use App\Models\Teknisi;
use App\Models\Alat;
use App\Models\Cabang;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::truncate();
        $customer = Customer::first();
        $operator = Operator::first();
        $teknisi = Teknisi::first();
        $alat = Alat::first();
        $cabang = Cabang::first();
        if (!$customer || !$operator || !$teknisi || !$alat || !$cabang) return;

        Service::insert([
            [
                'id_customer' => $customer->id,
                'id_operator' => $operator->id,
                'id_teknisi' => $teknisi->id,
                'id_alat' => $alat->id,
                'id_cabang' => $cabang->id,
                'tgl_service' => Carbon::now()->subDays(3),
                'keluhan' => 'Alat tidak menyala',
                'status' => 'proses',
                'tgl_selesai' => null,
                'keterangan' => null,
                'total_harga' => null,
                'status_bayar' => 'belum_bayar',
                'tipe_pembayaran' => null,
            ],
        ]);
    }
}
