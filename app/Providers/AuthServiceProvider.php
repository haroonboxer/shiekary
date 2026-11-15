<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {

            foreach ($user->claims as $claim) {

                if (
                    strtolower(trim($claim['type'] ?? ''))
                    === strtolower(trim($ability))
                    &&
                    ($claim['allowed'] ?? false) === true
                ) {
                    return true;
                }
            }

            return null;
        });
    }
}
