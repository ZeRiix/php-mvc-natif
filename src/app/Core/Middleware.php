<?php

namespace App\Core;

use App\Core\Loader;

class Middleware
{
    public static function handle($middleware)
    {
        $middleware = 'App\\Middlewares\\' . $middleware;
        $loader = new Loader();
        $loader->load($middleware);
        $middleware = new $middleware();
        $middleware->handle();
    }
}