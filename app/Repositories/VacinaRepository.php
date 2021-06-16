<?php

namespace App\Repositories;

use App\Models\Vacina;

class VacinaRepository extends BaseRepository implements Contracts\VacinaRepositoryInterface
{
    public function __construct(Vacina $model)
    {
        parent::__construct($model);
    }

    public function cadastrarVacina(array $dados): Vacina
    {
        return $this->store($dados);
    }

    public function listarVacinas()
    {
        return $this->index();
    }

    public function verificarQuantidadeDose(int $vacinaId): int
    {
        return count($this->model->findOrFail($vacinaId)->doses);
    }

}
