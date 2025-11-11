<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Operator;
use App\Models\Cabang;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::truncate();
        $operator = Operator::first();
        $cabang = Cabang::first();
        if (!$operator || !$cabang) return;

        Customer::create([
            'nama_customer' => 'PT Pelanggan Jaya',
            'email' => 'customer@example.com',
            'no_telp' => 628144444444,
            'alamat' => 'Jalan Kenanga No.3',
            'id_operator' => $operator->id,
            'id_cabang' => $cabang->id,
        ]);
    }
}
