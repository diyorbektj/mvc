#!/usr/bin/env php

<?php


if($argc === 1){
    echo "\033[33mok \033[0m        Test\n";
    system("echo '\e[32mmake:controller'     Test");
}
if(count($argv) > 1 ){
    $data = $argv[1];

    if($data == 'serve'){
        $data = exec("php -S 127.0.0.1:8000 -t public/");
        print_r($data);
    }
}