<?php

class IntegracaoTest extends PHPUnit_Framework_TestCase {

    public function testSeArquivoDeFontesParaPDfExiste() {
        $this->assertTrue(file_exists("fonts/arial.ttf"));
    }

    public function testSePastaFilesTempExiste() {
        $this->assertTrue(file_exists("files-temp/"));
    }

    public function testHaPermissaoDeEscreitaNaPastaFilesTemp() {
        $this->assertTrue(is_writable("files-temp/"));
    }

}