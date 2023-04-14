<?php

namespace App\Routes;

use App\Core\Router;

class Api
{
    public static function routes(Router $router)
    {
        $router->get('/api/test', 'Controller@test');
        $router->get('/api/test2', 'Controller@test2');
        $router->post('/api/test2', 'Controller@test2');
        $router->post('/api/testInsert', 'Controller@testInsert');
        $router->get('/api/getAll', 'Controller@getAll');
    }
}