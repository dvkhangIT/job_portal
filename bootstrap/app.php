<?php

use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\Adminredirect;
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
    $middleware->alias([
      'guest' => Adminredirect::class,
      'auth' => AdminAuthenticate::class,
    ]);
    $middleware->redirectTo(
      guests: '/acount/login',
      users: '/'
    );
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
