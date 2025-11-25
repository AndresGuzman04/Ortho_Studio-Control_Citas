<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    /** @use HasFactory<\Database\Factories\EmpleadoFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

}
