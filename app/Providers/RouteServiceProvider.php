<?php // /home/gunreip/code/tafel-wesseling/app/Providers/RouteServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            // Standard-Webrouten
            Route::middleware('web')->group(base_path('routes/web.php'));

            // API-Routen (falls vorhanden)
            Route::prefix('api')->middleware('api')->group(base_path('routes/api.php'));

            // Admin-Routen
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin/web.php'));
        });
    }
}
