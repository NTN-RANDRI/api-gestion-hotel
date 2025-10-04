<?php

namespace App\Providers;

use App\Application\UseCases\Equipement\CreateEquipement;
use App\Application\UseCases\Equipement\DeleteEquipement;
use App\Application\UseCases\Equipement\GetEquipementById;
use App\Application\UseCases\Equipement\ListEquipements;
use App\Application\UseCases\Equipement\UpdateEquipement;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /**
         * Regiter Equipement
         */
        $this->app->singleton(CreateEquipement::class, function ($app) {
            return new CreateEquipement(
                $app->make(\App\Domain\Repositories\EquipementRepositoryInterface::class)
            );
        });

        $this->app->singleton(DeleteEquipement::class, function ($app) {
            return new DeleteEquipement(
                $app->make(\App\Domain\Repositories\EquipementRepositoryInterface::class)
            );
        });

        $this->app->singleton(GetEquipementById::class, function ($app) {
            return new GetEquipementById(
                $app->make(\App\Domain\Repositories\EquipementRepositoryInterface::class)
            );
        });

        $this->app->singleton(ListEquipements::class, function ($app) {
            return new ListEquipements(
                $app->make(\App\Domain\Repositories\EquipementRepositoryInterface::class)
            );
        });

        $this->app->singleton(UpdateEquipement::class, function ($app) {
            return new UpdateEquipement(
                $app->make(\App\Domain\Repositories\EquipementRepositoryInterface::class)
            );
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
