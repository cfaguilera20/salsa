<?php
namespace Core\Router;

class Router
{
    private $routes = [];
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function addRoute(string $method, string $path, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function getRoute(string $method, string $path)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                return $route;
            }
        }
        return null;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function resolve(string $method, string $path)
    {
        $path = $this->normalizePath($path);
        $route = $this->getRoute($method, $path);
        if ($route === null) {
            throw new \Exception('Route not found');
        }

        $handler = $route['handler'];
        if (is_string($handler)) {
            $handler = explode('::', $handler);
        }

        $controller = new $handler[0]($this->serviceLocator);
        $method = $handler[1];
        $controller->$method();
    }

    public function normalizePath($path)
    {
        $path = str_replace('/index.php', '', $path);
        $path = explode('?', $path);
        return $path[0];
    }
}
