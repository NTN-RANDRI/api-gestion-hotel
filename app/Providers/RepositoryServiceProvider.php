<?php

namespace App\Providers;

use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Repositories\EquipementRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\TypeChambreRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EquipementRepositoryInterface::class, EquipementRepository::class);
        $this->app->bind(TypeChambreRepositoryInterface::class, TypeChambreRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
