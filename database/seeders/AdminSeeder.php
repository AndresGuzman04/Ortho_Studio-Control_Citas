<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Empleado;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear o recuperar el empleado administrador
        $empleado = Empleado::firstOrCreate(
            ['razon_social' => 'ADMINISTRADOR GENERAL'],
            [
                'cargo' => 'Administrador',
                'img_path' => null,
            ]
        );

        // 2. Crear o recuperar el usuario administrador
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],  // clave de búsqueda
            [
                'name' => 'ORTHOSTUDIO',
                'password' => bcrypt('admin'),
                'estado' => 1,
                'empleado_id' => $empleado->id, // relación
            ]
        );
    }
}
