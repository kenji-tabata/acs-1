<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get(   '/',    'index');
$app->post(  '/',    'poms_formulario_create'); # c
$app->get(   '/:id', 'poms_formulario_read');   # r
$app->put(   '/:id', 'poms_formulario_update'); # u
$app->delete('/:id', 'poms_formulario_delete'); # d

$app->get('/relatorio/:id', 'poms_relatorio');
// $app->get('/poms/relatorio/grupo/:id/:id/:id', 'poms_relatorio_foo');
// $app->get('/formulario-poms/', 'poms_formulario_externo');

$app->run();

function index() {
    require "../includes/DBpdo.php";
    require "Model.php";

    $model = new PomsModel();
    echo json_encode($model->ret_lista_profissionais(), JSON_UNESCAPED_SLASHES);
}

function poms_formulario_create() {
    require "../includes/DBpdo.php";
    require "Model.php";

    $request = \Slim\Slim::getInstance()->request();
    $profissional = json_decode($request->getBody());

    $model = new PomsModel();
    $profissional = $model->insert_profissional($profissional);

    echo json_encode(array('profissional' => $profissional->id, 'poms' => $profissional->poms_id));
}

function poms_formulario_read($id) {
    require "../includes/DBpdo.php";
    require "Model.php";

    $model = new PomsModel();
    echo json_encode($model->read_profissional($id)[0], JSON_UNESCAPED_SLASHES);
}

function poms_formulario_update($id) {
    require "../includes/DBpdo.php";
    require "Model.php";

    $request = \Slim\Slim::getInstance()->request();
    $profissional = json_decode($request->getBody());
    $profissional->id = $id;

    $model = new PomsModel();
    $profissional = $model->update_profissional($profissional);

    echo json_encode(array('profissional' => $profissional->id));
}

function poms_formulario_delete($id) {
    require "../includes/DBpdo.php";
    require "Model.php";

    $model = new PomsModel();
    echo json_encode(array('deletado' => $model->deletar_profissional($id)), JSON_UNESCAPED_SLASHES);
}

function poms_relatorio() {
    require_once "Relatorio.php";
    require_once "Profissional.php";
    require_once "Laudos.php";
    require_once "Grafico.php";
    require_once "Calc.php";
    require_once "RowScore.php";
    require_once "TScore.php";

    $prof = new Profissional();
    $prof->nome  = "Fulano";
    $prof->cpf   = "111.2222.333.45";
    $prof->email = "fulano@qualquer.com.br";
    $prof->sexo  = "masculino";

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

    $relatorio = new Relatorio($prof, $laudo);
    $relatorio->setGrafico($grafico->getNomeArquivo());
    $relatorio->gerar();

    #
    $relatorio->download();
    #

    $grafico->deletar_imagem();
}