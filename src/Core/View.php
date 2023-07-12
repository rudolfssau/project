<?php

namespace Main\Core;

class View
{
    public static function render(string $view, array $args = []): void
    {
        extract($args, EXTR_SKIP);
        $file = "../src/App/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found";
        }
    }
}