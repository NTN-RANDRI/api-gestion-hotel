<?php

namespace App\Providers;

use App\Application\Services\AuthServiceInterface;
use App\Application\Services\CurrentAuthInterface;
use App\Application\Services\FileStorageInterface;
use App\Application\Services\MailServiceInterface;
use App\Application\Services\TokenServiceInterface;
use App\Infrastructure\Services\LaravelAuthService;
use App\Infrastructure\Services\LaravelFileStorageService;
use App\Infrastructure\Services\LaravelMailService;
use App\Infrastructure\Services\TokenService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FileStorageInterface::class, LaravelFileStorageService::class);
        $this->app->bind(TokenServiceInterface::class, TokenService::class);
        $this->app->bind(MailServiceInterface::class, LaravelMailService::class);
        $this->app->bind(CurrentAuthInterface::class, LaravelAuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
