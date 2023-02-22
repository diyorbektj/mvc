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
}