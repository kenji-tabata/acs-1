<?php

#
# Index
#
App::$slim->get('/poms/(q=:filtro)?', function ($filtro="") {
    require "includes/DBpdo.php";
    require "Model.php";

    $filtro = json_decode($filtro);
    // var_dump($filtro);
    $model = new PomsModel();
    echo json_encode($model->ret_lista_profissionais($model->ret_criterios($filtro)), JSON_UNESCAPED_SLASHES);
});

#
# Create
#
App::$slim->post('/poms/', function () {
    require "includes/DBpdo.php";
    require "Model.php";

    $request = \Slim\Slim::getInstance()->request();
    $profissional = json_decode($request->getBody());
    // var_dump($profissional);

    $model = new PomsModel();
    $profissional = $model->insert_profissional($profissional);

    echo json_encode(array('id_profissional' => $profissional->id, 'id_poms' => $profissional->poms_id));
});

#
# Read
#
App::$slim->get('/poms/:id', function ($id) {
    require "includes/DBpdo.php";
    require "Model.php";

    $model = new PomsModel();
    $profissionais = $model->read_profissional($id);
    echo json_encode($profissionais[0], JSON_UNESCAPED_SLASHES);
});

#
# Update
#
App::$slim->put('/poms/:id', function ($id) {
    require "includes/DBpdo.php";
    require "Model.php";

    $request = \Slim\Slim::getInstance()->request();
    $profissional = json_decode($request->getBody());
    $profissional->id = $id;
    // var_dump($profissional);

    $model = new PomsModel();
    $profissional = $model->update_profissional($profissional);

    echo json_encode(array('profissional' => $profissional->id));
});

#
# Delete
#
App::$slim->delete('/poms/:id', function ($id) {
    require "includes/DBpdo.php";
    require "Model.php";

    // var_dump($id);

    $model = new PomsModel();
    echo json_encode(array('deletado' => $model->deletar_profissional($id)), JSON_UNESCAPED_SLASHES);
});

#
# Relatório individual
#
App::$slim->get('/poms/relatorio/:id', function ($id) {
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
    $profissionais = $model->read_profissional($id);
    $profissional  = $profissionais[0];

    $profissional->poms    = Calc::perfilPoms($profissional->adjetivos);
    $profissional->grafico = Grafico::gerar($profissional->poms->tScore, $profissional->poms->rowScore);
    $profissional->laudo   = Laudos::laudo($profissional->poms->tScore);

    $relatorio = Relatorio::fabricar($profissional);
    $relatorio->download($profissional->nome);
    $profissional->grafico->deletar_imagem();

});

# Relatório em grupo
#
# POST http://localhost/acs/src/poms/relatorio/grupo
# ids[]=1&ids[]=2
# ids=[1, 2, 3]
App::$slim->post('/poms/relatorio/grupo', function () {
    $request = \Slim\Slim::getInstance()->request();
    var_dump($request->post('ids'));
    var_dump(json_decode($request->post('ids')));
});

#
# Formulário externo
#
// App::$slim->get('/formulario-poms/', 'poms_formulario_externo');