<?php

require_once "poms/Calc.php";
require_once "poms/RowScore.php";

class CalcTest extends PHPUnit_Framework_TestCase {

    protected $alternativasEscolhidas;

    protected function setUp() {
        $this->pomsCalc = new Calc();

        $this->alternativasEscolhidas = "1-1, 2-1, 3-1, 4-1, 5-1, 6-1, 7-1, 8-1, 9-1, 10-1, "
            . "11-1, 12-1, 13-1, 14-1, 15-1, 16-1, 17-1, 18-1, 19-1, 20-1,"
            . "21-1, 22-1, 23-1, 24-1, 25-1, 26-1, 27-1, 28-1, 29-1, 30-1,"
            . "31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-1, 39-1, 40-1,"
            . "41-1, 42-1, 43-1, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1,"
            . "51-1, 52-1, 53-1, 54-1, 55-1, 56-1, 57-1, 58-1, 59-1, 60-1,"
            . "61-1, 62-1, 63-1, 64-1, 65-1";
    }

    public function testRowScore_Foo() {
        $rowScore = $this->pomsCalc->rowScore($this->alternativasEscolhidas);
        $this->assertEquals(4, $rowScore->tensao);
        $this->assertEquals(0, $rowScore->depressao);
        $this->assertEquals(0, $rowScore->raiva);
        $this->assertEquals(0, $rowScore->vigor);
        $this->assertEquals(0, $rowScore->fadiga);
        $this->assertEquals(4, $rowScore->confusao);
    }

    public function testRowScore_CalculoSimples() {
        $rowScore = $this->pomsCalc->rowScore("1-5");
        $this->assertEquals(4, $rowScore->vigor);

        $rowScore = $this->pomsCalc->rowScore("1-5, 2-5");
        $this->assertEquals(4, $rowScore->vigor);
        $this->assertEquals(4, $rowScore->tensao);

        $rowScore = $this->pomsCalc->rowScore("2-4");
        $this->assertEquals(3, $rowScore->tensao);

        $rowScore = $this->pomsCalc->rowScore("3-3");
        $this->assertEquals(2, $rowScore->raiva);

        $rowScore = $this->pomsCalc->rowScore("11-1");
        $this->assertEquals(0, $rowScore->fadiga);

        $rowScore = $this->pomsCalc->rowScore("21-2");
        $this->assertEquals(1, $rowScore->depressao);

    }

    /**
     * Alternativa 22 soma de forma diferente
     *
     * Executa `subtrairSomaQuatro()`
     */
    public function testRowScore_Alternativa22SomaDiferente() {
        $rowScore = $this->pomsCalc->rowScore("22-5");
        # 0 - (5 - 1) + 4
        $this->assertEquals(0, $rowScore->tensao);

        $rowScore = $this->pomsCalc->rowScore("22-4");
        # 0 - (4 - 1) + 4
        $this->assertEquals(1, $rowScore->tensao);

        $rowScore = $this->pomsCalc->rowScore("22-3");
        # 0 - (3 - 1) + 4
        $this->assertEquals(2, $rowScore->tensao);

        $rowScore = $this->pomsCalc->rowScore("22-2");
        # 0 - (2 - 1) + 4
        $this->assertEquals(3, $rowScore->tensao);

        $rowScore = $this->pomsCalc->rowScore("22-1");
        # 0 - (1 - 1) + 4
        $this->assertEquals(4, $rowScore->tensao);
    }

    /**
     * Alternativa 54 soma de forma diferente
     *
     * Executa `subtrairSomaQuatro()`
     *
     */
    public function testRowScore_Alternativa54SomaDiferente() {
        $rowScore = $this->pomsCalc->rowScore("54-5");
        # 0 - (5 - 1) + 4
        $this->assertEquals(0, $rowScore->confusao);

        $rowScore = $this->pomsCalc->rowScore("54-4");
        # 0 - (4 - 1) + 4
        $this->assertEquals(1, $rowScore->confusao);

        $rowScore = $this->pomsCalc->rowScore("54-3");
        # 0 - (3 - 1) + 4
        $this->assertEquals(2, $rowScore->confusao);

        $rowScore = $this->pomsCalc->rowScore("54-2");
        # 0 - (2 - 1) + 4
        $this->assertEquals(3, $rowScore->confusao);

        $rowScore = $this->pomsCalc->rowScore("54-1");
        # 0 - (1 - 1) + 4
        $this->assertEquals(4, $rowScore->confusao);
    }
}
