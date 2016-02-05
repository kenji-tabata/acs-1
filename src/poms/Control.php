<?php

#
# Index
#
$app->get('/poms/(q=:filtro)?', function ($filtro="") {
    require "includes/DBpdo.php";
    require "Model.php";

    $filtro = json_decode($filtro);
    $model = new PomsModel();
    echo json_encode($model->ret_lista_profissionais($model->ret_criterios($filtro)), JSON_UNESCAPED_SLASHES);
});

#
# Create
#
$app->post('/poms/', function () {
    require "includes/DBpdo.php";
    require "Model.php";

    $request = \Slim\Slim::getInstance()->request();
    $profissional = json_decode($request->getBody());
    var_dump($profissional);

    // $model = new PomsModel();
    // $profissional = $model->insert_profissional($profissional);

    // echo json_encode(array('id_profissional' => $profissional->id, 'id_poms' => $profissional->poms_id));
});

#
# Read
#
$app->get('/poms/:id', function ($id) {
    require "includes/DBpdo.php";
    require "Model.php";

    $model = new PomsModel();
    echo json_encode($model->read_profissional($id)[0], JSON_UNESCAPED_SLASHES);
});

#
# Update
#
$app->put('/poms/:id', function ($id) {
    require "includes/DBpdo.php";
    require "Model.php";

    $request = \Slim\Slim::getInstance()->request();
    $profissional = json_decode($request->getBody());
    $profissional->id = $id;
    var_dump($profissional);

    // $model = new PomsModel();
    // $profissional = $model->update_profissional($profissional);

    // echo json_encode(array('profissional' => $profissional->id));
});

#
# Delete
#
$app->delete('/poms/:id', function ($id) {
    require "includes/DBpdo.php";
    require "Model.php";
    
    var_dump($id);

    // $model = new PomsModel();
    // echo json_encode(array('deletado' => $model->deletar_profissional($id)), JSON_UNESCAPED_SLASHES);
});

#
# Relatório individual
#
$app->get('/relatorio/:id', function ($id) {
    require "Relatorio.php";
    require "Profissional.php";
    require "Laudos.php";
    require "Grafico.php";
    require "Calc.php";
    require "RowScore.php";
    require "TScore.php";
    require "Model.php";
    require "includes/DBpdo.php";

    $model = new PomsModel();
    $profissional = $model->read_profissional($id)[0];

    $perfilPoms = Calc::perfilPoms($profissional->adjetivos);
    $grafico    = Grafico::gerar($perfilPoms->tScore, $perfilPoms->rowScore);
    $laudo      = Laudos::laudo($perfilPoms->tScore);

    $relatorio = new Relatorio($profissional, $laudo);
    $relatorio->setGrafico($grafico->getNomeArquivo());
    $relatorio->gerar();

    #
    $relatorio->download($profissional->nome);
    #

    $grafico->deletar_imagem();
});

#
# Relatório em grupo
#
// $app->get('/poms/relatorio/grupo/:id/:id/:id', 'poms_relatorio_foo');

#
# Formulário externo
#
// $app->get('/formulario-poms/', 'poms_formulario_externo');

