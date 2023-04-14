<?php

namespace App\Core;

require_once __DIR__ . '/Loader.php';

class Router
{

    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => [],
            'PUT' => [],
            'DELETE' => [],
        ];
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
    }

    public function delete($uri, $controller)
    {
        $this->routes['DELETE'][$uri] = $controller;
    }

    public function direct($uri, $requestType, $params)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            $controller = explode('@', $this->routes[$requestType][$uri]);
            return $this->callAction(
                $controller[0], $controller[1], $params
            );
        }

        throw new \Exception('No route defined for this URI.');
    }

    protected function callAction($controller, $action, $params)
    {
        $pathController = "App\\Controllers\\{$controller}";

        $loader = new Loader();
        $loader->load($controller);

        $initController = new $pathController();

        if (!method_exists($initController, $action)) {
            throw new \Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        if (count($params) > 0) {
            return $initController->$action($params);
        }

        return $initController->$action();
    }
}