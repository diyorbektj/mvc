<?php

namespace Core;

class App {

    public function run()
    {
        $routes = Router::allRoutes();
        if (array_key_exists($_SERVER['REQUEST_URI'], $routes)){

        }else{
            json(['message' => "Not Found"], 404);
        }
        return 1;
    }

    public function displayErrors()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}