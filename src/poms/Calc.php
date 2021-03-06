<?php

/**
 * Class para calcular o resultado do POMS
 */
class Calc {

    /**
     * Para calcular o perfil Poms
     */
    static function perfilPoms($stringFormulario) {
        $perfil = new Calc();
        $perfil->rowScore = $perfil->rowScore($stringFormulario);
        $perfil->tScore   = $perfil->tScore($perfil->rowScore);
        return $perfil;
    }

    /**
     * Devemos passar a string que vem do formulário, ex: "1-5, 2-3, 3-3, etc..."
     *
     * @param type $stringFormulario
     * @return \RowScore
     */
    function rowScore($stringFormulario) {

        $rowScore = new RowScore();
        $arrAlternativas = $rowScore->separarStringFormulario($stringFormulario);

        # Percorremos um array por exemplo array(
        #   "1-5",
        #   "2-4",
        #   "3-5",
        #   "4-3",
        #   etc...
        # )
        foreach($arrAlternativas as $strCadaAlternativa){

            # $strCadaAlternativa = '3-5'
            # $fator = 3
            # $valor = 5 - 1 ( o 'menos um' é a correção)
            $id    = $rowScore->retIdFator($strCadaAlternativa);
            $fator = $rowScore->retFator($id);
            $valor = $rowScore->retValorFator($strCadaAlternativa);
            $valor_corrigido = $rowScore->corrigirValor($valor);

            $rowScore->$fator = $rowScore->calcularValor($id, $fator, $valor_corrigido);

        }

        return $rowScore;
    }

    /**
     * Após calculado o rowScore devemos montar o TScore
     */
    function tScore($rowScore) {
        $tScore = new TScore();
        $tScore->converterParaTScore($rowScore);
        return $tScore;
    }

}
