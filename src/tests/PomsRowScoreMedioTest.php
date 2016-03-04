<?php

require_once dirname(__FILE__) . "/../poms/RowScoreMedio.php";
require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/TScore.php";

class RowScoreMedioTest extends PHPUnit_Framework_TestCase {
    protected $profissionais;

    protected function setUp() {

        $this->grupo = [];

        # profissional 1
        $this->profissional = new Profissional();
        $this->profissional->rowScore = new RowScore();
        $this->profissional->rowScore->tensao    = 15;
        $this->profissional->rowScore->depressao = 15;
        $this->profissional->rowScore->raiva     = 15;
        $this->profissional->rowScore->vigor     = 28;
        $this->profissional->rowScore->fadiga    = 10;
        $this->profissional->rowScore->confusao  = 10;
        $this->grupo[] = $this->profissional;

        # profissional 2
        $this->profissional = new Profissional();
        $this->profissional->rowScore = new RowScore();
        $this->profissional->rowScore->tensao    = 15;
        $this->profissional->rowScore->depressao = 15;
        $this->profissional->rowScore->raiva     = 15;
        $this->profissional->rowScore->vigor     = 28;
        $this->profissional->rowScore->fadiga    = 10;
        $this->profissional->rowScore->confusao  = 2;
        $this->grupo[] = $this->profissional;
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