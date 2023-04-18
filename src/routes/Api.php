<?php

namespace App\Routes;

use App\Core\Router;

class Api
{
    public static function routes(Router $router)
    {
        //GET
        $router->get('/api/test', 'Controller@test');
        $router->get('/api/test2', 'Controller@test2');
        $router->get('/api/getAllUser', 'Controller@getAllUser');

        //POST
        $router->post('/api/test2', 'Controller@test2');
        $router->post('/api/insertUser', 'Controller@insertUser');
        $router->post('/api/getAllUserWhere', 'Controller@getAllUserWhere');
        $router->post('/api/deleteUser', 'Controller@deleteUser');
        $router->post('/api/updateUserWhere', 'Controller@updateUserWhere');
    }
}