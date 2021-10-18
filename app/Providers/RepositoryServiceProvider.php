<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SampleRepository;
use App\Repositories\Interfaces\SampleRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SampleRepositoryInterface::class,
            SampleRepository::class
        );
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
