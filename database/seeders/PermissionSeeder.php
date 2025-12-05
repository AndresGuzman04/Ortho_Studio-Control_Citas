<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            //Citas
            'ver-citas',
            'crear-cita',
            'editar-cita',
            'eliminar-cita',

            // Empleado
            'ver-empleados',
            'crear-empleado',
            'editar-empleado',
            'eliminar-empleado',

            // Paciente
            'ver-pacientes',
            'crear-paciente',
            'editar-paciente',
            'eliminar-paciente',

            // Empresa
            'ver-empresa',
            'editar-empresa',
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
