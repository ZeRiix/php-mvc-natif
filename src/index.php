<?php

include './routes/api.php';
use App\Routes\Api;
include './app/Core/Router.php';
use App\Core\Router;

if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, '/api') !== 0) {
        return 'error';
    }

    $api = new Api();
    $router = new Router();
    $api->routes($router);
    $router->direct($uri, $_SERVER['REQUEST_METHOD']);
    
    
}

/*

try {
    echo 'Current PHP version: ' . phpversion();
    echo '<br />';

    $host = 'db';
    $dbname = 'database';
    $user = 'user';
    $pass = 'pass';
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $conn = new PDO($dsn, $user, $pass);

    echo 'Database connected successfully';
    echo '<br />';
} catch (\Throwable $t) {
    echo 'Error: ' . $t->getMessage();
    echo '<br />';
}

*/