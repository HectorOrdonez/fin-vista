<?php

namespace FinVista\Company;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Infrastructure\Repository\DbCompanyRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CompanyServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(CompanyRepositoryInterface::class, DbCompanyRepository::class);

        View::addNamespace('company', base_path('src/Company/UI'));
    }

    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('src/Company/Application/routes.php'));
        });
    }
}
