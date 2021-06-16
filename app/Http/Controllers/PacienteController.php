<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Services\Contracts\PacienteServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PacienteController extends Controller
{
    /**
     * @var PacienteServiceInterface
     */
    private PacienteServiceInterface $pacienteService;

    public function __construct(PacienteServiceInterface $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function store(PacienteRequest $request)
    {
        try{
            $dados = $request->validated();
            $dados = $this->pacienteService->cadastrarPaciente($dados);
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
           $dados = $this->pacienteService->listarPacientes();
           return response()->json(['dados' => $dados]);
       }catch (\Exception $ex){
           return response()->json(['error' => $ex->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
       }
    }
}
