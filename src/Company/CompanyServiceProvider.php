<?php

namespace FinVista\Company;

use FinVista\Company\Application\Livewire\CompanyListing;
use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Infrastructure\Repository\DbCompanyRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;

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
        Blade::anonymousComponentPath(__DIR__ . '/UI/', 'companies');
        Livewire::component('company-listing', CompanyListing::class);

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('src/Company/Application/routes.php'));
        });
    }
}
