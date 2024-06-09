<?php

namespace App\Providers;

use App\Interfaces\CourseServiceInterface;
use App\Interfaces\CourseValidationServiceInterface;
use App\Services\CourseService;
use App\Services\CourseValidationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CourseServiceInterface::class, CourseService::class);
        $this->app->bind(CourseValidationServiceInterface::class, CourseValidationService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
