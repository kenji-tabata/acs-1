<?php

class IntegracaoTest extends PHPUnit_Framework_TestCase {
    protected function setUp() {
        $this->root = dirname(__FILE__);
    }

    public function testSeArquivoDeFontesParaPDfExiste() {
        $this->assertTrue(file_exists($this->root . "/../fonts/arial.ttf"));
    }

    public function testSePastaFilesTempExiste() {
        $this->assertTrue(file_exists($this->root . "/../files-temp/"));
    }

    public function testHaPermissaoDeEscreitaNaPastaFilesTemp() {
        $this->assertTrue(is_writable($this->root . "/../files-temp/"));
    }

    public function testCalculoPerfilPoms() {
        require_once $this->root . "/../poms/Calc.php";
        require_once $this->root . "/../poms/RowScore.php";
        require_once $this->root . "/../poms/TScore.php";

        $alternativasEscolhidas = "1-1, 2-1, 3-1, 4-1, 5-1, 6-1, 7-1, 8-1, 9-1, 10-1, "
            . "11-1, 12-1, 13-1, 14-1, 15-1, 16-1, 17-1, 18-1, 19-1, 20-1,"
            . "21-1, 22-1, 23-1, 24-1, 25-1, 26-1, 27-1, 28-1, 29-1, 30-1,"
            . "31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-1, 39-1, 40-1,"
            . "41-1, 42-1, 43-1, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1,"
            . "51-1, 52-1, 53-1, 54-1, 55-1, 56-1, 57-1, 58-1, 59-1, 60-1,"
            . "61-1, 62-1, 63-1, 64-1, 65-1";

        $perfilPoms = Calc::perfilPoms($alternativasEscolhidas);

    }

    public function testEmissaoRelatorioPoms() {
        require_once $this->root . "/../poms/Relatorio.php";
        require_once $this->root . "/../poms/Profissional.php";
        require_once $this->root . "/../poms/Laudos.php";
        require_once $this->root . "/../poms/Grafico.php";
        require_once $this->root . "/../poms/Calc.php";
        require_once $this->root . "/../poms/RowScore.php";
        require_once $this->root . "/../poms/TScore.php";

        $profissional = new Profissional();
        $profissional->nome  = "Fulano";
        $profissional->cpf   = "111.2222.333.45";
        $profissional->email = "fulano@qualquer.com.br";
        $profissional->genero  = "masculino";

        $profissional->adjetivos = "1-1, 2-1, 3-1, 4-1, 5-1, 6-1, 7-1, 8-1, 9-1, 10-1, "
            . "11-1, 12-1, 13-1, 14-1, 15-1, 16-1, 17-1, 18-1, 19-1, 20-1,"
            . "21-1, 22-1, 23-1, 24-1, 25-1, 26-1, 27-1, 28-1, 29-1, 30-1,"
            . "31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-1, 39-1, 40-1,"
            . "41-1, 42-1, 43-1, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1,"
            . "51-1, 52-1, 53-1, 54-1, 55-1, 56-1, 57-1, 58-1, 59-1, 60-1,"
            . "61-1, 62-1, 63-1, 64-1, 65-1";

        $profissional->poms    = Calc::perfilPoms($profissional->adjetivos);
        $profissional->grafico = Grafico::gerar($profissional->poms->tScore, $profissional->poms->rowScore);
        $profissional->laudo   = Laudos::laudo($profissional->poms->tScore);

        $relatorio = Relatorio::fabricar($profissional);

        #
        # $relatorio->download($profissional->nome);
        #

        $profissional->grafico->deletar_imagem();

    }

}