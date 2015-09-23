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
        $this->laudo->titulo_a1 = "Parecer Psicológico";
        $this->laudo->titulo_a2 = "Estado de Humor / Ánimo Ótimo - ";
        $this->laudo->titulo_a3 = "'Perfil Iceberg' - ao lado";
        $this->laudo->corpo    = "Indica que a pessoa avaliada apresenta um Estados de Humor/ Ánimo com índices de energias "
            . "afetivas dentro da média populacional e com disposição para agir e lidar normalmente para "
            . "levar adiante suas atividades pessoais e profissionais. Indica que os seis fatores "
            . "(vigor-afetividade, tensão-ansiedade, depressao-melancolia; agressividade-cólera, "
            . "fadiga-inércia e confusão-desorientação) que constituem o \"Perfil Iceberg\" estão com índices "
            . "de energias afetivas relacionais capazes de levar a pessoa a manter um padrão de comportamento "
            . "caracterizado por autodomínio, autoconfiança e autonomia de competência para superar obstáculos "
            . "impelida por estados de ánimo/humor estáveis e com pouca oscilação. De uma pessoa confiante, "
            . "animada e produtiva com impulso competitivo, determinada a fazer com que as coisas aconteçam. "
            . "Esse Perfil Iceberg representa que a pessoa está agindo normalmente ao fazer as coisas no seu "
            . "dia-a-dia e adaptando-se às condições de mudanças no meio social ambiental e com impulso para "
            . "tomar decisões, assumir riscos visando melhor aproveitamento do seu perfil pessoal e profissional.";

        $this->grafico = new Grafico();
        $this->grafico->setPontuacao(new TScore(), new RowScore());
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
        $relatorio->deletar_relatorio();
        $this->grafico->deletar_imagem();
    }

}