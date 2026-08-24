<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@clinica.test'
            ],
            [
                'name'      => 'Administrador',
                'password'  => '12345678',
                'role'      => 'admin',
                'status'    =>  true,
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'veterinario@clinica.test'
            ],
            [
                'name'      => 'Dr. Carlos',
                'password'  => '12345678',
                'role'      => 'veterinario',
                'status'    =>  true,
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'recepcao@clinica.test'
            ],
            [
                'name'      => 'Maria',
                'password'  => '12345678',
                'role'      => 'recepcionista',
                'status'    =>  true,
            ]
        );
    }
}
