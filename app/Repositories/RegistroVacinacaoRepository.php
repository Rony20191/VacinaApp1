<?php

namespace App\Repositories;

use App\Models\Paciente;
use App\Models\RegistroVacinacao;
use App\Models\Vacina;
use Illuminate\Support\Facades\DB;

class RegistroVacinacaoRepository extends BaseRepository implements Contracts\RegistroVacinacaoRepositoryInterface
{
    public function __construct(RegistroVacinacao $model)
    {
        parent::__construct($model);
    }

    public function realizarVacinacao(array $dados,Paciente $paciente)
    {
        return $paciente->vacinas()->attach([$dados]);
    }

    public function verificarDosesAdministradas(array $dados): bool
    {
      return  count(RegistroVacinacao::where('paciente_id',$dados['paciente_id'])
            ->where('vacina_id',$dados['vacina_id'])
            ->where('dose_id',$dados['dose_id'])->get()) > 0;
    }
    public function verificarQuantidadeDosesAdministradas(array $dados): int
    {
        return  count(RegistroVacinacao::where('paciente_id',$dados['paciente_id'])
                ->where('vacina_id',$dados['vacina_id'])->get()) ;
    }
    public function verificarSeExisteVacinacaoComFabricante(array $dados, Vacina $vacina): bool
    {
        $paciente_vacinas = DB::table('paciente_vacinas AS pv')
            ->join('pacientes AS p', 'pv.paciente_id', '=', 'p.id')
            ->join('vacinas AS v', 'pv.vacina_id', '=', 'v.id')
            ->where('p.id',$dados['paciente_id'])
            ->where('v.imunobiologico',$vacina->imunobiologico)
            ->where('v.fabricante','!=',$vacina->fabricante)
            ->get();
        return count($paciente_vacinas) > 0;
    }

    public function registroVacinacaoPaciente($id)
    {
        $paciente_vacinas = DB::table('paciente_vacinas AS pv')
            ->join('pacientes AS p', 'pv.paciente_id', '=', 'p.id')
            ->join('vacinas AS v', 'pv.vacina_id', '=', 'v.id')
            ->join('doses AS d', 'pv.dose_id', '=', 'd.id')
            ->where('p.id',$id)
            ->select(['v.id','d.nome as nome_dose','pv.data_vacinacao','v.imunobiologico','v.lote','v.fabricante','v.data_validade'])
            ->get();
        return $paciente_vacinas;
    }
}
