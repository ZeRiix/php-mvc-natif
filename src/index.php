<?php

include './routes/api.php';
include './app/Core/Router.php';
include './app/Core/Response.php';
include './app/Core/Controller.php';
include './app/Core/AutoLoad.php';
require_once __DIR__ . '/config/database.php';
include './app/Core/DatabaseConnection.php';

use App\Core\Router;
use App\Routes\Api;

if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, '/api') !== 0) {
        return 'error';
    }


    if (strpos($uri, '?') !== false) {
        $uri = substr($uri, 0, strpos($uri, '?'));
    }

    $api = new Api();
    $router = new Router();
    $api->routes($router);

    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
    }

    $router->direct($uri, $_SERVER['REQUEST_METHOD'], $_REQUEST);    
}