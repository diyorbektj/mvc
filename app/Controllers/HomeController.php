<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        echo "ok";
        return 1;
    }

    public function test()
    {
        return json("ok");
    }
}