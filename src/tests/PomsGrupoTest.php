<?php

// require_once dirname(__FILE__) . "/../poms/RelatorioGrupo.php";
// require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/Grupo.php";
// require_once dirname(__FILE__) . "/../poms/Laudos.php";
// require_once dirname(__FILE__) . "/../poms/Grafico.php";
// require_once dirname(__FILE__) . "/../poms/TScore.php";
// require_once dirname(__FILE__) . "/../poms/RowScoreMedio.php";


class GrupoTest extends PHPUnit_Framework_TestCase {

    function testFoo() {
        $gr = new Grupo();
        $grupo = $gr->factory([14, 15, 18]);

        $this->assertTrue(true);
    }
}