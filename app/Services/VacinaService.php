<?php

namespace App\Services;

use App\Repositories\Contracts\DoseRepositoryInterface;
use App\Repositories\Contracts\VacinaRepositoryInterface;

use Illuminate\Support\Facades\DB;

class VacinaService implements Contracts\VacinaServiceInterface
{
    /**
     * @var VacinaRepositoryInterface
     */
    private VacinaRepositoryInterface $vacinaRepository;
    /**
     * @var DoseRepositoryInterface
     */
    private DoseRepositoryInterface $doseRepository;
    const prefix = 'DOSE';

    public function __construct(VacinaRepositoryInterface $vacinaRepository, DoseRepositoryInterface $doseRepository)
    {
        $this->vacinaRepository = $vacinaRepository;
        $this->doseRepository = $doseRepository;
    }

    public function cadastrarVacina(array $dados)
    {
        $dose = [];
        try {
            DB::beginTransaction();
            $vacina = $this->vacinaRepository->cadastrarVacina($dados);
            for ($i = 1; $i <= $vacina->numero_doses; $i++) {
                $dose['nome'] = self::prefix . '_' . $i;
                $dose['vacina_id'] = $vacina->id;
                $this->doseRepository->cadastrarDose($dose);
            }
            DB::commit();
            return $vacina;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new \Exception($ex->getMessage());
        }
    }

    public function listarVacinas()
    {
        return $this->vacinaRepository->listarVacinas();
    }

    public function quantidadeDoses($id): int
    {
        return $this->vacinaRepository->verificarQuantidadeDose($id);
    }
}
