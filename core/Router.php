<?php

namespace Core;

class Router
{
    private static array $routes;
    private static string $route;

    public static function get($route, $action): void
    {
        self::addRoute($route, $action, "GET");
    }
    public static function post($route, $action): void
    {
        self::addRoute($route, $action, "POST");
    }
    public static function put($route, $action): void
    {
        self::addRoute($route, $action, "PUT");
    }
    public static function patch($route, $action): void
    {
        self::addRoute($route, $action, "PATCH");
    }
    public static function head($route, $action): void
    {
        self::addRoute($route, $action, "HEAD");
    }
    public static function delete($route, $action): void
    {
        self::addRoute($route, $action, "DELETE");
    }

    public static function options($route, $action): void
    {
        self::addRoute($route, $action, "OPTIONS");
    }
    public static function addRoute($route, $action, $method): void
    {
        self::$routes[$route] = $action;
        self::dispatch($_SERVER["REQUEST_URI"], $method);
    }
    public static function dispatch($url, $method): void
    {
        $query = parse_url($url, PHP_URL_QUERY);
        $params = [];
        if($query !== null) parse_str($query, $params);
        $path = parse_url($url, PHP_URL_PATH);
        foreach (self::$routes as $route => $action) {
            if (preg_match(self::pattern($route), $path, $data) and $_SERVER['REQUEST_METHOD'] == $method) {
                $matches = self::wildcards($data);
                self::$route = $path;
                if (is_array($action)) {
                    $controller = new $action[0]();
                    call_user_func_array([$controller, $action[1]], $matches);
                    exit(1);
                } else {
                    call_user_func_array($action, $matches);
                    exit(1);
                }
            }
        }
    }
    private static function wildcards(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (!is_int($key)) $result[$key] = $value;
        }
        return $result;
    }
    public static function pattern($url): string
    {
        return "#^/?" . preg_replace("#/{([^/]+)}#", "/(?<$1>[^/]+)", $url) . "/?$#";
    }
    public static function allRoutes(): array
    {
        return self::$routes;
    }

    /**
     * @return string
     */
    public static function getRoute(): string
    {
        return self::$route;
    }

    /**
     * @param string $route
     */
    public static function setRoute(string $route): void
    {
        self::$route = $route;
    }
}