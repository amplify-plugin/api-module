<?php

namespace Amplify\System\Api;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

/**
 * Class ApiServiceProvider
 */
class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__ . '/../config/amplify/api.php',
            'amplify.api'
        );
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        // Publish configuration files
        $this->publishes([
            __DIR__ . '/../config/api.php' => config_path('amplify/api.php'),
        ], 'config');

        $this->configureRateLimiting();

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
