<?php

/**
 * Classe que abstrai a pontuação row-score do método Poms
 */
class RowScore {

    public $vigor     = 0;
    public $tensao    = 0;
    public $raiva     = 0;
    public $confusao  = 0;
    public $fadiga    = 0;
    public $depressao = 0;

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

    /**
     * O calculo consiste em somar o valor escolhido no formulário
     * A exceção é para as alternativas 22 e 54
     *
     * @param type $id
     * @param type $fator
     * @param type $valor
     * @return type
     */
    function calcularValor($id, $fator, $valor) {
        if($id == 22 || $id == 54){
            return $this->subtrairSomaQuatro($fator, $valor);
        } else {
            return $this->somar($fator, $valor);
        }
    }

    /**
     * Soma de forma comulativa
     */
    public function somar($fator, $valor) {
        return $this->$fator + $valor;
    }

    /**
     * Subtrai o valor e soma 4
     *
     * @param type $fator
     * @param type $valor
     * @return type
     */
    public function subtrairSomaQuatro($fator, $valor) {
        return $this->$fator - $valor + 4;
    }

    /**
     * O valor escolhido no formulário deve ser subtraído
     * um unidade.
     *
     * entrada | saída
     *    1        0
     *    2        1
     *    3        2
     *    4        3
     *    5        4
     *
     * @param type $valor
     * @return type
     */
    public function corrigirValor($valor) {
        return $valor - 1;
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
     * Eis a relação das alternativas e os fatores
     * A 'key' deve ser equivalente ao formulário
     *
     * @param type $key
     * @return string
     */
    public function retFator($key) {
        $relacao = array(
            0 => "",
            1 => "vigor",
            2 => "tensao",
            3 => "raiva",
            4 => "fadiga",
            5 => "depressao",
            6 => "vigor",
            7 => "vigor",
            8 => "confusao",
            9 => "depressao",
            10 => "tensao",
            11 => "fadiga",
            12 => "raiva",
            13 => "tensao",
            14 => "depressao",
            15 => "vigor",
            16 => "tensao",
            17 => "raiva",
            18 => "depressao",
            19 => "vigor",
            20 => "tensao",
            21 => "depressao",
            22 => "tensao",
            23 => "depressao",
            24 => "raiva",
            25 => "vigor",
            26 => "tensao",
            27 => "tensao",
            28 => "confusao",
            29 => "fadiga",
            30 => "vigor",
            31 => "raiva",
            32 => "depressao",
            33 => "raiva",
            34 => "tensao",
            35 => "depressao",
            36 => "depressao",
            37 => "confusao",
            38 => "vigor",
            39 => "raiva",
            40 => "fadiga",
            41 => "tensao",
            42 => "raiva",
            43 => "vigor",
            44 => "depressao",
            45 => "depressao",
            46 => "fadiga",
            47 => "raiva",
            48 => "depressao",
            49 => "fadiga",
            50 => "confusao",
            51 => "vigor",
            52 => "raiva",
            53 => "raiva",
            54 => "confusao",
            55 => "vigor",
            56 => "vigor",
            57 => "raiva",
            58 => "depressao",
            59 => "confusao",
            60 => "vigor",
            61 => "depressao",
            62 => "depressao",
            63 => "vigor",
            64 => "confusao",
            65 => "fadiga"
        );

        return $relacao[$key];
    }

}
