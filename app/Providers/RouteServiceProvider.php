<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::domain(config('domain.front-end-h5-api'))
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::domain(config('domain.merchant-api'))
                ->middleware('merchant-api')
                ->group(base_path('routes/merchant.php'));

            Route::domain(config('domain.shop-api'))
                ->middleware('shop-api')
                ->group(base_path('routes/shop.php'));

            Route::domain(config('domain.admin-api'))
                ->middleware('admin-api')
                ->group(base_path('routes/admin.php'));

            Route::domain(config('domain.recharge-card-api'))
                ->middleware('recharge-card-api')
                ->group(base_path('routes/recharge-card.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', fn () => Limit::perMinute(60));
    }
}
