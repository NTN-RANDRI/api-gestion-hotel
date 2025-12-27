<?php

namespace App\Providers;

use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Domain\Repositories\ImageRepositoryInterface;
use App\Domain\Repositories\MaintenanceRepositoryInterface;
use App\Domain\Repositories\PaiementRepositoryInterface;
use App\Domain\Repositories\PersonnelRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Repositories\ChambreRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\ClientRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\EquipementRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\ImageRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\MaintenanceRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\PaiementRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\PersonnelRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\ReservationRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\TypeChambreRepository;
use App\Infrastructure\Persistance\Eloquent\Repositories\UserRepository;
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
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
        $this->app->bind(PaiementRepositoryInterface::class, PaiementRepository::class);
        $this->app->bind(MaintenanceRepositoryInterface::class, MaintenanceRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PersonnelRepositoryInterface::class, PersonnelRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
