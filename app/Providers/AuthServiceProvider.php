<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            Passport::routes();
        }

        Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addMinutes(env('PASSPORT_ACCESS_TOKEN_TTL_MINUTES', 900)));
        Passport::refreshTokensExpireIn(now()->addDays(env('PASSPORT_REFRESH_TOKEN_TTL_DAYS', 30)));
        Passport::personalAccessTokensExpireIn(now()->addDays(env('PASSPORT_PERSONAL_TOKEN_TTL_DAYS', 180)));
        Passport::tokensCan(config('passport.scopes'));

        $this->registerPolicies();
    }
}
