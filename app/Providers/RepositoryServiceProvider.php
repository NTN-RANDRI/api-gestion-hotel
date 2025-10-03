<?php

namespace App\Providers;

use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\EquipementRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EquipementRepositoryInterface::class, EquipementRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
