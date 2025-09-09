<?php

namespace App\Providers;


use App\Policies\JobPolicy;
use App\Models\job;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        job::class => JobPolicy::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
      $this->registerPolicies();
    }
}
