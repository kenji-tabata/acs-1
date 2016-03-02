<?php

require_once dirname(__FILE__) . "/../poms/RowScoreMedio.php";
require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/TScore.php";

class RowScoreMedioTest extends PHPUnit_Framework_TestCase {
    protected $profissionais;

    protected function setUp() {

        $this->grupo = [];
        $this->profissional = new Profissional();

        # profissional 1
        $rowScore = new RowScore();
        $rowScore->tensao    = 15;
        $rowScore->depressao = 15;
        $rowScore->raiva     = 15;
        $rowScore->vigor     = 28;
        $rowScore->fadiga    = 10;
        $rowScore->confusao  = 10;

        $tScore = new TScore();
        $tScore->tensao    = 65;
        $tScore->depressao = 55;
        $tScore->raiva     = 58;
        $tScore->vigor     = 70;
        $tScore->fadiga    = 60;
        $tScore->confusao  = 66;

        $this->profissional->rowScore  = $rowScore;
        $this->grupo[] = clone $this->profissional;


        # profissional 2
        $rowScore = new RowScore();
        $rowScore->tensao    = 15;
        $rowScore->depressao = 15;
        $rowScore->raiva     = 15;
        $rowScore->vigor     = 28;
        $rowScore->fadiga    = 10;
        $rowScore->confusao  = 2;

        $tScore = new TScore();
        $tScore->tensao    = 65;
        $tScore->depressao = 55;
        $tScore->raiva     = 58;
        $tScore->vigor     = 70;
        $tScore->fadiga    = 60;
        $tScore->confusao  = 46;

        $this->profissional->rowScore  = $rowScore;
        $this->grupo[] = clone $this->profissional;
    }


    public function testSetMedia() {

        $rowScore = new RowScoreMedio();
        $rowScore->calcular($this->grupo);

        $this->assertEquals(15, $rowScore->tensao);
        $this->assertEquals(15, $rowScore->depressao);
        $this->assertEquals(15, $rowScore->raiva);
        $this->assertEquals(28, $rowScore->vigor);
        $this->assertEquals(10, $rowScore->fadiga);
        $this->assertEquals(6,  $rowScore->confusao);


    }

}