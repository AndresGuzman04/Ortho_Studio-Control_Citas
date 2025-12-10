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
            // Citas
            'ver-citas',
            'crear-cita',
            'editar-cita',
            'eliminar-cita',

            // Paciente
            'ver-pacientes',
            'crear-paciente',
            'editar-paciente',
            'eliminar-paciente',

            // Empresa
            'ver-empresa',
            'editar-empresa',

            // Usuarios
            'ver-usuarios',
            'crear-usuario',
            'editar-usuario',
            'eliminar-usuario',


            // Roles
            'ver-roles',
            'crear-rol',
            'editar-rol',
            'eliminar-rol',

            // Reportes
            'generar-reportes',

        ];


        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
