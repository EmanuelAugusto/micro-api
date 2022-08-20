<?php

namespace Core\Routes;

class Routes
{
    private static $instances = [];

    private static $routes = [];

    protected function __clone()
    {
    }

    protected function __wakeup()
    {
        throw new \Exception('cannot_unserialize_a_singleton.');
    }

    public static function getInstance()
    {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }

    public function addRoute($route)
    {
        array_push(self::$routes, $route);
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function post($route)
    {
        self::getInstance()->addRoute($route);
    }

    public static function get($route)
    {
        self::getInstance()->addRoute($route);
    }

    public static function put($route)
    {
        self::getInstance()->addRoute($route);
    }

    public static function delete($route)
    {
        self::getInstance()->addRoute($route);
    }
}
