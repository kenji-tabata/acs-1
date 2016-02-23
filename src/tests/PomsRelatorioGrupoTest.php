<?php

require_once dirname(__FILE__) . "/../poms/RelatorioGrupo.php";
require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/Laudos.php";
require_once dirname(__FILE__) . "/../poms/Grafico.php";
require_once dirname(__FILE__) . "/../poms/TScore.php";
require_once dirname(__FILE__) . "/../poms/RowScoreMedio.php";


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
        $rowScore = new RowScore();
        $rowScore->tensao    = 12;
        $rowScore->depressao = 20;
        $rowScore->raiva     = 16;
        $rowScore->vigor     = 19;
        $rowScore->fadiga    = 10;
        $rowScore->confusao  = 8;

        $tScore = new TScore();
        $tScore->tensao    = 60;
        $tScore->depressao = 60;
        $tScore->raiva     = 60;
        $tScore->vigor     = 60;
        $tScore->fadiga    = 60;
        $tScore->confusao  = 60;

        $this->profissional->rowScore  = $rowScore;
        $this->profissional->grafico = Grafico::gerar($tScore, $rowScore);
        $this->profissional->laudo   = Laudos::laudo($tScore);
        $this->grupo[] = clone $this->profissional;


        # profissional 2
        $rowScore = new RowScore();
        $rowScore->tensao    = 24;
        $rowScore->depressao = 40;
        $rowScore->raiva     = 32;
        $rowScore->vigor     = 37;
        $rowScore->fadiga    = 20;
        $rowScore->confusao  = 16;

        $tScore = new TScore();
        $tScore->tensao    = 80;
        $tScore->depressao = 80;
        $tScore->raiva     = 80;
        $tScore->vigor     = 80;
        $tScore->fadiga    = 82;
        $tScore->confusao  = 80;

        $this->profissional->rowScore  = $rowScore;
        $this->profissional->grafico = Grafico::gerar($tScore, $rowScore);
        $this->profissional->laudo   = Laudos::laudo($tScore);
        $this->grupo[] = clone $this->profissional;
    }

    public function testGeradorDoRelatorioGrupoPoms() {

        $relatorio = new RelatorioGrupo($this->grupo);
        
        $rowScore = new RowScoreMedio();
        $rowScore->calcular($this->grupo);

        $tScore = new TScore();
        $tScore->converterParaTScore($rowScore);

        $grafico = Grafico::gerar($tScore, $rowScore);
        $relatorio->setGrafico($grafico->getNomeArquivo());        

        $relatorio->gerar();
        $relatorio->gravar();

        $this->assertTrue(file_exists($relatorio->getNomeArquivo()));
        // $relatorio->deletar_relatorio();
        $grafico->deletar_imagem();

    }

}