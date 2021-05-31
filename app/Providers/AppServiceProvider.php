<?php

namespace App\Providers;

use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LogMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->checkRoles();
    }

    public function checkRoles()
    {
        \Blade::if('hasPermission', function ($actionName = null) {
            $user = Auth::user();
            return $user->hasPermission($actionName);
        });

        \Blade::if('hasAtLeastOnePermission', function ($actionName = []) {
            $user = Auth::user();
            foreach ($actionName as $value) {
                if ($user->hasPermission($value))
                    return true;
            }
            return false;
        });
    }
}
