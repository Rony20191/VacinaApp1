<?php

namespace App\Services;

use App\Models\Paciente;
use App\Repositories\Contracts\PacienteRepositoryInterface;

class PacienteService implements Contracts\PacienteServiceInterface
{
    /**
     * @var PacienteRepositoryInterface
     */
    private PacienteRepositoryInterface $pacienteRepository;

    public function __construct(PacienteRepositoryInterface  $pacienteRepository)
    {

        $this->pacienteRepository = $pacienteRepository;
    }

    public function cadastrarPaciente(array $dados)
    {
       return  $this->pacienteRepository->cadastrarPaciente($dados);
    }

    public function listarPacientes()
    {
       return $this->pacienteRepository->listarPacientes();
    }

    public function show($id): Paciente
    {
        return $this->pacienteRepository->show($id);
    }
}
