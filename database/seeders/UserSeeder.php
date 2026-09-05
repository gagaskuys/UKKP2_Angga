<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name'     => 'Super Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'admin',
        ]);

        // 2. Akun Petugas
        User::create([
            'name'     => 'Petugas Satu',
            'email'    => 'petugas@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'petugas',
        ]);

        // 3. Akun Customer
        User::create([
            'name'     => 'Customer Demo',
            'email'    => 'customer@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'customer',
        ]);
    }
}