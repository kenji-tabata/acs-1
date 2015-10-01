<?php

/**
 * Class para calcular o resultado do POMS
 */
class Calc {

    /**
     * Método principal
     * 
     * Devemos passar a string que vem do formulário, ex: "1-5, 2-3, 3-3, etc..."
     * 
     * @param type $stringFormulario
     * @return \RowScore
     */
    function rowScore($stringFormulario) {

        $rowScore = new RowScore();
        $arrAlternativas = $this->separarStringFormulario($stringFormulario);
        
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
            $id    = $this->retIdFator($strCadaAlternativa);
            $fator = $rowScore->retFator($id);
            $valor = $this->retValorFator($strCadaAlternativa);
            $valor_corrigido = $rowScore->corrigirValor($valor);

            $rowScore->$fator = $rowScore->calcularValor($id, $fator, $valor_corrigido);
            
        }
        return $rowScore;
    }
    
    /**
     * Retorna o id do fator
     * 
     * retIdFator('10-2') == 10
     * 
     * @param type $strIdValor
     * @return type
     */
    function retIdFator($strIdValor) {
        $arr = explode("-", $strIdValor);
        return $arr[0];
    }

    /**
     * Retorna o valor do fator
     * 
     * retIdFator('10-2') == 2
     * 
     * @param type $strIdValor
     * @return type
     */
    function retValorFator($strIdValor) {
        $arr = explode("-", $strIdValor);
        return $arr[1];
    }

    /**
     * Pegamos "aquela string grandona" que vem 
     * do formulário e quebramos em um array.
     * 
     * separarStringFormulario('1-5, 2-3, 3-3') == array('1-5', '2-3', '3-3')
     * 
     * @param type $stringFormulario
     * @return type
     */
    function separarStringFormulario($stringFormulario) {
        return explode(", ", $stringFormulario);
    }

}
