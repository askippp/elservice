<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teknisi;
use App\Models\User;
use App\Models\Cabang;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        Teknisi::truncate();
        $user = User::where('email_user', 'teknisi@example.com')->first();
        $cabang = Cabang::first();
        if (!$user || !$cabang) return;

        Teknisi::create([
            'email' => 'teknisi@example.com',
            'no_telp' => '0813333333',
            'nama_lengkap' => 'Teknisi Andalan',
            'id_user' => $user->id,
            'id_cabang' => $cabang->id,
        ]);
    }
}
