<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Use the container to ensure we are registering the resolution only once
        $this->app->resolving(ConvertEmptyStringsToNull::class, function ($middleware, $app) {
            // Replace the middleware instance with one that does nothing (a NOP handler)
            // This prevents the middleware from running the crashing transformation logic.
            return new class($app) extends ConvertEmptyStringsToNull {
                public function handle($request, \Closure $next)
                {
                    // Do nothing in the transform/handle, just pass the request along.
                    return $next($request);
                }
            };
        });
    }
}