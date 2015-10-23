<?php

require_once "poms/Grafico.php";
require_once "poms/TScore.php";
require_once "poms/RowScore.php";

class GraficoTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->tScore = new TScore();
        $this->tScore->tensao    = 46;
        $this->tScore->depressao = 40;
        $this->tScore->raiva     = 40;
        $this->tScore->vigor     = 80;
        $this->tScore->fadiga    = 40;
        $this->tScore->confusao  = 51;

        $this->rowScore = new RowScore();
        $this->rowScore->tensao    = 4;
        $this->rowScore->depressao = 0;
        $this->rowScore->raiva     = 0;
        $this->rowScore->vigor     = 37;
        $this->rowScore->fadiga    = 0;
        $this->rowScore->confusao  = 4;
    }

    public function testGerar() {
        $grafico = Grafico::gerar($this->tScore, $this->rowScore);
        $this->assertTrue(file_exists($grafico->getNomeArquivo()));
        $this->grafico = $grafico;
    }

    protected function tearDown() {
        $this->grafico->deletar_imagem();
    }

}