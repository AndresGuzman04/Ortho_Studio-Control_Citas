<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;

Route::get('/', [HomeController::class, 'index'])->name('panel');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::resource('empresa', EmpresaController::class);
Route::resource('pacientes', PacienteController::class);
Route::resource('citas', CitaController::class);
Route::resource('users', userController::class);
Route::resource('roles', roleController::class);

// web.php
Route::post('/reporte-citas', [ReporteController::class, 'reporteCitas'])
    ->name('reporte.citas');
