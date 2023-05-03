<?php

include './app/Core/AutoLoad.php';

use App\Core\AutoLoad;

$loader = new AutoLoad();
$loader->addDirectory('Core');
$loader->addDirectory('../routes');
$loader->addDirectory('../config');
$loader->register();

use App\Core\Router;
use App\Routes\Api;
use App\Core\Response;


if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];

    if (strpos($uri, '?') !== false) {
        $uri = substr($uri, 0, strpos($uri, '?'));
    }
    $api = new Api();
    $router = new Router();
    $api->routes($router);

    if (isset($_SERVER['CONTENT_TYPE']) and $_SERVER['CONTENT_TYPE'] == 'application/json') {
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
    }

    try {
        $router->direct($uri, $_SERVER['REQUEST_METHOD'], $_REQUEST);
    } catch (\Exception $e) {
        $response = new Response();
        return $response->HTTPResponse(500, 'error', [
            'message' => $e->getMessage(),
            'data' => []
        ]);
    }
} else {
    return 'Error API';
}