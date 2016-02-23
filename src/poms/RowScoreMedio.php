<?php

require_once dirname(__FILE__) . "/RowScore.php";

/**
 * Classe que abstrai a pontuação row-score médio do método Poms
 */
class RowScoreMedio {

    public $vigor     = 0;
    public $tensao    = 0;
    public $raiva     = 0;
    public $confusao  = 0;
    public $fadiga    = 0;
    public $depressao = 0;

    function calcular($grupo) {
        $rowScoreSoma  = new RowScore;

        foreach ($grupo as $profissional) {
            $rowScoreSoma->tensao    += $profissional->rowScore->tensao;
            $rowScoreSoma->depressao += $profissional->rowScore->depressao;
            $rowScoreSoma->raiva     += $profissional->rowScore->raiva;
            $rowScoreSoma->vigor     += $profissional->rowScore->vigor;
            $rowScoreSoma->fadiga    += $profissional->rowScore->fadiga;
            $rowScoreSoma->confusao  += $profissional->rowScore->confusao;
        }

        $divisor = count($grupo);

        $this->tensao    = $rowScoreSoma->tensao    / $divisor;
        $this->depressao = $rowScoreSoma->depressao / $divisor;
        $this->raiva     = $rowScoreSoma->raiva     / $divisor;
        $this->vigor     = $rowScoreSoma->vigor     / $divisor;
        $this->fadiga    = $rowScoreSoma->fadiga    / $divisor;
        $this->confusao  = $rowScoreSoma->confusao  / $divisor;
    }
}