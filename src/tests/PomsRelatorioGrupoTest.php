<?php

require_once dirname(__FILE__) . "/../poms/RelatorioGrupo.php";
require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/Grupo.php";
require_once dirname(__FILE__) . "/../poms/Laudos.php";
require_once dirname(__FILE__) . "/../poms/Grafico.php";
require_once dirname(__FILE__) . "/../poms/TScore.php";
require_once dirname(__FILE__) . "/../poms/RowScoreMedio.php";


class RelatorioGrupoTest extends PHPUnit_Framework_TestCase {
    protected $grupo;

    function mockProfissional01() {
        $profissional = new Profissional();
        $profissional->nome   = "Fulano 1";
        $profissional->cpf    = "111.222.333.45";
        $profissional->email  = "fulano1@qualquer.com.br";
        $profissional->genero = "masculino";

        $profissional->rowScore = new RowScore();
        $profissional->rowScore->tensao    = 12;
        $profissional->rowScore->depressao = 20;
        $profissional->rowScore->raiva     = 16;
        $profissional->rowScore->vigor     = 19;
        $profissional->rowScore->fadiga    = 10;
        $profissional->rowScore->confusao  = 8;

        $profissional->tScore = new TScore();
        $profissional->tScore->tensao    = 60;
        $profissional->tScore->depressao = 60;
        $profissional->tScore->raiva     = 60;
        $profissional->tScore->vigor     = 60;
        $profissional->tScore->fadiga    = 60;
        $profissional->tScore->confusao  = 60;

        $profissional->grafico = Grafico::gerar($profissional->tScore, $profissional->rowScore);
        $profissional->laudo   = Laudos::laudo($profissional->tScore);

        return $profissional;
    }

    function mockProfissional02() {
        $profissional = new Profissional();
        $profissional->nome   = "Fulano 2";
        $profissional->cpf    = "666.777.888.99";
        $profissional->email  = "fulano2@qualquer.com.br";
        $profissional->genero = "feminino";

        $profissional->rowScore = new RowScore();
        $profissional->rowScore->tensao    = 24;
        $profissional->rowScore->depressao = 40;
        $profissional->rowScore->raiva     = 32;
        $profissional->rowScore->vigor     = 37;
        $profissional->rowScore->fadiga    = 20;
        $profissional->rowScore->confusao  = 16;

        $profissional->tScore = new TScore();
        $profissional->tScore->tensao    = 80;
        $profissional->tScore->depressao = 80;
        $profissional->tScore->raiva     = 80;
        $profissional->tScore->vigor     = 80;
        $profissional->tScore->fadiga    = 82;
        $profissional->tScore->confusao  = 80;

        $profissional->grafico = Grafico::gerar($profissional->tScore, $profissional->rowScore);
        $profissional->laudo   = Laudos::laudo($profissional->tScore);

        return $profissional;
    }

    protected function setUp() {
        $this->grupo = new Grupo;
        $this->grupo->add($this->mockProfissional02());
        $this->grupo->add($this->mockProfissional01());

        $this->grupo->rowScore = new RowScoreMedio();
        $this->grupo->rowScore->calcular($this->grupo->get());

        $this->grupo->tScore = new TScore();
        $this->grupo->tScore->converterParaTScore($this->grupo->rowScore);

        $this->grupo->grafico = Grafico::gerar($this->grupo->tScore, $this->grupo->rowScore);
    }

    public function testGeradorDoRelatorioGrupoPoms() {
        $relatorio = new RelatorioGrupo($this->grupo);
        $relatorio->setGrafico($this->grupo->grafico->getNomeArquivo());
        $relatorio->gerar();
        $relatorio->gravar();

        $this->assertTrue(file_exists($relatorio->getNomeArquivo()));
        
        $relatorio->deletar();
        $this->grupo->grafico->deletar();
    }

}