<?php

use App\Controllers\PostController;
use Core\Router;


Router::get('/posts', [PostController::class, 'index']);
Router::get('/posts/{id}', [PostController::class, 'show']);
Router::post('/posts', [PostController::class, 'store']);
Router::post('/posts/{id}', [PostController::class, 'update']);
Router::delete('/posts/{id}', [PostController::class, 'destroy']);