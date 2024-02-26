<?php

namespace FinVista\Shared;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::anonymousComponentPath(__DIR__ . '/UI/', 'shared');
        Blade::anonymousComponentPath(__DIR__ . '/UI/components', 'shared-components');
    }
}
