<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {


        // 2. Crear o recuperar el usuario administrador
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'ORTHOSTUDIO',
                'Puesto' => 'Administrador',
                'password' => bcrypt('admin'),
                'estado' => 1,
            ]
        );

        // 3. Rol administrador (seguro)
        $rol = Role::firstOrCreate(
            ['name' => 'administrador', 'guard_name' => 'web']
        );

        // 4. Obtener todos los permisos con guard web
        $permisos = Permission::where('guard_name', 'web')->get();

        // 5. Asignar permisos al rol
        $rol->syncPermissions($permisos);

        // 6. Asignar rol al usuario
        if (!$user->hasRole($rol->name)) {
            $user->assignRole($rol->name);
        }
    }
}
