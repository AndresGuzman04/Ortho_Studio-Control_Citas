<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'email',
        'estado',
        'numero_documento',
    ];

    // Un paciente puede tener muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
