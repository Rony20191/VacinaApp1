<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RegistroVacinacaoController;
use App\Http\Controllers\VacinaController;
use App\Http\Requests\RegistroVacinacaoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});





Route::post('/vacina',[VacinaController::class,'store'])->name('vacina.store');
Route::get('/vacinas',[VacinaController::class,'index'])->name('vacina.index');
Route::get('/vacina/{id}/doses',[VacinaController::class,'quantDoses']);

Route::get('/pacientes',[PacienteController::class,'index'])->name('paciente.index');
Route::post('/paciente',[PacienteController::class,'store'])->name('paciente.store');


Route::post('/registro/vacinacao',[RegistroVacinacaoController::class,'vacinacao'])->name('store.vacinacao');
Route::get("/registro/vacinacao/paciente/{id}",[RegistroVacinacaoController::class,'registro']);
