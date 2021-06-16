<?php

namespace App\Services\Contracts;

interface RegistroVacinacaoServiceInterface
{
    public function realizarVacinacao(array $dados);

    public function verificarDosesAdministradas(array $dados);

    public function registroVacinacaoPaciente($id);

}
