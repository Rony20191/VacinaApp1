<?php


namespace App\Repositories\Contracts;


use App\Models\Paciente;

interface PacienteRepositoryInterface
{
    public function cadastrarPaciente(array $dados);

    public function listarPacientes();

    public function showPaciente($id):Paciente;
}
