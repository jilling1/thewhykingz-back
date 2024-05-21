<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\NewsItemRepositoryInterface;
use App\Repositories\NewsItemRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(NewsItemRepositoryInterface::class,NewsItemRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
