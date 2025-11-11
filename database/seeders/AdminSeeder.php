<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::truncate();
        $user = User::where('email_user', 'admin@example.com')->first();
        if (!$user) return;

        Admin::create([
            'email' => 'admin@example.com',
            'no_telp' => '0811111111',
            'nama_lengkap' => 'Admin Utama',
            'id_user' => $user->id,
        ]);
    }
}
