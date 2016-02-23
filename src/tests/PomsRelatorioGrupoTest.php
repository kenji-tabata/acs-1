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

        # perfil
        $tScore = new TScore();
        $tScore->tensao    = 50;
        $tScore->depressao = 50;
        $tScore->raiva     = 50;
        $tScore->vigor     = 80;
        $tScore->fadiga    = 50;
        $tScore->confusao  = 50;

        $rowScore = new RowScore();
        $rowScore->tensao    = 5;
        $rowScore->depressao = 5;
        $rowScore->raiva     = 5;
        $rowScore->vigor     = 8;
        $rowScore->fadiga    = 5;
        $rowScore->confusao  = 5;

        # profissional
        $this->profissional = new Profissional();
        $this->profissional->nome   = "Fulano";
        $this->profissional->cpf    = "111.2222.333.45";
        $this->profissional->email  = "fulano@qualquer.com.br";
        $this->profissional->genero = "masculino";

        $this->profissional->perfil  = "TScore + RowScore";
        // $this->profissional->grafico = new Grafico();
        // $this->profissional->laudo   = new Laudos;

        // $this->profissional->grafico = Grafico::gerar($tScore, $rowScore);
        $this->profissional->laudo   = Laudos::laudo($tScore);

        $this->grupo[] = $this->profissional;

    }

    public function testGeradorDoRelatorioGrupoPoms() {

        $relatorio = new RelatorioGrupo();
        foreach ($this->grupo as $profissional) {
             $relatorio->add($profissional);
        }

        $relatorio->setMedia();
        $relatorio->gerar();
        $relatorio->gravar();

        // $this->assertTrue(file_exists($relatorio->getNomeArquivo()));
        // $this->relatorio = $relatorio;        

    }



}