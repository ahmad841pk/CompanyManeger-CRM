<?php

namespace App\Providers;

use App\Contracts\CompanyContract;
use App\Contracts\EmployeeContract;
use App\Contracts\UserContract;
use App\Services\CompanyService;
use App\Services\EmployeeService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserContract::class, UserService::class);
        $this->app->bind(CompanyContract::class, CompanyService::class);
        $this->app->bind(EmployeeContract::class, EmployeeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
