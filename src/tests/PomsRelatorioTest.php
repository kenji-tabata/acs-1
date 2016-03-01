<?php

require_once dirname(__FILE__) . "/../poms/Relatorio.php";
require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/Laudos.php";
require_once dirname(__FILE__) . "/../poms/Grafico.php";
require_once dirname(__FILE__) . "/../poms/TScore.php";
require_once dirname(__FILE__) . "/../poms/RowScore.php";


class RelatorioTest extends PHPUnit_Framework_TestCase {
    protected $profissional;
    protected $laudos;

    protected function setUp() {

        $this->profissional = new Profissional();
        $this->profissional->nome   = "Fulano";
        $this->profissional->cpf    = "111.2222.333.45";
        $this->profissional->email  = "fulano@qualquer.com.br";
        $this->profissional->genero = "masculino";

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

        $this->profissional->laudo   = Laudos::laudo($tScore);
        $this->profissional->grafico = Grafico::gerar($tScore, $rowScore);

    }
    
    public function testRealtorioFabricar() {
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudo1() {
        $this->profissional->laudo->laudo01();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudo2() {
        $this->profissional->laudo->laudo02();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudo3() {
        $this->profissional->laudo->laudo03();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudo4() {
        $this->profissional->laudo->laudo04();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudo5() {
        $this->profissional->laudo->laudo05();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudo6() {
        $this->profissional->laudo->laudo06();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudo7() {
        $this->profissional->laudo->laudo07();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    public function testSeRenderizaLaudoDesconhecido() {
        $this->profissional->laudo->laudoDesconhecido();
        $this->relatorio = Relatorio::fabricar($this->profissional);
    }

    protected function tearDown() {
        $this->relatorio->deletar();
        $this->profissional->grafico->deletar_imagem();
    }

}