<?php

namespace FinVista\User;

use FinVista\User\Domain\LoginTokenRepositoryInterface;
use FinVista\User\Domain\MailerInterface;
use FinVista\User\Domain\UserRepositoryInterface;
use FinVista\User\Infrastructure\DbLoginTokenRepository;
use FinVista\User\Infrastructure\DbUserRepository;
use FinVista\User\Infrastructure\Mailer;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(MailerInterface::class, Mailer::class);
        $this->app->bind(UserRepositoryInterface::class, DbUserRepository::class);
        $this->app->bind(LoginTokenRepositoryInterface::class, DbLoginTokenRepository::class);

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
