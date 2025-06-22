<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Tambahkan use middleware lo
use App\Http\Middleware\CheckUserAccess;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Daftarkan alias middleware lo di sini
        $middleware->alias([
            'check.user.access' => CheckUserAccess::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'check.app.active' => \App\Http\Middleware\CheckAppActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
