<?php

/* Pega a string de resultado  ex: '1_3, 2_4, 3_5 etc...'
 * e retorna um array ex: $array ('1' => '3', '2' => '4', '3' => '5' etc..)
 * 
 *  @access	 public
 *  @param	 string
 *  @return      array
 */
function _str_resultado_to_array($str_resultado) {
    $questoes = explode(',', $str_resultado);
    $array_resultado = array();

    foreach ($questoes as $valor) {
        $pontuacao = explode('_', trim($valor));
        $array_resultado[$pontuacao[0]] = $pontuacao[1];
    }

    return $array_resultado;
}

/* Pega um array ex: $array ('1' => '3', '2' => '4', '3' => '5' etc..) e um inteiro com a quantidade de elementos do array
 * e retorna uma array com uma string de resultado ex: '1_3, 2_4, 3_5 etc...' e um valor para validacao que retorna true,
 * caso haja um valor em branco[ex: $array ('1' => '')] e false caso contrario.
 * 
 *  @access	 public
 *  @param	 array, int
 *  @return      string
 */
function _array_to_str_resultado($array_resultado, $qtde_elementos) {
    $str_resultado = '';
    $valor_vazio   = false;

    foreach ($array_resultado as $nr_questao => $valor) {
        if(empty($valor))
            $valor_vazio = true;
        $str_resultado .= ($nr_questao == $qtde_elementos) ? $nr_questao.'_'.$valor : $nr_questao.'_'.$valor.', ';
    }
    $data['str_resultado'] = $str_resultado;
    $data['valor_vazio']   = $valor_vazio;

    return $data;
}
