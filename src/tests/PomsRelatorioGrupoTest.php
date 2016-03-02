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

        # profissional 1
        $this->profissional = new Profissional();
        $this->profissional->nome   = "Fulano 1";
        $this->profissional->cpf    = "111.222.333.45";
        $this->profissional->email  = "fulano1@qualquer.com.br";
        $this->profissional->genero = "masculino";

        $this->profissional->rowScore = new RowScore();
        $this->profissional->rowScore->tensao    = 12;
        $this->profissional->rowScore->depressao = 20;
        $this->profissional->rowScore->raiva     = 16;
        $this->profissional->rowScore->vigor     = 19;
        $this->profissional->rowScore->fadiga    = 10;
        $this->profissional->rowScore->confusao  = 8;

        $this->profissional->tScore = new TScore();
        $this->profissional->tScore->tensao    = 60;
        $this->profissional->tScore->depressao = 60;
        $this->profissional->tScore->raiva     = 60;
        $this->profissional->tScore->vigor     = 60;
        $this->profissional->tScore->fadiga    = 60;
        $this->profissional->tScore->confusao  = 60;

        $this->profissional->grafico = Grafico::gerar($this->profissional->tScore, $this->profissional->rowScore);
        $this->profissional->laudo   = Laudos::laudo($this->profissional->tScore);
        $this->grupo[] = $this->profissional;

        # profissional 2
        $this->profissional = new Profissional();
        $this->profissional->nome   = "Fulano 2";
        $this->profissional->cpf    = "666.777.888.99";
        $this->profissional->email  = "fulano2@qualquer.com.br";
        $this->profissional->genero = "feminino";

        $this->profissional->rowScore = new RowScore();
        $this->profissional->rowScore->tensao    = 24;
        $this->profissional->rowScore->depressao = 40;
        $this->profissional->rowScore->raiva     = 32;
        $this->profissional->rowScore->vigor     = 37;
        $this->profissional->rowScore->fadiga    = 20;
        $this->profissional->rowScore->confusao  = 16;

        $this->profissional->tScore = new TScore();
        $this->profissional->tScore->tensao    = 80;
        $this->profissional->tScore->depressao = 80;
        $this->profissional->tScore->raiva     = 80;
        $this->profissional->tScore->vigor     = 80;
        $this->profissional->tScore->fadiga    = 82;
        $this->profissional->tScore->confusao  = 80;

        $this->profissional->grafico  = Grafico::gerar($this->profissional->tScore, $this->profissional->rowScore);
        $this->profissional->laudo    = Laudos::laudo($this->profissional->tScore);
        $this->grupo[] = $this->profissional;
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
        //$relatorio->deletar_relatorio();
        $grafico->deletar_imagem();

    }

}