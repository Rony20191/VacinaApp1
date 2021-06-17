<?php

namespace App\Http\Controllers;


use App\Http\Requests\VacinaRequest;
use App\Services\Contracts\RegistroVacinacaoServiceInterface;
use App\Services\Contracts\VacinaServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class VacinaController extends Controller
{
    /**
     * @var RegistroVacinacaoServiceInterface
     */
    private VacinaServiceInterface $vacinaService;

    public function __construct(VacinaServiceInterface $vacinaService)
    {

        $this->vacinaService = $vacinaService;
    }

    public function store(VacinaRequest $request)
    {
        try{
            $dados = $request->validated();
            $dados = $this->vacinaService->cadastrarVacina($dados);
            return response()->json(['dados' => $dados]);
        }catch (ValidationException $ex){
            return response()->json(['errors' => $ex->errors(),'messagem' => $ex->getMessage()],Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (\Exception $ex){
            return response()->json(['error' => $ex->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        try{
            $dados = $this->vacinaService->listarVacinas();
            return response()->json(['dados' => $dados]);
        }catch (\Exception $ex){
            return response()->json(['errors' => $ex->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
     public function quantDoses($id)
     {
             $dados = $this->vacinaService->quantidadeDoses($id);
             return response()->json(['dados' => ["quantidade_doses" => $dados]]);

     }


}
