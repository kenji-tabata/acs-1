<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Real_equipe_calc {

    private $res_form;      # entra com o resultado do formulário(array)
    public $resultado;      # sai com um resultado(array)
    
    function setResultado($str_resultado) {
        $this->res_form = $str_resultado;
        $this->calc();
    }
    
    private function calc(){
        
        # inicia variáveis
        $resultado = array();
        $resultado['rh'] = 0;
        $resultado['et'] = 0;
        $resultado['per']= 0;
        $resultado['rec']= 0;
        $resultado['int'] = 0;
        $resultado['tof'] = 0;        
        $temp      = array();
        
        # ordena o array
        $temp = $this->res_form;
        ksort($temp);

        # calcula
        foreach($temp as $id_dimensao => $valor_dimensao){
            
            if($id_dimensao >= 1 && $id_dimensao <= 10)
                $resultado['rh'] += $valor_dimensao;
            
            if($id_dimensao >= 11 && $id_dimensao <= 20)
                $resultado['et'] += $valor_dimensao;
            
            if($id_dimensao >= 21 && $id_dimensao <= 30)
                $resultado['per'] += $valor_dimensao;
            
            if($id_dimensao >= 31 && $id_dimensao <= 35)
                $resultado['rec'] += $valor_dimensao;
            
            if($id_dimensao >= 36 && $id_dimensao <= 40)
                $resultado['int'] += $valor_dimensao;
            
            if($id_dimensao >= 41 && $id_dimensao <= 50)
                $resultado['tof'] += $valor_dimensao;
        }
//        var_dump($resultado);die();
        
        $this->resultado = $resultado;
        
    }


}/* End of file Poms_calc.php */