<?php

require_once "poms/RowScore.php";

class RowScoreTest extends PHPUnit_Framework_TestCase {

   
    public function testSomar() {
        
        $rowScore = new RowScore();
        
        # Note que `$rowScore->vigor = 0`
        
        $rowScore->vigor = $rowScore->somar('vigor', 1);
        $this->assertEquals(1, $rowScore->vigor);

        $rowScore->vigor = $rowScore->somar('vigor', 2);
        $this->assertEquals(3, $rowScore->vigor);
        
        $rowScore->vigor = $rowScore->somar('vigor', 3);
        $this->assertEquals(6, $rowScore->vigor);

    }

    /**
     * Após subtrair o valor escolhido (no formulario)
     * somamos 4 unidades.
     * 
     * Ex:
     * $rowScore->vigor = 10
     * $valor = 2
     * $rowScore->vigor - $valor + 4
     * 10 - 2 + 4
     */
    public function testSubtrairSomaQuatro() {
        
        $rowScore = new RowScore();

        # Note que `$rowScore->vigor = 0`
        
        $rowScore->vigor = $rowScore->subtrairSomaQuatro('vigor', 1);
        $this->assertEquals(3, $rowScore->vigor);

        $rowScore->vigor = $rowScore->subtrairSomaQuatro('vigor', 2);
        $this->assertEquals(5, $rowScore->vigor);
        
        $rowScore->vigor = $rowScore->subtrairSomaQuatro('vigor', 3);
        $this->assertEquals(6, $rowScore->vigor);

    }    

    public function testCalcularValor() {
        $rowScore = new RowScore();
        
        #
        # A alternativa 22 (tensão) soma diferente (SubtrairSomaQuatro)
        #
        $this->assertEquals(0 - 1 + 4, $rowScore->calcularValor($id=22, $fator='tensao', $valor=1));
        $this->assertEquals(0 - 2 + 4, $rowScore->calcularValor($id=22, $fator='tensao', $valor=2));
        $this->assertEquals(0 - 3 + 4, $rowScore->calcularValor($id=22, $fator='tensao', $valor=3));
        $this->assertEquals(0 - 4 + 4, $rowScore->calcularValor($id=22, $fator='tensao', $valor=4));
        $this->assertEquals(0 - 5 + 4, $rowScore->calcularValor($id=22, $fator='tensao', $valor=5));

        #
        # A alternativa 54 (confusao) soma diferente (SubtrairSomaQuatro)
        #
        $this->assertEquals(0 - 1 + 4, $rowScore->calcularValor($id=54, $fator='confusao', $valor=1));
        $this->assertEquals(0 - 2 + 4, $rowScore->calcularValor($id=54, $fator='confusao', $valor=2));
        $this->assertEquals(0 - 3 + 4, $rowScore->calcularValor($id=54, $fator='confusao', $valor=3));
        $this->assertEquals(0 - 4 + 4, $rowScore->calcularValor($id=54, $fator='confusao', $valor=4));
        $this->assertEquals(0 - 5 + 4, $rowScore->calcularValor($id=54, $fator='confusao', $valor=5));

        #
        # Todas as demais somam normalmente, exemplo:
        #
        $this->assertEquals(1, $rowScore->calcularValor($id=1, $fator='vigor', $valor=1));
        $this->assertEquals(2, $rowScore->calcularValor($id=1, $fator='vigor', $valor=2));
        $this->assertEquals(3, $rowScore->calcularValor($id=1, $fator='vigor', $valor=3));
        $this->assertEquals(4, $rowScore->calcularValor($id=1, $fator='vigor', $valor=4));
        $this->assertEquals(5, $rowScore->calcularValor($id=1, $fator='vigor', $valor=5));
        
    }    
    
    public function testCorrigirValor() {
        
        $rowScore = new RowScore();
        
        $this->assertEquals(4, $rowScore->corrigirValor(5));
        $this->assertEquals(3, $rowScore->corrigirValor(4));
        $this->assertEquals(2, $rowScore->corrigirValor(3));
        $this->assertEquals(1, $rowScore->corrigirValor(2));
        $this->assertEquals(0, $rowScore->corrigirValor(1));
        
    }    
    
