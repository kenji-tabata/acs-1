<?php

#
#
#
define('BASE_DIR', dirname(__FILE__));
require BASE_DIR . '/../vendor/autoload.php';

#
# Bootstrap...
#
session_start();
$app = new \Slim\Slim();

#
# Session debug
#
// $_SESSION['auth'] = '';
// unset($_SESSION['auth']);
// var_dump($_SESSION);


#
# Func aux
#
function autenticado() {
    if (isset($_SESSION['auth'])) {
        return true;
    } else {
        return false;
    }
}

function autenticar($senha) {
    if ($senha == '1234') {
        var_dump('autenticado');
        $_SESSION['auth'] = $senha;
    } else {
        var_dump('na na ni na não');
        unset($_SESSION['auth']);
    }
}



#
# index
#
$app->get('/', function ($filtro="") {
    if (autenticado()) {
        require BASE_DIR .  '/templates/home.php';
    } else {
        require BASE_DIR .  '/templates/login.php';
    }
});

#
# login, sing in, logando-se
#
$app->post('/login/', function () use ($app) {
    $request = \Slim\Slim::getInstance()->request();
    $senha =  $request->params('txt-senha');
    // var_dump($senha);
    autenticar($senha);
    $app->redirect('/acs/src');

});

#
# Módulo Poms
#
if (autenticado()) {
    require BASE_DIR . '/poms/Control.php';
}


#
# run, run, run!
#
$app->run();