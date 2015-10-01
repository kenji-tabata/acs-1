<?php

require_once "poms/Relatorio.php";
require_once "poms/Pesquisado.php";
require_once "poms/Laudo.php";
require_once "poms/Grafico.php";
require_once "poms/TScore.php";
require_once "poms/RowScore.php";


class RelatorioTest extends PHPUnit_Framework_TestCase {
    protected $pesquisado;
    protected $laudo;

    protected function setUp() {

        $this->pesquisado = new Pesquisado();
        $this->pesquisado->nome  = "Fulano";
        $this->pesquisado->cpf   = "111.2222.333.45";
        $this->pesquisado->email = "fulano@qualquer.com.br";
        $this->pesquisado->sexo  = "masculino";

        $this->laudo = new Laudo();
        $this->laudo->laudo01();

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

        $this->grafico = new Grafico();
        $this->grafico->setPontuacao($tScore, $rowScore);
        $this->grafico->setNomeArquivo();
        $this->grafico->setDisplay(Grafico::GRAVAR_NO_DISCO);
        $this->grafico->display();
    }

    public function testGeradorDoRelatorioPoms() {
        $relatorio = new Relatorio($this->pesquisado, $this->laudo);
        $relatorio->setGrafico($this->grafico->getNomeArquivo());
        $relatorio->gerar();
        $relatorio->gravar();

        $this->assertTrue(file_exists($relatorio->getNomeArquivo()));
        $this->relatorio = $relatorio;
    }

    protected function tearDown() {
        // $this->relatorio->deletar_relatorio();
        $this->grafico->deletar_imagem();
    }

}