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

        $this->profissional->tScore = new TScore();
        $this->profissional->tScore->tensao    = 46;
        $this->profissional->tScore->depressao = 40;
        $this->profissional->tScore->raiva     = 40;
        $this->profissional->tScore->vigor     = 80;
        $this->profissional->tScore->fadiga    = 40;
        $this->profissional->tScore->confusao  = 51;

        $this->profissional->rowScore = new RowScore();
        $this->profissional->rowScore->tensao    = 4;
        $this->profissional->rowScore->depressao = 0;
        $this->profissional->rowScore->raiva     = 0;
        $this->profissional->rowScore->vigor     = 37;
        $this->profissional->rowScore->fadiga    = 0;
        $this->profissional->rowScore->confusao  = 4;

        $this->profissional->laudo   = Laudos::laudo($this->profissional->tScore);
        $this->profissional->grafico = Grafico::gerar($this->profissional->tScore, $this->profissional->rowScore);

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