    public function testRetFator() {

        $rowScore = new RowScore();
        $this->assertEquals("vigor", $rowScore->retFator("1"));
        $this->assertEquals("tensao", $rowScore->retFator("2"));
        $this->assertEquals("raiva", $rowScore->retFator("3"));
        $this->assertEquals("fadiga", $rowScore->retFator("4"));
        $this->assertEquals("depressao", $rowScore->retFator("5"));
        $this->assertEquals("vigor", $rowScore->retFator("6"));
        $this->assertEquals("vigor", $rowScore->retFator("7"));
        $this->assertEquals("confusao", $rowScore->retFator("8"));
        $this->assertEquals("depressao", $rowScore->retFator("9"));
        $this->assertEquals("tensao", $rowScore->retFator("10"));
        
        $this->assertEquals("fadiga", $rowScore->retFator("11"));
        $this->assertEquals("raiva", $rowScore->retFator("12"));
        $this->assertEquals("tensao", $rowScore->retFator("13"));
        $this->assertEquals("depressao", $rowScore->retFator("14"));
        $this->assertEquals("vigor", $rowScore->retFator("15"));
        $this->assertEquals("tensao", $rowScore->retFator("16"));
        $this->assertEquals("raiva", $rowScore->retFator("17"));
        $this->assertEquals("depressao", $rowScore->retFator("18"));
        $this->assertEquals("vigor", $rowScore->retFator("19"));
        $this->assertEquals("tensao", $rowScore->retFator("20"));

        $this->assertEquals("depressao", $rowScore->retFator("21"));
        $this->assertEquals("tensao", $rowScore->retFator("22"));
        $this->assertEquals("depressao", $rowScore->retFator("23"));
        $this->assertEquals("raiva", $rowScore->retFator("24"));
        $this->assertEquals("vigor", $rowScore->retFator("25"));
        $this->assertEquals("tensao", $rowScore->retFator("26"));
        $this->assertEquals("tensao", $rowScore->retFator("27"));
        $this->assertEquals("confusao", $rowScore->retFator("28"));
        $this->assertEquals("fadiga", $rowScore->retFator("29"));
        $this->assertEquals("vigor", $rowScore->retFator("30"));

        $this->assertEquals("raiva", $rowScore->retFator("31"));
        $this->assertEquals("depressao", $rowScore->retFator("32"));
        $this->assertEquals("raiva", $rowScore->retFator("33"));
        $this->assertEquals("tensao", $rowScore->retFator("34"));
        $this->assertEquals("depressao", $rowScore->retFator("35"));
        $this->assertEquals("depressao", $rowScore->retFator("36"));
        $this->assertEquals("confusao", $rowScore->retFator("37"));
        $this->assertEquals("vigor", $rowScore->retFator("38"));
        $this->assertEquals("raiva", $rowScore->retFator("39"));
        $this->assertEquals("fadiga", $rowScore->retFator("40"));

        $this->assertEquals("tensao", $rowScore->retFator("41"));
        $this->assertEquals("raiva", $rowScore->retFator("42"));
        $this->assertEquals("vigor", $rowScore->retFator("43"));
        $this->assertEquals("depressao", $rowScore->retFator("44"));
        $this->assertEquals("depressao", $rowScore->retFator("45"));
        $this->assertEquals("fadiga", $rowScore->retFator("46"));
        $this->assertEquals("raiva", $rowScore->retFator("47"));
        $this->assertEquals("depressao", $rowScore->retFator("48"));
        $this->assertEquals("fadiga", $rowScore->retFator("49"));
        $this->assertEquals("confusao", $rowScore->retFator("50"));

        $this->assertEquals("vigor", $rowScore->retFator("51"));
        $this->assertEquals("raiva", $rowScore->retFator("52"));
        $this->assertEquals("raiva", $rowScore->retFator("53"));
        $this->assertEquals("confusao", $rowScore->retFator("54"));
        $this->assertEquals("vigor", $rowScore->retFator("55"));
        $this->assertEquals("vigor", $rowScore->retFator("56"));
        $this->assertEquals("raiva", $rowScore->retFator("57"));
        $this->assertEquals("depressao", $rowScore->retFator("58"));
        $this->assertEquals("confusao", $rowScore->retFator("59"));
        $this->assertEquals("vigor", $rowScore->retFator("60"));
        
        $this->assertEquals("depressao", $rowScore->retFator("61"));
        $this->assertEquals("depressao", $rowScore->retFator("62"));
        $this->assertEquals("vigor", $rowScore->retFator("63"));
        $this->assertEquals("confusao", $rowScore->retFator("64"));
        $this->assertEquals("fadiga", $rowScore->retFator("65"));
        
    }


}
