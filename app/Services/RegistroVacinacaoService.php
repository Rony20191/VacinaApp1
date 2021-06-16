<?php

namespace App\Services;

use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\RegistroVacinacaoRepositoryInterface;
use App\Repositories\Contracts\VacinaRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RegistroVacinacaoService implements Contracts\RegistroVacinacaoServiceInterface
{
    /**
     * @var PacienteRepositoryInterface
     */
    private PacienteRepositoryInterface $pacienteRepository;
    /**
     * @var RegistroVacinacaoRepositoryInterface
     */
    private RegistroVacinacaoRepositoryInterface $registroVacinacaoRepository;
    /**
     * @var VacinaRepositoryInterface
     */
    private VacinaRepositoryInterface $vacinaRepository;

    public function __construct(PacienteRepositoryInterface $pacienteRepository, VacinaRepositoryInterface $vacinaRepository, RegistroVacinacaoRepositoryInterface $registroVacinacaoRepository)
    {

        $this->pacienteRepository = $pacienteRepository;
        $this->registroVacinacaoRepository = $registroVacinacaoRepository;
        $this->vacinaRepository = $vacinaRepository;
    }

    public function realizarVacinacao(array $dados)
    {

        $erros = [];
        $paciente = $this->pacienteRepository->showPaciente($dados['paciente_id']);
        $vacinas = $paciente->vacinas()->get();
        $vacina = $this->vacinaRepository->show($dados['vacina_id']);

        if ($this->verificarDosesAdministradas($dados)) {
            throw new \DomainException(trans("exception.paciente.paciente-vacinado"));
        }
        if ($this->registroVacinacaoRepository->verificarQuantidadeDosesAdministradas($dados) === $this->verificarQuantidadeDoseVacina($dados)) {
            throw new \DomainException(trans("exception.vacina.vacina-dose-extra-nao-permitido"));
        }
        $retorno = $this->registroVacinacaoRepository->verificarSeExisteVacinacaoComFabricante($dados, $vacina);
        if ($retorno) {
            throw new \DomainException(trans("exception.vacina.vacina-com-fabricantes-diferentes"));
        }
        if (empty($vacinas)) {
            $this->registroVacinacaoRepository->realizarVacinacao($dados, $paciente);
        } else {
            foreach ($vacinas as $vacina) {
                if ($vacina->pivot->dose_id === $dados['dose_id']) {
                    array_push($erros, ['paciente_vacinado' => trans("exception.paciente.paciente-vacinado")]);
                }
                if ($vacina->pivot->data_vacinacao == $dados['data_vacinacao'] && $vacina->pivot->dose_id === $dados['dose_id']) {
                    array_push($erros, ['data_vacinacao' => trans("exception.registro.data-vacinacao-igual")]);

                } else {
                    $dataInicio = Carbon::parse($dados['data_vacinacao']);
                    $data = new Carbon($vacina->pivot->data_vacinacao);
                    $dataProxima = $data->addDays($vacina->intervalo_minimo);

                    if ($dataProxima >= $dataInicio && $vacina->pivot->dose_id != $dados['dose_id'] && $vacina->id == $dados['vacina_id']) {
                        array_push($erros, ['data_vacinacao' => trans("exception.registro.intervalo-entre-datas")]);
                    }
                }
            }
        }

        if (!empty($erros)) {
            throw new HttpResponseException(response()->json($erros, Response::HTTP_BAD_REQUEST));
        }
        $this->registroVacinacaoRepository->realizarVacinacao($dados, $paciente);
        return $dados;
    }

    public function verificarDosesAdministradas(array $dados)
    {
        return $this->registroVacinacaoRepository->verificarDosesAdministradas($dados);
    }

    public function verificarQuantidadeDoseVacina(array $dados)
    {
        return $this->vacinaRepository->verificarQuantidadeDose($dados['vacina_id']);
    }

    public function registroVacinacaoPaciente($id)
    {
        return $this->registroVacinacaoRepository->registroVacinacaoPaciente($id);
    }
}
