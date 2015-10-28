<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get( '/', 'index');
$app->get( '/poms/profissionais/listar/',     'listarProfissionaisPoms');
$app->get( '/poms/profissionais/formulario/', 'abrirFormularioPoms');
$app->get( '/poms/formulario/',               'formularioEmBranco');
$app->post('/poms/formulario/salvar/',        'salvarFormulario');

# formulário poms externo
$app->get( '/formulario-poms/',               'formularioPomsExterno');

// POST   http://localhost/person    # para criar um registro (create)
// GET    http://localhost/person/1  # para recuperar um registro (read)
// PUT    http://localhost/person/1  # para atualizar um registro (update)
// DELETE http://localhost/person/1  # para apagar um registro (delete)

# API rest profissional
$app->post(  '/poms/profissional/',    'profissionaisCreate');
$app->get(   '/poms/profissional/',    'profissionaisRead');
$app->put(   '/poms/profissional/:id', 'profissionaisUpdate');
$app->delete('/poms/profissional/:id', 'profissionaisDelete');

# API rest preenchimento
$app->post(  '/poms/preencher/',    'preenchPomsCreate');
$app->get(   '/poms/preencher/:id', 'preenchPomsRead');
$app->put(   '/poms/preencher/:id', 'preenchPomsUpdate');
$app->delete('/poms/preencher/:id', 'preenchPomsDelete');

$app->run();

function index() {
    echo "index";
}

function emitir_formulario() {
    require_once "poms/Relatorio.php";
    require_once "poms/Pesquisado.php";
    require_once "poms/Laudos.php";
    require_once "poms/Grafico.php";
    require_once "poms/Calc.php";
    require_once "poms/RowScore.php";
    require_once "poms/TScore.php";

    $pesquisado = new Pesquisado();
    $pesquisado->nome  = "Fulano";
    $pesquisado->cpf   = "111.2222.333.45";
    $pesquisado->email = "fulano@qualquer.com.br";
    $pesquisado->sexo  = "masculino";

    $alternativasEscolhidas = "1-1, 2-1, 3-1, 4-1, 5-1, 6-1, 7-1, 8-1, 9-1, 10-1, "
        . "11-1, 12-1, 13-1, 14-1, 15-1, 16-1, 17-1, 18-1, 19-1, 20-1,"
        . "21-1, 22-1, 23-1, 24-1, 25-1, 26-1, 27-1, 28-1, 29-1, 30-1,"
        . "31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-1, 39-1, 40-1,"
        . "41-1, 42-1, 43-1, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1,"
        . "51-1, 52-1, 53-1, 54-1, 55-1, 56-1, 57-1, 58-1, 59-1, 60-1,"
        . "61-1, 62-1, 63-1, 64-1, 65-1";

    $perfilPoms = Calc::perfilPoms($alternativasEscolhidas);
    $grafico    = Grafico::gerar($perfilPoms->tScore, $perfilPoms->rowScore);
    $laudo      = Laudos::laudo($perfilPoms->tScore);

    $relatorio = new Relatorio($pesquisado, $laudo);
    $relatorio->setGrafico($grafico->getNomeArquivo());
    $relatorio->gerar();

    #
    # $relatorio->download();
    #

    $grafico->deletar_imagem();
    echo "get\n";
}

function formularioEmBranco() {
    require_once "poms/Formulario.php";
    require "poms-formulario-interno.php";
}

function salvarFormulario() {
    $app = new \Slim\Slim();
    var_dump($app->request->post('nome'));
    var_dump($app->request->post('email'));
    var_dump($app->request->post('cpf'));
    var_dump($app->request->post('genero'));
    var_dump($app->request->post('depois-de-salvar'));
    var_dump($app->request->post('adjetivos'));
}


function listarProfissionaisPoms() {
    require "poms/Profissional.php";
    
    $profis = new Profissional();
    $profis->nome   = "Fulano";
    $profis->email  = "fulano@email";
    $profis->cpf    = "123.456.789.99";
    $profis->genero = "m";

    $profissionais = array();
    
    $profis->id      = 100;
    $profissionais[] = clone $profis;

    $profis->id      = 200;
    $profissionais[] = clone $profis;

    $profis->id      = 300;
    $profissionais[] = clone $profis;

    $profis->id      = 400;
    $profissionais[] = clone $profis;
    // var_dump($profissionais);


    require "poms-lista-profissionais.php";
}

function abrirFormularioPoms() {
    require_once "poms/Formulario.php";
    require "poms-formulario-interno.php";
}

function formularioPomsExterno() {
    echo "formularioPomsExterno";
    require "poms-formulario-externo.php";
}


#
# API para profissionais
#
function profissionaisCreate() {
    $request = \Slim\Slim::getInstance()->request();
    $profissionais = json_decode($request->getBody());
    //var_dump($profissionais);
    echo json_encode($profissionais);
}

function profissionaisRead() {
    echo "profissionais-Read";
}

function profissionaisUpdate() {
    echo "profissionais-Update";
}

function profissionaisDelete() {
    echo "profissionais-Delete";
}


#
# API para preenchimento do formulário POMS
#
function preenchPomsCreate() {
    $request = \Slim\Slim::getInstance()->request();
    $preenhc = json_decode($request->getBody());
    //var_dump($preenhc);
    echo json_encode($preenhc);
}

function preenchPomsRead() {
    echo "preench-Poms-Read";
}

function preenchPomsUpdate() {
    $request = \Slim\Slim::getInstance()->request();
    $preenhc = json_decode($request->getBody());
    //var_dump($preenhc);
    echo json_encode($preenhc);
}

function preenchPomsDelete() {
    echo "preench-Poms-Delete";
}