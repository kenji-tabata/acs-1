<?php

require_once dirname(__FILE__) . "/../poms/RelatorioGrupo.php";
require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/Laudos.php";
require_once dirname(__FILE__) . "/../poms/Grafico.php";
require_once dirname(__FILE__) . "/../poms/TScore.php";
require_once dirname(__FILE__) . "/../poms/RowScore.php";


class RelatorioGrupoTest extends PHPUnit_Framework_TestCase {
    protected $profissionais;
    protected $laudos;

    protected function setUp() {

        $this->grupo = [];

        # profissional padrão
        $this->profissional = new Profissional();
        $this->profissional->nome   = "Fulano";
        $this->profissional->cpf    = "111.2222.333.45";
        $this->profissional->email  = "fulano@qualquer.com.br";
        $this->profissional->genero = "masculino";


        # profissional 1
        $tScore = new TScore();
        $tScore->tensao    = 50;
        $tScore->depressao = 50;
        $tScore->raiva     = 50;
        $tScore->vigor     = 80;
        $tScore->fadiga    = 50;
        $tScore->confusao  = 50;

        $rowScore = new RowScore();
        $rowScore->tensao    = 15;
        $rowScore->depressao = 15;
        $rowScore->raiva     = 15;
        $rowScore->vigor     = 15;
        $rowScore->fadiga    = 15;
        $rowScore->confusao  = 15;

        $this->profissional->rowScore  = $rowScore;
        $this->profissional->grafico = Grafico::gerar($tScore, $rowScore);
        $this->profissional->laudo   = Laudos::laudo($tScore);
        $this->grupo[] = clone $this->profissional;


        # profissional 2
        $tScore = new TScore();
        $tScore->tensao    = 60;
        $tScore->depressao = 60;
        $tScore->raiva     = 60;
        $tScore->vigor     = 70;
        $tScore->fadiga    = 60;
        $tScore->confusao  = 60;

        $rowScore = new RowScore();
        $rowScore->tensao    = 15;
        $rowScore->depressao = 15;
        $rowScore->raiva     = 15;
        $rowScore->vigor     = 15;
        $rowScore->fadiga    = 15;
        $rowScore->confusao  = 15;

        $this->profissional->rowScore  = $rowScore;
        $this->profissional->grafico = Grafico::gerar($tScore, $rowScore);
        $this->profissional->laudo   = Laudos::laudo($tScore);
        $this->grupo[] = clone $this->profissional;
    }

    public function testGeradorDoRelatorioGrupoPoms() {

        $relatorio = new RelatorioGrupo($this->grupo);
        $rowScore = $relatorio->retRowScoreMedio();

        // $this->profissional->grafico = Grafico::gerar($tScore, $rowScore);

        $relatorio->gerar();
        // $relatorio->setGrafico($this->grafico->getNomeArquivo());        
        $relatorio->gravar();

        $this->assertTrue(file_exists($relatorio->getNomeArquivo()));
        // $relatorio->deletar_relatorio();

    }

    public function testSetMedia() {

        $relatorio = new RelatorioGrupo($this->grupo);
        $rowScore = $relatorio->retRowScoreMedio();

        $this->assertEquals(15, $rowScore->tensao);
        $this->assertEquals(15, $rowScore->depressao);
        $this->assertEquals(15, $rowScore->raiva);
        $this->assertEquals(15, $rowScore->vigor);
        $this->assertEquals(15, $rowScore->fadiga);
        $this->assertEquals(15, $rowScore->confusao);


    }

}