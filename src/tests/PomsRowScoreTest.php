<?php

require_once dirname(__FILE__) . "/../poms/RowScore.php";

class RowScoreTest extends PHPUnit_Framework_TestCase {

    protected $rowScore;

    protected function setUp() {
        $this->rowScore = new RowScore();
    }

    public function testSepararStringFormulario() {
        $arr = $this->rowScore->separarStringFormulario("1-1, 2-1, 3-1");
        $this->assertEquals("1-1", $arr[0]);
        $this->assertEquals("2-1", $arr[1]);
        $this->assertEquals("3-1", $arr[2]);
        # etc...
    }

    public function testRetIdFator() {
        $this->assertEquals(1, $this->rowScore->retIdFator("1-5"));
        $this->assertEquals(4, $this->rowScore->retIdFator("4-5"));
        $this->assertEquals(11, $this->rowScore->retIdFator("11-5"));
        $this->assertEquals(12, $this->rowScore->retIdFator("12-5"));
    }

    /**
     * Retorna valor real do fator (sem correção)
     */
    public function testRetValorFator() {
        $this->assertEquals(1, $this->rowScore->retValorFator("1-1"));
        $this->assertEquals(2, $this->rowScore->retValorFator("1-2"));
        $this->assertEquals(3, $this->rowScore->retValorFator("1-3"));
        $this->assertEquals(4, $this->rowScore->retValorFator("1-4"));
        $this->assertEquals(5, $this->rowScore->retValorFator("1-5"));
    }

    /**
     *  Repare que a soma é de forma comulativa
     */
    public function testSomar() {

        # O valor inicial de `$rowScore->vigor = 0`

        $this->rowScore->vigor = $this->rowScore->somar('vigor', 1);
        $this->assertEquals(1, $this->rowScore->vigor);

        $this->rowScore->vigor = $this->rowScore->somar('vigor', 2);
        $this->assertEquals(3, $this->rowScore->vigor);

        $this->rowScore->vigor = $this->rowScore->somar('vigor', 3);
        $this->assertEquals(6, $this->rowScore->vigor);

    }

    /**
     * Após subtrair o valor escolhido (no formulário) somamos 4 unidades.
     *
     * Ex:
     * $rowScore->vigor = 10
     * $valor = 2
     * $rowScore->vigor - $valor + 4
     * 10 - 2 + 4
     */
    public function testSubtrairSomaQuatro() {
        # O valor inicial de `$rowScore->vigor = 0`

        $this->rowScore->vigor = $this->rowScore->subtrairSomaQuatro('vigor', 1);
        $this->assertEquals(3, $this->rowScore->vigor);

        $this->rowScore->vigor = $this->rowScore->subtrairSomaQuatro('vigor', 2);
        $this->assertEquals(5, $this->rowScore->vigor);

        $this->rowScore->vigor = $this->rowScore->subtrairSomaQuatro('vigor', 3);
        $this->assertEquals(6, $this->rowScore->vigor);

    }

    public function testCalcularValor() {
        #
        # A alternativa 22 (tensão) soma diferente (SubtrairSomaQuatro)
        #
        $this->assertEquals(0 - 1 + 4, $this->rowScore->calcularValor($id=22, $fator='tensao', $valor=1));
        $this->assertEquals(0 - 2 + 4, $this->rowScore->calcularValor($id=22, $fator='tensao', $valor=2));
        $this->assertEquals(0 - 3 + 4, $this->rowScore->calcularValor($id=22, $fator='tensao', $valor=3));
        $this->assertEquals(0 - 4 + 4, $this->rowScore->calcularValor($id=22, $fator='tensao', $valor=4));
        $this->assertEquals(0 - 5 + 4, $this->rowScore->calcularValor($id=22, $fator='tensao', $valor=5));

        #
        # A alternativa 54 (confusao) soma diferente (SubtrairSomaQuatro)
        #
        $this->assertEquals(0 - 1 + 4, $this->rowScore->calcularValor($id=54, $fator='confusao', $valor=1));
        $this->assertEquals(0 - 2 + 4, $this->rowScore->calcularValor($id=54, $fator='confusao', $valor=2));
        $this->assertEquals(0 - 3 + 4, $this->rowScore->calcularValor($id=54, $fator='confusao', $valor=3));
        $this->assertEquals(0 - 4 + 4, $this->rowScore->calcularValor($id=54, $fator='confusao', $valor=4));
        $this->assertEquals(0 - 5 + 4, $this->rowScore->calcularValor($id=54, $fator='confusao', $valor=5));

        #
        # Todas as demais somam normalmente, exemplo:
        #
        $this->assertEquals(1, $this->rowScore->calcularValor($id=1, $fator='vigor', $valor=1));
        $this->assertEquals(2, $this->rowScore->calcularValor($id=1, $fator='vigor', $valor=2));
        $this->assertEquals(3, $this->rowScore->calcularValor($id=1, $fator='vigor', $valor=3));
        $this->assertEquals(4, $this->rowScore->calcularValor($id=1, $fator='vigor', $valor=4));
        $this->assertEquals(5, $this->rowScore->calcularValor($id=1, $fator='vigor', $valor=5));

    }

