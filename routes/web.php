<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;


Route::get('/', [HomeController::class, 'index'])->name('panel');

Route::resource('empresa', EmpresaController::class);
Route::resource('pacientes', PacienteController::class);

Route::resource('citas', CitaController::class);

