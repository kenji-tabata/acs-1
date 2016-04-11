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
    echo json_encode($model->ret_lista_profissionais($model->ret_criterios($filtro)));
    // echo json_encode($model->ret_lista_profissionais($model->ret_criterios($filtro)), JSON_UNESCAPED_SLASHES);
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
    $profissional = $model->read_profissional($id);
    echo json_encode($profissional, JSON_UNESCAPED_SLASHES);
    //var_dump($model->read_profissional($id));
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
    $profissional = $model->read_profissional($id);

    $profissional->poms    = Calc::perfilPoms($profissional->adjetivos);
    $profissional->grafico = Grafico::gerar($profissional->poms->tScore, $profissional->poms->rowScore);
    $profissional->laudo   = Laudos::laudo($profissional->poms->tScore);

    $relatorio = Relatorio::fabricar($profissional);
    $relatorio->download($profissional->nome);
    $profissional->grafico->deletar_imagem();

});

#
# Relatório em grupo
#
# POST http://localhost/acs/src/poms/relatorio/grupo
# /poms/relatorio/grupo/[14, 15, 18]
App::$slim->get('/poms/relatorio/grupo/:ids', function ($ids) {
    require "Grupo.php";    
    require "RelatorioGrupo.php";
    // require "Laudos.php";
    // require "Grafico.php";
    // require "Calc.php";
    // require "RowScore.php";
    // require "RowScoreMedio.php";
    // require "TScore.php";
    // require "Model.php";
    // require "includes/DBpdo.php";

    // var_dump(json_decode($ids));

    $grupo = new Grupo;
    $grupo = $grupo->factory(json_decode($ids));
    
    // foreach ($ids as $id) {
    //     $model = new PomsModel();
    //     $profissional = $model->read_profissional($id);
    //     $profissional->poms     = Calc::perfilPoms($profissional->adjetivos);
    //     $profissional->tScore   = $profissional->poms->tScore;
    //     $profissional->rowScore = $profissional->poms->rowScore;
    //     $profissional->grafico  = Grafico::gerar($profissional->poms->tScore, $profissional->poms->rowScore);
    //     $profissional->laudo    = Laudos::laudo($profissional->poms->tScore);
    //     $grupo->add($profissional);
    // }
    // // var_dump($grupo);    

    // $grupo->rowScore = new RowScoreMedio();
    // $grupo->rowScore->calcular($grupo->get());
    // $grupo->tScore = new TScore();
    // $grupo->tScore->converterParaTScore($grupo->rowScore);
    // $grupo->grafico = Grafico::gerar($grupo->tScore, $grupo->rowScore);
    // // var_dump($grupo);

    $relatorio = new RelatorioGrupo($grupo);
    $relatorio->setGrafico($grupo->grafico->getNomeArquivo());
    $relatorio->gerar();

    $relatorio->download('relatorio-em-grupo');

    // $relatorio->gravar();
    // $relatorio->deletar();
    $grupo->grafico->deletar();

});

#
# Relatório em grupo - word
#
# POST http://localhost/acs/src/poms/relatorio/grupo/word
# /poms/relatorio/grupo/word[14, 15, 18]
App::$slim->get('/poms/relatorio/grupo/word/:ids', function ($ids) {
    require "Grupo.php";    

    $grupo = new Grupo;
    $grupo = $grupo->factory(json_decode($ids));
    // var_dump($grupo);

    require "RelatorioGrupoWord.php";



});

#
#
#
App::$slim->get('/poms/graficos/:nome_img', function ($nome_img) {
    // require "Model.php";

    $url = App::$path['base-dir'] . '/files-temp/' . "/570be7e8c2b03.png";
    // var_dump($file);

     if (file_exists($url)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: inline; filename="'.basename($url).'"' );
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($url));
          
          readfile($url);
          exit;
      }

});

#
# Formulário externo
#
// App::$slim->get('/formulario-poms/', 'poms_formulario_externo');