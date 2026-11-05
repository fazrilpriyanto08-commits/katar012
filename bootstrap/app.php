<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, Request $request) {
            return new \Illuminate\Http\Response(
                "=== APPLICATION ROOT ERROR ===\n" .
                "Message: " . $e->getMessage() . "\n" .
                "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n" .
                "Stack Trace:\n" .
                $e->getTraceAsString(),
                500,
                ['Content-Type' => 'text/plain']
            );
        });
    })->create();
