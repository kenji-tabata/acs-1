<?php

require_once dirname(__FILE__) . "/../includes/DBpdo.php";
require_once dirname(__FILE__) . "/../poms/Model.php";

class ModelTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->model = new PomsModel();
    }

    public function testRetListaProfissionais() {
        $model = new PomsModel();
        $lista = $model->ret_lista_profissionais();
        $this->assertEquals(29, count($lista));

        $lista = $model->ret_lista_profissionais('ORDER BY nome');
        $this->assertEquals($lista[0]->nome, "Alessandro de Souza Lira");
        $this->assertEquals($lista[1]->nome, "Alexandre Almeida Assunção");
        $this->assertEquals($lista[2]->nome, "Alexandre Roberto Misage");

        $lista = $model->ret_lista_profissionais('WHERE genero = "m"');
        $this->assertEquals(24, count($lista));
    }

    public function testRetCriterios() {
        $model = new PomsModel();

        # um único critério
        $filtro = new stdClass();
        $filtro->nome = "Fulano";
        $criterios = $model->ret_criterios($filtro);
        $this->assertEquals('WHERE nome LIKE "%Fulano%"', $criterios);

        # dois critérios
        $filtro = new stdClass();
        $filtro->nome   = "Fulano";
        $filtro->genero = "m";
        $criterios = $model->ret_criterios($filtro);
        $this->assertEquals('WHERE nome LIKE "%Fulano%" AND genero = "m"', $criterios);

        # por período de preenchimento
        $filtro = new stdClass();
        $filtro->nome           = "Fulano";
        $filtro->preench_inicio = "09/12/2015";
        $filtro->preench_fim    = "22/12/2015";
        $criterios = $model->ret_criterios($filtro);
        $this->assertEquals('WHERE nome LIKE "%Fulano%" AND preench BETWEEN "09/12/2015" AND "22/12/2015"', $criterios);
    }

    protected function tearDown() {
    }

}