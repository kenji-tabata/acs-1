<?php

require_once "poms/RowScore.php";
require_once "poms/TScore.php";

class RowTScoreTest extends PHPUnit_Framework_TestCase {

    #
    # Menor pontuação possível
    #
    public function testCaso1() {
        $rowScore = new RowScore();
        $rowScore->tensao    = 4;
        $rowScore->depressao = 0;
        $rowScore->raiva     = 0;
        $rowScore->vigor     = 0;
        $rowScore->fadiga    = 0;
        $rowScore->confusao  = 4;

        $tScore = new TScore();
        $tScore->converterParaTScore($rowScore);

        $this->assertEquals(46, $tScore->tensao);
        $this->assertEquals(40, $tScore->depressao);
        $this->assertEquals(40, $tScore->raiva);
        $this->assertEquals(40, $tScore->vigor);
        $this->assertEquals(40, $tScore->fadiga);
        $this->assertEquals(51, $tScore->confusao);
    }

    #
    # Maior pontuação possível
    #
    public function testCaso2() {
        $rowScore = new RowScore();
        $rowScore->tensao    = 36;
        $rowScore->depressao = 60;
        $rowScore->raiva     = 48;
        $rowScore->vigor     = 56;
        $rowScore->fadiga    = 28;
        $rowScore->confusao  = 24;

        $tScore = new TScore();
        $tScore->converterParaTScore($rowScore);

        $this->assertEquals(100, $tScore->tensao);
        $this->assertEquals(100, $tScore->depressao);
        $this->assertEquals(100, $tScore->raiva);
        $this->assertEquals(100, $tScore->vigor);
        $this->assertEquals(100, $tScore->fadiga);
        $this->assertEquals(100, $tScore->confusao);
    }

}