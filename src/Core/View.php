<?php

namespace Main\Core;

use Exception;

class View
{
    /**
     * @throws Exception
     */
    public static function render(string $view, array $args = []): void
    {
        extract($args, EXTR_SKIP);
        $file = "../src/App/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new Exception("$file not found");
        }
    }
}