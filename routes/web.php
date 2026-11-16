<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/painel');
Route::middleware('guest')->group(function () {
    Route::get('/entrar', [AuthController::class, 'create'])->name('login');
    Route::post('/entrar', [AuthController::class, 'store'])->name('login.store');
});
Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::post('/sair', [AuthController::class, 'destroy'])->name('logout');
    Route::view('/painel', 'dashboard')->name('dashboard');
    Route::resource('clientes', ClienteController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::resource('veiculos', VeiculoController::class)->only(['index', 'create', 'store']);
    Route::resource('agendamentos', AgendamentoController::class)->only(['index', 'create', 'store', 'edit', 'update']);
});