<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;


Route::get('/', [HomeController::class, 'index'])->name('panel');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::resource('empresa', EmpresaController::class);
Route::resource('pacientes', PacienteController::class);
Route::resource('citas', CitaController::class);

