<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/'   , 'get');
$app->post('/'  , 'post');
$app->put('/'   , 'put');
$app->delete('/', 'delete');

$app->run();

function get() {
    require_once "poms/Relatorio.php";
    require_once "poms/Pesquisado.php";
    require_once "poms/Laudos.php";
    require_once "poms/Grafico.php";
    require_once "poms/TScore.php";
    require_once "poms/RowScore.php";

    $pesquisado = new Pesquisado();
    $pesquisado->nome  = "Fulano";
    $pesquisado->cpf   = "111.2222.333.45";
    $pesquisado->email = "fulano@qualquer.com.br";
    $pesquisado->sexo  = "masculino";

    $tScore = new TScore();
    $tScore->tensao    = 46;
    $tScore->depressao = 40;
    $tScore->raiva     = 40;
    $tScore->vigor     = 80;
    $tScore->fadiga    = 40;
    $tScore->confusao  = 51;

    $rowScore = new RowScore();
    $rowScore->tensao    = 4;
    $rowScore->depressao = 0;
    $rowScore->raiva     = 0;
    $rowScore->vigor     = 37;
    $rowScore->fadiga    = 0;
    $rowScore->confusao  = 4;

    $grafico = new Grafico();
    $grafico->setPontuacao($tScore, $rowScore);
    $grafico->setNomeArquivo();
    $grafico->setDisplay(Grafico::GRAVAR_NO_DISCO);
    $grafico->display();

    $laudo = new Laudos;
    $laudo->descobrir($tScore); 

    $relatorio = new Relatorio($pesquisado, $laudo);
    $relatorio->setGrafico($grafico->getNomeArquivo());
    $relatorio->gerar();
    $relatorio->download();
    echo "get\n";
}

function post() {
    echo "post";
}

function put() {
    echo "put";
}

function delete() {
    echo "delete";
}