<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', 'index');

// POST   http://localhost/person    # para criar um registro (create)
// GET    http://localhost/person/1  # para recuperar um registro (read)
// PUT    http://localhost/person/1  # para atualizar um registro (update)
// DELETE http://localhost/person/1  # para apagar um registro (delete)

#
# Poms
#

// $app->get( '/formulario-poms/',           'poms_formulario_externo');
// $app->get( '/poms/profissionais/listar/', 'poms_profissionais_listar');
// $app->get( '/poms/relatorio/:id',         'poms_relatorio');
// //$app->get( '/poms/relatorio/grupo/:id/:id/:id', 'poms_relatorio_foo');

// $app->post(  '/poms/profissional/',    'poms_profissional_create');
// $app->get(   '/poms/profissional/:id', 'poms_profissional_read');
// $app->put(   '/poms/profissional/:id', 'poms_profissional_update');
// $app->delete('/poms/profissional/:id', 'poms_profissional_delete');

// $app->post(  '/poms/formulario/',    'poms_formulario_create');
$app->get(   '/poms/formulario/',    'poms_formulario_new');
// $app->get(   '/poms/formulario/:id', 'poms_formulario_read');
// $app->put(   '/poms/formulario/:id', 'poms_formulario_update');
// $app->delete('/poms/formulario/:id', 'poms_formulario_delete');

#
# ???
#
// $app->get( '/poms/profissionais/formulario/', 'abrirFormularioPoms');



$app->run();

function index() {
    echo "index";
}

function debug() {
    $request = \Slim\Slim::getInstance()->request();
    $foo = json_decode($request->getBody());
    //var_dump($foo);
    echo json_encode($foo);
}

function poms_formulario_new() {
    require_once "poms/Formulario.php";
    require "poms-formulario-read.php";
    //debug();
}
// require "control/poms.php";
