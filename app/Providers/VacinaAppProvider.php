<?php

namespace App\Providers;

use App\Repositories\Contracts\DoseRepositoryInterface;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\RegistroVacinacaoRepositoryInterface;
use App\Repositories\Contracts\VacinaRepositoryInterface;
use App\Repositories\DoseRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\RegistroVacinacaoRepository;
use App\Repositories\VacinaRepository;
use App\Services\Contracts\PacienteServiceInterface;
use App\Services\Contracts\RegistroVacinacaoServiceInterface;
use App\Services\Contracts\VacinaServiceInterface;
use App\Services\PacienteService;

use App\Services\RegistroVacinacaoService;
use App\Services\VacinaService;
use Illuminate\Support\ServiceProvider;

class VacinaAppProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PacienteServiceInterface::class, PacienteService::class);
        $this->app->bind(PacienteRepositoryInterface::class, PacienteRepository::class);
        $this->app->bind(DoseRepositoryInterface::class, DoseRepository::class);
        $this->app->bind(VacinaServiceInterface::class, function ($app) {
            return new VacinaService(
                $app->make(VacinaRepositoryInterface::class),
                $app->make(DoseRepositoryInterface::class)
            );
        });
        $this->app->bind(VacinaRepositoryInterface::class, VacinaRepository::class);
        $this->app->bind(RegistroVacinacaoServiceInterface::class, function ($app) {
            return new RegistroVacinacaoService(
                $app->make(PacienteRepositoryInterface::class),
                $app->make(VacinaRepositoryInterface::class),
                $app->make(RegistroVacinacaoRepositoryInterface::class)
            );
        });
        $this->app->bind(RegistroVacinacaoRepositoryInterface::class, RegistroVacinacaoRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
