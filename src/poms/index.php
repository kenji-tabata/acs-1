<?php
require dirname(__FILE__) . '/../../vendor/autoload.php';

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

    echo json_encode(array('id_profissional' => $profissional->id, 'id_poms' => $profissional->poms_id));
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

function poms_relatorio($id) {
    require "Relatorio.php";
    require "Profissional.php";
    require "Laudos.php";
    require "Grafico.php";
    require "Calc.php";
    require "RowScore.php";
    require "TScore.php";
    require "Model.php";
    require "../includes/DBpdo.php";

    $model = new PomsModel();
    $profissional = $model->read_profissional($id)[0];

    $perfilPoms = Calc::perfilPoms($profissional->adjetivos);
    $grafico    = Grafico::gerar($perfilPoms->tScore, $perfilPoms->rowScore);
    $laudo      = Laudos::laudo($perfilPoms->tScore);

    $relatorio = new Relatorio($profissional, $laudo);
    $relatorio->setGrafico($grafico->getNomeArquivo());
    $relatorio->gerar();

    #
    $relatorio->download();
    #

    $grafico->deletar_imagem();
}