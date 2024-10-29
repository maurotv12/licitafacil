<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\LicitacionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidarRol;
use Illuminate\Support\Facades\Route;

Route::view('/', 'licitaciones');

Route::redirect('/', '/licitaciones');

Route::get('usuarios', [BaseController::class, 'indexUsuarios'])
    ->middleware(['auth', 'verified', ValidarRol::class])
    ->name('usuarios');

Route::get('licitaciones', [BaseController::class, 'indexLicitaciones'])
    ->middleware(['auth', 'verified'])
    ->name('licitaciones');

Route::get('clientes', [BaseController::class, 'indexClientes'])
    ->middleware(['auth', 'verified'])
    ->name('clientes');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
