<?php

namespace Core;

class Router
{
    private array $routes;
    private string $route;

    public static function get($route, $action): void
    {
        (new static())->addRoute($route, $action, "GET");
    }
    public static function post($route, $action): void
    {
        (new static())->addRoute($route, $action, "POST");
    }
    public static function put($route, $action): void
    {
        (new static())->addRoute($route, $action, "PUT");
    }
    public static function patch($route, $action): void
    {
        (new static())->addRoute($route, $action, "PATCH");
    }
    public static function head($route, $action): void
    {
        (new static())->addRoute($route, $action, "HEAD");
    }
    public static function delete($route, $action): void
    {
        (new static())->addRoute($route, $action, "DELETE");
    }

    public static function options($route, $action): void
    {
        (new static())->addRoute($route, $action, "OPTIONS");
    }
    public function addRoute($route, $action, $method): void
    {
        $this->routes[$route] = $action;
       $this->dispatch($_SERVER["REQUEST_URI"], $method);
    }
    public function dispatch($url, $method): void
    {
        $query = parse_url($url, PHP_URL_QUERY);
        $params = [];
        if($query !== null) parse_str($query, $params);
        $path = parse_url($url, PHP_URL_PATH);
        foreach ($this->routes as $route => $action) {
            if (preg_match(self::pattern($route), $path, $data) and $_SERVER['REQUEST_METHOD'] == $method) {
                $matches = self::wildcards($data);
                $this->route = $path;
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
    public function allRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public static function setRoute(string $route): void
    {
        self::$route = $route;
    }
}