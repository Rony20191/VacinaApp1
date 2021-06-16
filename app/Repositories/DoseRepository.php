<?php


namespace App\Repositories;


use App\Models\Dose;

class DoseRepository extends BaseRepository implements Contracts\DoseRepositoryInterface
{
    public function __construct(Dose $model)
    {
        parent::__construct($model);
    }

    public function cadastrarDose(array $dados)
    {
        return $this->store($dados);
    }
}
