<?php

namespace App\Router;


class Router
{
    private $url;
    private $routes = [];
    private static $namedRoutes = [];
    private $basePath = '';

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    public function setBasePath($basePath)
    {
        $this->basePath = trim($basePath, '/');
    }

    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }
    public function addRoutes($routes)
    {
        foreach ($routes as $route) {
            $this->add($route[0], $route[1], $route[2], $route[3]);
        }
    }
    public function add($path, $callable, $name, $method)
    {
        $path = $this->basePath . '/' . trim($path, '/');
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;

        if (is_string($callable) && $name === null) {
            $name = $callable;
        }

        if ($name) {
            self::$namedRoutes[$name] = $route;
        }

        return $route;
    }

    public function run()
    {

        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new \Exception('REQUEST_METHOD does not exist');
        }

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
    }

    public static function url($name, $params = [])
    {
        if (!isset(self::$namedRoutes[$name])) {
            throw new \Exception('No route matches this name');
        }

        return '/' . self::$namedRoutes[$name]->getUrl($params);
    }

    public function getRoutes()
    {
        return $this->routes;
    }


}
