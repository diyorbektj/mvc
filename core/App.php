<?php

namespace Core;

class App {

    //need refactoring this method
    public function run()
    {
        $routes = (new Router)->allRoutes();

        if (array_key_exists($_SERVER['REQUEST_URI'], $routes)){

        }else{
            return json(['message' => "Not Found"], 404);
        }
        return 1;
    }
}