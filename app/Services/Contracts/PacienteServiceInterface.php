<?php


namespace App\Services\Contracts;


use App\Models\Paciente;

interface PacienteServiceInterface
{
    public function cadastrarPaciente(array $dados);

    public function listarPacientes();

    public function show($id):Paciente;
}
