<?php

#
# bootstrap
#
date_default_timezone_set ("America/Sao_Paulo");
session_start();

#
# App
#
class App {
    static $slim;
    static $path;
}


App::$slim = new \Slim\Slim();
App::$path = array();

App::$path['base-dir'] = dirname(__FILE__);

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
        //var_dump('autenticado');
        $_SESSION['auth'] = $senha;
    } else {
        //var_dump('nâ na ni na não');
        unset($_SESSION['auth']);
    }
}

#
# Session debug
#
// $_SESSION['auth'] = '';
// unset($_SESSION['auth']);
// var_dump($_SESSION);