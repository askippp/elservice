<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();
        User::insert([
            [
                'email_user' => 'admin@example.com',
                'password' => Hash::make('password'),
                'foto' => null,
            ],
            [
                'email_user' => 'operator@example.com',
                'password' => Hash::make('password'),
                'foto' => null,
            ],
            [
                'email_user' => 'teknisi@example.com',
                'password' => Hash::make('password'),
                'foto' => null,
            ],
        ]);
    }
}
