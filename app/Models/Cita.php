<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    /** @use HasFactory<\Database\Factories\CitaFactory> */
    use HasFactory;
    protected $fillable = [
        'paciente_id',
        'user_id',
        'fecha_hora',
        'motivo',
        'estado'
    ];

     protected $casts = [
        'fecha_hora' => 'datetime', // <-- aquí indicamos que es datetime
    ];

    
    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con Empleado
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
