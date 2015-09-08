<?php

require_once "poms/Calc.php";
require_once "poms/RowScore.php";

class CalcTest extends PHPUnit_Framework_TestCase {

    public function testRowScore_CalculoSimples() {
        $pomsCalc = new Calc();

        $rowScore = $pomsCalc->rowScore("1-5");
        $this->assertEquals(4, $rowScore->vigor);

        $rowScore = $pomsCalc->rowScore("1-5, 2-5");
        $this->assertEquals(4, $rowScore->vigor);
        $this->assertEquals(4, $rowScore->tensao);

        $rowScore = $pomsCalc->rowScore("2-4");
        $this->assertEquals(3, $rowScore->tensao);

        $rowScore = $pomsCalc->rowScore("3-3");
        $this->assertEquals(2, $rowScore->raiva);

        $rowScore = $pomsCalc->rowScore("11-1");
        $this->assertEquals(0, $rowScore->fadiga);
        
        $rowScore = $pomsCalc->rowScore("21-2");
        $this->assertEquals(1, $rowScore->depressao);
        
    }

    /** 
     * Alternativa 22 soma de forma diferente
     * 
     * Executa `subtrairSomaQuatro()`
     */
    public function testRowScore_Alternativa22SomaDiferente() {
        $pomsCalc = new Calc();

        $rowScore = $pomsCalc->rowScore("22-5");
        # 0 - (5 - 1) + 4
        $this->assertEquals(0, $rowScore->tensao); 

        $rowScore = $pomsCalc->rowScore("22-4");
        # 0 - (4 - 1) + 4
        $this->assertEquals(1, $rowScore->tensao);
        
        $rowScore = $pomsCalc->rowScore("22-3");
        # 0 - (3 - 1) + 4
        $this->assertEquals(2, $rowScore->tensao);
        
        $rowScore = $pomsCalc->rowScore("22-2");
        # 0 - (2 - 1) + 4
        $this->assertEquals(3, $rowScore->tensao);

        $rowScore = $pomsCalc->rowScore("22-1");
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
        $pomsCalc = new Calc();

        $rowScore = $pomsCalc->rowScore("54-5");
        # 0 - (5 - 1) + 4
        $this->assertEquals(0, $rowScore->confusao); 

        $rowScore = $pomsCalc->rowScore("54-4");
        # 0 - (4 - 1) + 4
        $this->assertEquals(1, $rowScore->confusao);
        
        $rowScore = $pomsCalc->rowScore("54-3");
        # 0 - (3 - 1) + 4
        $this->assertEquals(2, $rowScore->confusao);
        
        $rowScore = $pomsCalc->rowScore("54-2");
        # 0 - (2 - 1) + 4
        $this->assertEquals(3, $rowScore->confusao);

        $rowScore = $pomsCalc->rowScore("54-1");
        # 0 - (1 - 1) + 4
        $this->assertEquals(4, $rowScore->confusao);
    }

    
    public function testRetIdFator() {
        $pomsCalc = new Calc();

        $this->assertEquals(1, $pomsCalc->retIdFator("1-5"));
        $this->assertEquals(2, $pomsCalc->retIdFator("2-5"));
        $this->assertEquals(3, $pomsCalc->retIdFator("3-5"));
        $this->assertEquals(4, $pomsCalc->retIdFator("4-5"));
        $this->assertEquals(5, $pomsCalc->retIdFator("5-5"));

        $this->assertEquals(99, $pomsCalc->retIdFator("99-5"));
    }

    /**
     * Retorna valor real do fator (sem correção)
     */
    public function testRetValorFator() {
        $pomsCalc = new Calc();

        $this->assertEquals(1, $pomsCalc->retValorFator("1-1"));
        $this->assertEquals(2, $pomsCalc->retValorFator("1-2"));
        $this->assertEquals(3, $pomsCalc->retValorFator("1-3"));
        $this->assertEquals(4, $pomsCalc->retValorFator("1-4"));
        $this->assertEquals(5, $pomsCalc->retValorFator("1-5"));
        $this->assertEquals(99, $pomsCalc->retValorFator("1-99"));
    }

    public function testSepararStringFormulario() {
        $pomsCalc = new Calc();

        $stringFormulario = "1-5, 2-5, 3-5";
        $arr = $pomsCalc->separarStringFormulario($stringFormulario);
        $this->assertEquals("1-5", $arr[0]);
        $this->assertEquals("2-5", $arr[1]);
        $this->assertEquals("3-5", $arr[2]);
    }

}
