<?php

namespace App\Providers;

use App\Application\Services\FileStorageInterface;
use App\Infrastructure\Services\LaravelFileStorageService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FileStorageInterface::class, LaravelFileStorageService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