    public function testCorrigirValor() {
        $this->assertEquals(4, $this->rowScore->corrigirValor(5));
        $this->assertEquals(3, $this->rowScore->corrigirValor(4));
        $this->assertEquals(2, $this->rowScore->corrigirValor(3));
        $this->assertEquals(1, $this->rowScore->corrigirValor(2));
        $this->assertEquals(0, $this->rowScore->corrigirValor(1));
    }

    /**
     * As 65 questões do formulário possuem um fator atrelado.
     */
    public function testRetFator() {
        $this->assertEquals("vigor", $this->rowScore->retFator("1"));
        $this->assertEquals("tensao", $this->rowScore->retFator("2"));
        $this->assertEquals("raiva", $this->rowScore->retFator("3"));
        $this->assertEquals("fadiga", $this->rowScore->retFator("4"));
        $this->assertEquals("depressao", $this->rowScore->retFator("5"));
        $this->assertEquals("vigor", $this->rowScore->retFator("6"));
        $this->assertEquals("vigor", $this->rowScore->retFator("7"));
        $this->assertEquals("confusao", $this->rowScore->retFator("8"));
        $this->assertEquals("depressao", $this->rowScore->retFator("9"));
        $this->assertEquals("tensao", $this->rowScore->retFator("10"));

        $this->assertEquals("fadiga", $this->rowScore->retFator("11"));
        $this->assertEquals("raiva", $this->rowScore->retFator("12"));
        $this->assertEquals("tensao", $this->rowScore->retFator("13"));
        $this->assertEquals("depressao", $this->rowScore->retFator("14"));
        $this->assertEquals("vigor", $this->rowScore->retFator("15"));
        $this->assertEquals("tensao", $this->rowScore->retFator("16"));
        $this->assertEquals("raiva", $this->rowScore->retFator("17"));
        $this->assertEquals("depressao", $this->rowScore->retFator("18"));
        $this->assertEquals("vigor", $this->rowScore->retFator("19"));
        $this->assertEquals("tensao", $this->rowScore->retFator("20"));

        $this->assertEquals("depressao", $this->rowScore->retFator("21"));
        $this->assertEquals("tensao", $this->rowScore->retFator("22"));
        $this->assertEquals("depressao", $this->rowScore->retFator("23"));
        $this->assertEquals("raiva", $this->rowScore->retFator("24"));
        $this->assertEquals("vigor", $this->rowScore->retFator("25"));
        $this->assertEquals("tensao", $this->rowScore->retFator("26"));
        $this->assertEquals("tensao", $this->rowScore->retFator("27"));
        $this->assertEquals("confusao", $this->rowScore->retFator("28"));
        $this->assertEquals("fadiga", $this->rowScore->retFator("29"));
        $this->assertEquals("vigor", $this->rowScore->retFator("30"));

        $this->assertEquals("raiva", $this->rowScore->retFator("31"));
        $this->assertEquals("depressao", $this->rowScore->retFator("32"));
        $this->assertEquals("raiva", $this->rowScore->retFator("33"));
        $this->assertEquals("tensao", $this->rowScore->retFator("34"));
        $this->assertEquals("depressao", $this->rowScore->retFator("35"));
        $this->assertEquals("depressao", $this->rowScore->retFator("36"));
        $this->assertEquals("confusao", $this->rowScore->retFator("37"));
        $this->assertEquals("vigor", $this->rowScore->retFator("38"));
        $this->assertEquals("raiva", $this->rowScore->retFator("39"));
        $this->assertEquals("fadiga", $this->rowScore->retFator("40"));

        $this->assertEquals("tensao", $this->rowScore->retFator("41"));
        $this->assertEquals("raiva", $this->rowScore->retFator("42"));
        $this->assertEquals("vigor", $this->rowScore->retFator("43"));
        $this->assertEquals("depressao", $this->rowScore->retFator("44"));
        $this->assertEquals("depressao", $this->rowScore->retFator("45"));
        $this->assertEquals("fadiga", $this->rowScore->retFator("46"));
        $this->assertEquals("raiva", $this->rowScore->retFator("47"));
        $this->assertEquals("depressao", $this->rowScore->retFator("48"));
        $this->assertEquals("fadiga", $this->rowScore->retFator("49"));
        $this->assertEquals("confusao", $this->rowScore->retFator("50"));

        $this->assertEquals("vigor", $this->rowScore->retFator("51"));
        $this->assertEquals("raiva", $this->rowScore->retFator("52"));
        $this->assertEquals("raiva", $this->rowScore->retFator("53"));
        $this->assertEquals("confusao", $this->rowScore->retFator("54"));
        $this->assertEquals("vigor", $this->rowScore->retFator("55"));
        $this->assertEquals("vigor", $this->rowScore->retFator("56"));
        $this->assertEquals("raiva", $this->rowScore->retFator("57"));
        $this->assertEquals("depressao", $this->rowScore->retFator("58"));
        $this->assertEquals("confusao", $this->rowScore->retFator("59"));
        $this->assertEquals("vigor", $this->rowScore->retFator("60"));

        $this->assertEquals("depressao", $this->rowScore->retFator("61"));
        $this->assertEquals("depressao", $this->rowScore->retFator("62"));
        $this->assertEquals("vigor", $this->rowScore->retFator("63"));
        $this->assertEquals("confusao", $this->rowScore->retFator("64"));
        $this->assertEquals("fadiga", $this->rowScore->retFator("65"));
    }
}
