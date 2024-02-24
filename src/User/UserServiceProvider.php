<?php

namespace FinVista\User;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

//        $this->app->bind(UserRepositoryInterface::class, DbUserRepository::class);

        View::addNamespace('user', base_path('src/User/UI'));
    }

    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('src/User/Application/routes.php'));
        });
    }
}
