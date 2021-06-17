<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroVacinacaoRequest;
use App\Services\Contracts\RegistroVacinacaoServiceInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RegistroVacinacaoController extends Controller
{

    private RegistroVacinacaoServiceInterface $vacinaService;

    public function __construct(RegistroVacinacaoServiceInterface $vacinaService)
    {
        $this->vacinaService = $vacinaService;
    }

    public function vacinacao(RegistroVacinacaoRequest $request)
    {
        try {
            $dados = $request->validated();
            $dados = $this->vacinaService->realizarVacinacao($dados);
            return response()->json(['dados' => $dados]);
        } catch (HttpResponseException $hp) {
            return response()->json(['errors' => json_decode($hp->getResponse()->getContent()), 'messagem' => $hp->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\DomainException $ex) {
            return response()->json(['errors' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function registro($id)
    {
        try {

            $dados = $this->vacinaService->registroVacinacaoPaciente($id);
            return response()->json(['dados' => $dados]);
        } catch (HttpResponseException $hp) {
            return response()->json(['errors' => json_decode($hp->getResponse()->getContent()), 'messagem' => $hp->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\DomainException $ex) {
            return response()->json(['errors' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
