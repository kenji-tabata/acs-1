<?php

require_once "poms/Laudo.php";
require_once "poms/TScore.php";
require_once "poms/RowScore.php";

class LaudoTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $this->laudo  = new Laudo();
        $this->tscore = new TScore();
    }

    public function testDescobrir01() {
        $this->tscore->tensao    = 40; # < linha de corte
        $this->tscore->depressao = 40; # < linha de corte
        $this->tscore->raiva     = 40; # < linha de corte
        $this->tscore->vigor     = 80; # >
        $this->tscore->fadiga    = 40; # < linha de corte
        $this->tscore->confusao  = 46; # < linha de corte

        $this->assertEquals("vigor-otimo", $this->laudo->descobrir($this->tscore));
    }

    public function testDescobrir02() {
        $this->tscore = new TScore();
        $this->tscore->tensao    = 46;
        $this->tscore->depressao = 40;
        $this->tscore->raiva     = 40;
        $this->tscore->vigor     = 65;
        $this->tscore->fadiga    = 60; # <----
        $this->tscore->confusao  = 46;

        $this->assertEquals("fadiga-inercia", $this->laudo->descobrir($this->tscore));
    }

    public function testDescobrir03() {
        $this->tscore = new TScore();
        $this->tscore->tensao    = 46;
        $this->tscore->depressao = 40;
        $this->tscore->raiva     = 40;
        $this->tscore->vigor     = 65;
        $this->tscore->fadiga    = 40;
        $this->tscore->confusao  = 60; # <----

        $this->assertEquals("confusao-desorientacao", $this->laudo->descobrir($this->tscore));
    }

    public function testDescobrir04() {
        $this->tscore = new TScore();
        $this->tscore->tensao    = 46;
        $this->tscore->depressao = 60; # <----
        $this->tscore->raiva     = 40;
        $this->tscore->vigor     = 65;
        $this->tscore->fadiga    = 40;
        $this->tscore->confusao  = 46;

        $this->assertEquals("depressao-melancolia", $this->laudo->descobrir($this->tscore));
    }

    public function testDescobrir05() {
        $this->tscore = new TScore();
        $this->tscore->tensao    = 60; # <----
        $this->tscore->depressao = 40;
        $this->tscore->raiva     = 40; # menor que 70
        $this->tscore->vigor     = 65;
        $this->tscore->fadiga    = 40;
        $this->tscore->confusao  = 46;

        $this->assertEquals("tensao-ansiedade", $this->laudo->descobrir($this->tscore));
    }

    public function testDescobrir06() {
        $this->tscore = new TScore();
        $this->tscore->tensao    = 46; # menor que 70
        $this->tscore->depressao = 40;
        $this->tscore->raiva     = 60; # <----
        $this->tscore->vigor     = 65;
        $this->tscore->fadiga    = 40;
        $this->tscore->confusao  = 46;

        $this->assertEquals("agressividade-colera", $this->laudo->descobrir($this->tscore));
    }

    public function testDescobrir07() {
        $this->tscore = new TScore();
        $this->tscore->tensao    = 71; # > 70
        $this->tscore->depressao = 40;
        $this->tscore->raiva     = 71; # > 70
        $this->tscore->vigor     = 65;
        $this->tscore->fadiga    = 40;
        $this->tscore->confusao  = 46;

        $this->assertEquals("tensao-raiva", $this->laudo->descobrir($this->tscore));
    }

    public function testRetMaiorFator() {
        $this->tscore = new TScore();
        $this->tscore->tensao    = 46;
        $this->tscore->depressao = 49;
        $this->tscore->raiva     = 75; # <----
        $this->tscore->vigor     = 65;
        $this->tscore->fadiga    = 51;
        $this->tscore->confusao  = 46;

        $this->assertEquals("raiva", $this->laudo->retMaiorFator($this->tscore));
    }

}