<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        Empresa::firstOrCreate([], [
            'nombre' => 'ORTHOSTUDIO',
            'nit' => '1234567',
            'direccion' => 'San Salvador',
            'correo' => 'info@orthostudio.com',
            'telefono' => '00000000',
            'ubicacion' => 'San Salvador',
        ]);
    }
}
