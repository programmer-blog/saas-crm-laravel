<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function dispatch($method, $uri)
    {
        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            echo "404 Not Found";
            return;
        }

        foreach ($this->middlewares as $middleware) {
            $middlewareInstance = new $middleware();

            if (!$middlewareInstance->handle()) {
                echo "Blocked by middleware";
                return;
            }
        }
        [$controller, $method] = $action;

        $controllerInstance = new $controller();

        return $controllerInstance->$method();
    }

    public function middleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }
}