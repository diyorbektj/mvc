<?php

namespace Core;

class Route
{
    private static array $routes = [];

    public static function get($route, $action)
    {
        return self::method($route, $action, "GET");
    }
    public static function post($route, $action)
    {
        return self::method($route, $action, "POST");
    }

    public static function method($route,$action, $method)
    {
        self::$routes = array_merge(self::$routes, [$route => ['method' => $method]]);
        if($_SERVER["REQUEST_URI"] == $route and $_SERVER['REQUEST_METHOD'] == $method){
            return self::controller($action);
        }
    }

    public static function controller($action)
    {
        if(is_array($action)){
            $controller = new $action[0]();
            return call_user_func_array([$controller, $action[1]], (array)'');
        }else{
            return call_user_func($action);
        }
    }

    public static function routeAll(): array
    {
        return self::$routes;
    }
}