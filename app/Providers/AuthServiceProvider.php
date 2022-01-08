<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Fortify;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\App;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();



        Fortify::authenticateUsing(function ($request) {
           
            $validated = Auth::validate([
                'name' => $request->name,
                'password' => $request->password,
                'fallback' => [
                    'name' => $request->name,
                    'password' => $request->password,
                ],
            ]);

            return $validated ? Auth::getLastAttempted() : null;
        });

        RateLimiter::for("login", function () {
            Limit::perMinute(50);
        });
    }
}
