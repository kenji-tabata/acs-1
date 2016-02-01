<?php

define('BASE_DIR', dirname(__FILE__));
require BASE_DIR . '/../vendor/autoload.php';

$app = new \Slim\Slim();

function autenticado() {
    return false;
}

if (autenticado()) {
    require BASE_DIR . '/poms/Control.php';
}

$app->get('/', function ($filtro="") {
    if (autenticado()) {
        require BASE_DIR .  '/templates/home.php';
    } else {
        require BASE_DIR .  '/templates/login.php';
    }
});

$app->run();