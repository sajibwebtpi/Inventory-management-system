<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            '/*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function(ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);           
            
        });
    })->create();
