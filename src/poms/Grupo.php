<?php
require_once dirname(__FILE__) . "/../poms/Profissional.php";
require_once dirname(__FILE__) . "/../poms/Grupo.php";
require_once dirname(__FILE__) . "/../poms/Laudos.php";
require_once dirname(__FILE__) . "/../poms/Grafico.php";
require_once dirname(__FILE__) . "/../poms/Calc.php";
require_once dirname(__FILE__) . "/../poms/TScore.php";
require_once dirname(__FILE__) . "/../poms/RowScoreMedio.php";
require_once dirname(__FILE__) . "/../poms/Model.php";
require_once dirname(__FILE__) . "/../includes/DBpdo.php";


class Grupo {

    private $profissionais;

    function add($profissional) {
        $this->profissionais[] = $profissional;
    }

    function get() {
        return $this->profissionais;
    }

    function factory($ids) {
        $grupo = new Grupo;
        foreach ($ids as $id) {
            $model = new PomsModel();
            $profissional = $model->read_profissional($id);
            $profissional->poms     = Calc::perfilPoms($profissional->adjetivos);
            $profissional->tScore   = $profissional->poms->tScore;
            $profissional->rowScore = $profissional->poms->rowScore;
            $profissional->grafico  = Grafico::gerar($profissional->poms->tScore, $profissional->poms->rowScore);
            $profissional->laudo    = Laudos::laudo($profissional->poms->tScore);
            $grupo->add($profissional);
        }
        // var_dump($grupo);

        $grupo->rowScore = new RowScoreMedio();
        $grupo->rowScore->calcular($grupo->get());
        $grupo->tScore = new TScore();
        $grupo->tScore->converterParaTScore($grupo->rowScore);
        $grupo->grafico = Grafico::gerar($grupo->tScore, $grupo->rowScore);

        return $grupo;

    }

}