<?php

namespace App\Providers;

use App\Domain\Repositories\EnterpriseRepository;
use App\Infrastructure\Repositories\EloquentEnterpriseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(EnterpriseRepository::class, EloquentEnterpriseRepository::class);
    }

   
}
