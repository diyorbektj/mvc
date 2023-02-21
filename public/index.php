<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Core\App;

require __DIR__.'/../vendor/autoload.php';


$app = new App;
$app->displayErrors();
$app->run();