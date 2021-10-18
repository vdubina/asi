<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AsiMainRepository;
use App\Repositories\Interfaces\AsiMainRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AsiMainRepositoryInterface::class, AsiMainRepository::class);
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
