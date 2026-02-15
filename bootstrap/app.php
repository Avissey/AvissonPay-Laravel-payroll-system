<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\URL; // Add this import

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__."/../routes/web.php",
        commands: __DIR__."/../routes/console.php",
        health: "/up",
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Trust all proxies for Render's load balancer
        $middleware->trustProxies(at: '*');
        
        // This is the "Magic" line for Render to force HTTPS for all URLs
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https' );
        }

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'employer' => \App\Http\Middleware\EmployerMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();