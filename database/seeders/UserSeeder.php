<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Usuario Administrador
        User::firstOrCreate(
            ['email' => 'admin@papeleria.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'),
                // 'role' => 'admin' // Descomenta esta línea si manejas una columna de roles en tu tabla
            ]
        );

        // 2. Usuario Cajero
        User::firstOrCreate(
            ['email' => 'cajero@papeleria.com'],
            [
                'name' => 'Cajero',
                'password' => Hash::make('cajero123'),
                // 'role' => 'cajero' // Descomenta esta línea si manejas una columna de roles en tu tabla
            ]
        );
    }
}