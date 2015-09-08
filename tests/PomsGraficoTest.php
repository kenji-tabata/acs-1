<?php

require_once "poms/Grafico.php";
require_once "poms/TScore.php";
require_once "poms/RowScore.php";

class GraficoTest extends PHPUnit_Framework_TestCase {

    public function testGeradorDeGraficoPoms() {

        $graf = new Grafico();

        $graf->setPontuacao(new TScore(), new RowScore());
        $graf->setNomeArquivo();
        $graf->setDisplay(Grafico::GRAVAR_NO_DISCO);
        $graf->display(Grafico::GRAVAR_NO_DISCO);

        $this->assertTrue(file_exists($graf->getNomeArquivo()));
        $graf->deletar_imagem();
        
    }

}