<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', 'index');

// $app->get('/formulario-poms/',                 'poms_formulario_externo');
// $app->get('/poms/profissionais/listar/',       '');
// $app->get('/poms/relatorio/:id',               'poms_relatorio');
// $app->get('/poms/relatorio/grupo/:id/:id/:id', 'poms_relatorio_foo');

$app->get(   '/formulario',     'poms_formulario_new');

$app->post(  '/formulario/',    'poms_formulario_create');
$app->get(   '/formulario/:id', 'poms_formulario_read');
$app->put(   '/formulario/:id', 'poms_formulario_update');
$app->delete('/formulario/:id', 'poms_formulario_delete');

$app->run();

function debug() {
    $request = \Slim\Slim::getInstance()->request();
    $foo = json_decode($request->getBody());
    //var_dump($foo);
    echo json_encode($foo);
}

function index() {
    require "../poms/Profissional.php";

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

    require "../templates/poms-profissionais-listar.php";
}

function poms_relatorio() {
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


function poms_formulario_new() {
    require_once "../poms/Formulario.php";
    require "../templates/poms-formulario-read.php";
}

function poms_formulario_create() {
    echo json_encode(array('create' => $id));
}
function poms_formulario_read($id) {
    echo json_encode(array('read' => $id));
}
function poms_formulario_update($id) {
    echo json_encode(array('update' => $id));
}
function poms_formulario_delete($id) {
    echo json_encode(array('delete' => $id));
}