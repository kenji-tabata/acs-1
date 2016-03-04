<?php

class IntegracaoTest extends PHPUnit_Framework_TestCase {

    public function testSeArquivoDeFontesParaPDfExiste() {
        $this->assertTrue(file_exists(dirname(__FILE__) . "/../fonts/arial.ttf"));
    }

    public function testSePastaFilesTempExiste() {
        $this->assertTrue(file_exists(dirname(__FILE__) . "/../files-temp/"));
    }

    public function testHaPermissaoDeEscreitaNaPastaFilesTemp() {
        $this->assertTrue(is_writable(dirname(__FILE__) . "/../files-temp/"));
    }

    public function testCalculoPerfilPoms() {
        require_once dirname(__FILE__) . "/../poms/Calc.php";
        require_once dirname(__FILE__) . "/../poms/RowScore.php";
        require_once dirname(__FILE__) . "/../poms/TScore.php";

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
        require_once dirname(__FILE__) . "/../poms/Profissional.php";
        require_once dirname(__FILE__) . "/../poms/Calc.php";
        require_once dirname(__FILE__) . "/../poms/RowScore.php";
        require_once dirname(__FILE__) . "/../poms/TScore.php";
        require_once dirname(__FILE__) . "/../poms/Laudos.php";
        require_once dirname(__FILE__) . "/../poms/Grafico.php";
        require_once dirname(__FILE__) . "/../poms/Relatorio.php";

        $profissional = new Profissional();
        $profissional->nome   = "Fulano";
        $profissional->cpf    = "111.2222.333.45";
        $profissional->email  = "fulano@qualquer.com.br";
        $profissional->genero = "masculino";

        $profissional->adjetivos = "1-1, 2-1, 3-1, 4-1, 5-1, 6-1, 7-1, 8-1, 9-1, 10-1, "
            . "11-1, 12-1, 13-1, 14-1, 15-1, 16-1, 17-1, 18-1, 19-1, 20-1,"
            . "21-1, 22-1, 23-1, 24-1, 25-1, 26-1, 27-1, 28-1, 29-1, 30-1,"
            . "31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-1, 39-1, 40-1,"
            . "41-1, 42-1, 43-1, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1,"
            . "51-1, 52-1, 53-1, 54-1, 55-1, 56-1, 57-1, 58-1, 59-1, 60-1,"
            . "61-1, 62-1, 63-1, 64-1, 65-1";

        #
        # Olha só: $profissional->poms !!!
        #
        $profissional->poms    = Calc::perfilPoms($profissional->adjetivos);
        $profissional->grafico = Grafico::gerar($profissional->poms->tScore, $profissional->poms->rowScore);
        $profissional->laudo   = Laudos::laudo($profissional->poms->tScore);

        $relatorio = Relatorio::fabricar($profissional);

        #
        # $relatorio->download($profissional->nome);
        #

        $relatorio->deletar();
        $profissional->grafico->deletar();
    }

    public function testEmissaoRelatorioPomsGrupo() {
        require_once dirname(__FILE__) . "/../poms/Profissional.php";
        require_once dirname(__FILE__) . "/../poms/Grupo.php";
        require_once dirname(__FILE__) . "/../poms/Calc.php";
        require_once dirname(__FILE__) . "/../poms/RowScore.php";
        require_once dirname(__FILE__) . "/../poms/TScore.php";
        require_once dirname(__FILE__) . "/../poms/RowScoreMedio.php";
        require_once dirname(__FILE__) . "/../poms/Laudos.php";
        require_once dirname(__FILE__) . "/../poms/Grafico.php";
        require_once dirname(__FILE__) . "/../poms/Relatorio.php";
        require_once dirname(__FILE__) . "/../poms/RelatorioGrupo.php";

        $prof01 = new Profissional();
        $prof01->nome      = "Fulano";
        $prof01->cpf       = "111.2222.333.45";
        $prof01->email     = "fulano@qualquer.com.br";
        $prof01->genero    = "masculino";
        $prof01->adjetivos = "1-1, 2-1, 3-1, 4-1, 5-1, 6-1, 7-1, 8-1, 9-1, 10-1, "
            . "11-1, 12-1, 13-1, 14-1, 15-1, 16-1, 17-1, 18-1, 19-1, 20-1,"
            . "21-1, 22-1, 23-1, 24-1, 25-1, 26-1, 27-1, 28-1, 29-1, 30-1,"
            . "31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-1, 39-1, 40-1,"
            . "41-1, 42-1, 43-1, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1,"
            . "51-1, 52-1, 53-1, 54-1, 55-1, 56-1, 57-1, 58-1, 59-1, 60-1,"
            . "61-1, 62-1, 63-1, 64-1, 65-1";
        $prof01->poms     = Calc::perfilPoms($prof01->adjetivos);
        $prof01->tScore   = $prof01->poms->tScore;
        $prof01->rowScore = $prof01->poms->rowScore;
        $prof01->grafico  = Grafico::gerar($prof01->poms->tScore, $prof01->poms->rowScore);
        $prof01->laudo    = Laudos::laudo($prof01->poms->tScore);

        $prof02 = new Profissional();
        $prof02->nome      = "Fulano";
        $prof02->cpf       = "111.2222.333.45";
        $prof02->email     = "fulano@qualquer.com.br";
        $prof02->genero    = "masculino";
        $prof02->adjetivos = "1-5, 2-5, 3-5, 4-5, 5-5, 6-5, 7-5, 8-5, 9-5, 10-5, "
            . "11-5, 12-5, 13-5, 14-5, 15-5, 16-5, 17-5, 18-5, 19-5, 20-5,"
            . "21-5, 22-5, 23-5, 24-5, 25-5, 26-5, 27-5, 28-5, 29-5, 30-5,"
            . "31-5, 32-5, 33-5, 34-5, 35-5, 36-5, 37-5, 38-5, 39-5, 40-5,"
            . "41-5, 42-5, 43-5, 44-5, 45-5, 46-5, 47-5, 48-5, 49-5, 50-5,"
            . "51-5, 52-5, 53-5, 54-5, 55-5, 56-5, 57-5, 58-5, 59-5, 60-5,"
            . "61-5, 62-5, 63-5, 64-5, 65-1";
        $prof02->poms     = Calc::perfilPoms($prof02->adjetivos);
        $prof02->tScore   = $prof02->poms->tScore;
        $prof02->rowScore = $prof02->poms->rowScore;
        $prof02->grafico  = Grafico::gerar($prof02->poms->tScore, $prof02->poms->rowScore);
        $prof02->laudo    = Laudos::laudo($prof02->poms->tScore);
        

        $grupo = new Grupo;
        $grupo->add($prof01);
        $grupo->add($prof02);

        $grupo->rowScore = new RowScoreMedio();
        $grupo->rowScore->calcular($grupo->get());

        $grupo->tScore = new TScore();
        $grupo->tScore->converterParaTScore($grupo->rowScore);

        $grupo->grafico = Grafico::gerar($grupo->tScore, $grupo->rowScore);


        $relatorio = new RelatorioGrupo($grupo);
        $relatorio->setGrafico($grupo->grafico->getNomeArquivo());        
        $relatorio->gerar();
        $relatorio->gravar();

        #
        # $relatorio->download('relatorio-em-grupo.pdf');
        #

        $relatorio->deletar();
        $grupo->grafico->deletar();        

    }    

}