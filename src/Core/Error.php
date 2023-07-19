<?php

namespace Main\Core;

class Error
{
    public static function exceptionHandler($exception): void
    {
        $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
        ini_set('error_log', $log);
        $message = "Uncaught exception: '" . get_class($exception). "'";
        $message .= " with message '" . $exception->getMessage() . "'";
        $message .= " \nStack trace: " . $exception->getTraceAsString();
        $message .= " \nThrown in '" . $exception->getFile()."' on line " . $exception->getLine();
        error_log($message);
    }
}