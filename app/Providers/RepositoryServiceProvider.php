<?php

namespace App\Providers;

use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Domain\Repositories\ImageRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Repositories\ChambreRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\ClientRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\EquipementRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\ImageRepository;
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
        $this->app->bind(ChambreRepositoryInterface::class, ChambreRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
