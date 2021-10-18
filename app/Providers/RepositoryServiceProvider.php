<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AsiRemoteRepository;
use App\Repositories\Interfaces\AsiRemoteRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AsiRemoteRepositoryInterface::class, AsiRemoteRepository::class);
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
