<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('/api')
                ->group(base_path('routes/api.php'));

            Route::group([
                'prefix' => LaravelLocalization::setLocale(),
                'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
            ], static function () {
                Route::middleware('web')
                    ->group(base_path('routes/web.php'));

                Route::middleware(['web' , 'AdminMenu'])
                    ->prefix('/admin')
                    ->as("admin.")
                    ->group(base_path('routes/admin.php'));

                Route::middleware(['web' , "TaggerMenu"])
                    ->prefix('/tagger')
                    ->as("tagger.")
                    ->group(base_path('routes/tagger.php'));

                Route::middleware('web')
                    ->prefix('/store')
                    ->as("store-customer.")
                    ->group(base_path('routes/store-customer.php'));
            });
        });
    }
}
