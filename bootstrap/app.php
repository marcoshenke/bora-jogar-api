<?php

use App\Exceptions\FileUploadException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\WrapApiResponse;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('api', WrapApiResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (FileUploadException $e) {
            \Illuminate\Support\Facades\Log::channel('file_uploads')->error($e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
            ]);
        });
    })->create();
