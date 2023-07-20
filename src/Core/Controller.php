<?php

namespace Main\Core;

use Exception;

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
    //The __constructor is responsible for passing route parameters to other classes that extend
    //the "Controller" class.
    public function __construct(array $router_params)
    {
        $this->router_params = $router_params;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return void
     * @throws Exception
     */
    //The __call function has been implemented as an extra security layer. For example, if the
    // user calls "/get/returnJson" it will add an "Action" to the end of the "returnJson", converting it to
    //"/get/returnJsonAction". This helps to prevent unwanted calls.
    public function __call(string $name, array $arguments)
    {
        $method = $name . "Action";
        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $arguments);
        } else {
           throw new Exception($method . " not found in controller " . get_class($this));
        }
    }
}