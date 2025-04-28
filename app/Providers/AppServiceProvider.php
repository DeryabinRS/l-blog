<?php

namespace App\Providers;

use App\UserRole;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Redirect an Auth user to dashboard
        RedirectIfAuthenticated::redirectUsing(function () {
            return route('admin.dashboard');
        });

        // Redirect No Auth User to Login Page
        Authenticate::redirectUsing(function () {
            Session::flash('fail', 'Пользователь должен быть авторизован');
            return route('login');
        });

        Blade::if('admin', function () {
            return optional(auth()->user())->isAdmin();
        });
    }
}
