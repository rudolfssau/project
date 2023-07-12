<?php

namespace Main\Core;

use Main\Core\Error;
/**
 * Class Controller
 */
abstract class Controller
{
    /**
     * @var array
     */
    protected array $router_params = [];

    /**
     * @param array $router_params
     */
    public function __construct(array $router_params)
    {
        $this->router_params = $router_params;
    }
    /**
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public function __call(string $name, array $arguments)
    {
        $method = $name . "Action";
        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $arguments);
        } else {
           throw new \Exception($method . " not found in controller " . get_class($this));
        }
    }
}