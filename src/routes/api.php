<?php

namespace App\Routes;

use App\Core\Router;

class Api
{
    public static function routes(Router $router)
    {
        $router->get('/api/test', 'Controller@test');
    }
}