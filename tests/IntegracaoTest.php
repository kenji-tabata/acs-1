<?php

class IntegracaoTest extends PHPUnit_Framework_TestCase {

    public function testSeArquivoDeFontesParaPDfExiste() {
        $this->assertTrue(file_exists("fonts/arial.ttf"));
    }
}