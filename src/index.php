<?php
require dirname(__FILE__) . '/../vendor/autoload.php';


$app = new \Slim\Slim();

if(false) {
    require dirname(__FILE__) . '/poms/Control.php';
}

$app->get('/', function ($filtro="") {
    require 'home.php';

});

$app->run();