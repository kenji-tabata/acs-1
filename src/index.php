<?php

require dirname(__FILE__) . '/../vendor/autoload.php';
require dirname(__FILE__) . '/app.php';


#
# index
#
App::$slim->get('/', function ($filtro="") {
    if (autenticado()) {
        require App::$path['base-dir'] .  '/templates/home.php';
    } else {
        require App::$path['base-dir'] .  '/templates/login.php';
    }
});


#
# login, sing in, logando-se
#
App::$slim->post('/login/', function () {
    $request = \Slim\Slim::getInstance()->request();
    $senha =  $request->params('txt-senha');
    // var_dump($senha);
    autenticar($senha);
    App::$slim->redirect('/acs/src');
});


#
# Módulo Poms
#
if (autenticado()) {
    require App::$path['base-dir'] . '/poms/Control.php';
}


#
# run, run, run!
#
App::$slim->run();