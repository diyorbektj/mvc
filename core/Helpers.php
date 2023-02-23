<?php

use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Dotenv\Dotenv;


$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

function json($data, $statusCode=200)
{
    header('Content-Type: application/json');
    header(sprintf('HTTP/1.1 %s', $statusCode));
    echo json_encode($data);
    return 1;
}

function config($config)
{
    if($data = explode(".", $config)){
        $test = include(__DIR__ . '/../config/' .$data[0].'.php');
        return $test[$data[1]];
    }else{
        return include(__DIR__ . '/../config/' .$config.'.php');
    }

}

function env($param, $default=null)
{
    return $_ENV[$param] ?? $default;
}

function abort(int $status=404, string $message="Not Found"): int
{
    header('Content-Type: application/json');
    header(sprintf('HTTP/1.1 %s', $status));
    echo json_encode(['message' => $message]);
    return 1;
}