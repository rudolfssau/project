<?php

namespace Main\Core;

class Router
{
    /**
     * @var array
     */
    protected array $routes = [];
    protected array $params = [];

    public function add(string $route, array $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z]+)', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function dispatch(string $url): void
    {
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = 'Main\\App\\Controllers\\' . $controller;
            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    throw new Exception("Method $action in controller [$controller] not found...");
                }
            } else {
                throw new Exception("Controller class $controller not found...");
            }
        } else {
            throw new Exception("No result found", 404);
        }
    }
    public function convertToStudlyCaps(string $string): array|string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
    public function convertToCamelCase(string $string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
}