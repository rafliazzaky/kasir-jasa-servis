<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin Default
        User::create([
            'name' => 'Admin Bengkel',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Akun Kasir Default
        User::create([
            'name' => 'Kasir Bengkel',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);
    }
}