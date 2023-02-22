<?php

use App\Models\Posts;
use Carbon\Carbon;
use Core\Request;
use Core\Router;

Router::get("/test", [\App\Controllers\HomeController::class, 'index']);
Router::post("/test1", [\App\Controllers\HomeController::class, 'test']);
Router::post("/req", function (){
    $request = new Request();
    dd($request->get('test'));
//    dd((new \App\Models\Posts)->where('id', '>', 1)->where('id', '<', 10)->get());
});
Router::get("/posts/{id}", function ($id){
    dd(Posts::query()->find($id));
//    dd((new Posts())->insert([
//        'title' => "test od mvc 2",
//        'description' => "test test test 2 121",
//        'created_at' => Carbon::now(),
//        'updated_at' => Carbon::now(),
//    ]));
//    dd((new Posts)->where('id', '=', $id)->first());
});

//$router->get("/(\d+)", function (){
//    echo "salom";
//});