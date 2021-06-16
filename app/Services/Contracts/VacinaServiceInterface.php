<?php


namespace App\Services\Contracts;


interface VacinaServiceInterface
{
    public function cadastrarVacina(array $dados);

    public function listarVacinas();

    public function quantidadeDoses($id): int;
}
