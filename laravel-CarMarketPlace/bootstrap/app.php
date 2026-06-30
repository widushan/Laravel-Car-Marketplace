<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->report(function (\Throwable $e) {
            file_put_contents('php://stderr', "ORIGINAL EXCEPTION: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n");
        });
    })->create();

// On Vercel, redirect storage paths to /tmp (writable filesystem)
if (env('VIEW_COMPILED_PATH')) {
    $app->useStoragePath(env('STORAGE_PATH', '/tmp/storage'));
    $app->useDatabasePath(database_path());
}

return $app;
