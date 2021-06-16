<?php


namespace App\Repositories;


use App\Models\Paciente;

class PacienteRepository extends BaseRepository implements Contracts\PacienteRepositoryInterface
{
    public function __construct(Paciente $model)
    {
        parent::__construct($model);
    }

    public function cadastrarPaciente(array $dados)
    {
        return $this->store($dados);
    }

    public function listarPacientes()
    {
        return $this->index();
    }

    public function showPaciente($id): Paciente
    {
        return $this->model->findOrFail($id);
    }
}
