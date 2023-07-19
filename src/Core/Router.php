<?php

namespace Main\Core;

use Exception;

class Router
{
    /**
     * @var array
     */
    //Arrays for storing processed routes from the add() function.
    protected array $routes = [];
    protected array $params = [];

    //add() function gets passed in routes from the entry point, which later on get divided into two arrays - $routes, $params.
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
    //match() checks if the route from the URL matches with any of the pre-defined routes.
    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    $params[$key] = $match;
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * @throws Exception
     */
    //dispatch() is responsible for calling the correct controller and route after they have been processed in the correct format.
    public function dispatch(string $url): void
    {
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertUpper($controller);
            $controller = 'Main\\App\\Controllers\\' . $controller;
            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertLowerFirst($action);
                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    http_response_code(404);
                    throw new Exception("Method $action in controller [$controller] not found...");
                }
            } else {
                http_response_code(404);
                throw new Exception("Controller class $controller not found...");
            }
        } else {
            http_response_code(404);
            throw new Exception("No result found");
        }
    }
    //Converts each word to start in uppercase, and every sub-word to also be upper case.
    public function convertUpper(string $string): array|string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
    //Takes the resulting word from convertUpper() and changes the first letter to be lower case.
    public function convertLowerFirst(string $string): string
    {
        return lcfirst($this->convertUpper($string));
    }
}