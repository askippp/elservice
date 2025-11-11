<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operator;
use App\Models\User;
use App\Models\Cabang;

class OperatorSeeder extends Seeder
{
    public function run(): void
    {
        Operator::truncate();
        $user = User::where('email_user', 'operator@example.com')->first();
        $cabang = Cabang::first();
        if (!$user || !$cabang) return;

        Operator::create([
            'email' => 'operator@example.com',
            'no_telp' => '0812222222',
            'nama_lengkap' => 'Operator Satu',
            'id_user' => $user->id,
            'id_cabang' => $cabang->id,
        ]);
    }
}
