<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RegistroVacinacaoController;
use App\Http\Controllers\VacinaController;
use Illuminate\Support\Facades\Route;


Route::post('/vacina',[VacinaController::class,'store'])->name('vacina.store');
Route::get('/vacinas',[VacinaController::class,'index'])->name('vacina.index');
Route::get('/vacina/{id}/doses',[VacinaController::class,'quantDoses']);

Route::get('/pacientes',[PacienteController::class,'index'])->name('paciente.index');
Route::post('/paciente',[PacienteController::class,'store'])->name('paciente.store');

Route::post('/registro/vacinacao',[RegistroVacinacaoController::class,'vacinacao'])->name('store.vacinacao');
Route::get("/registro/vacinacao/paciente/{id}",[RegistroVacinacaoController::class,'registro']);
