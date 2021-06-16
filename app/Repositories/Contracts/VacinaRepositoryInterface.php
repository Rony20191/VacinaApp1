<?php

namespace App\Repositories\Contracts;

use App\Models\Vacina;

interface VacinaRepositoryInterface
{
    public function cadastrarVacina(array $dados): Vacina;

    public function listarVacinas();

    public function verificarQuantidadeDose(int $vacinaId): int;

    public function show(string $id);
}
