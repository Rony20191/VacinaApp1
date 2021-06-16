<?php


namespace App\Repositories\Contracts;


use App\Models\Paciente;
use App\Models\Vacina;

interface RegistroVacinacaoRepositoryInterface
{
    public function realizarVacinacao(array $dados,Paciente $paciente);

    public function verificarDosesAdministradas(array $dados): bool;

    public function verificarQuantidadeDosesAdministradas(array $dados): int;

    public function verificarSeExisteVacinacaoComFabricante(array $dados, Vacina $vacina): bool;

    public function registroVacinacaoPaciente($id);
}
