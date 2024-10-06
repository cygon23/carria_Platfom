<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Guest Middleware Group
        $middleware->appendToGroup('guest', [
            RedirectIfAuthenticated::class,
        ]);

        // Auth Middleware Group
        $middleware->appendToGroup('auth', [
            Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Exception handling logic can be added here
    })
    ->create();
