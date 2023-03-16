<?php

namespace App\Core;

use Routes\Api;

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

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        throw new \Exception('No route defined for this URI.');
    }

    protected function callAction($controller, $action)
    {
        $pathController = "App\\Controllers\\{$controller}";

        $initController = new $pathController();

        if (!method_exists($initController, $action)) {
            throw new \Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $initController->$action();
    }
}