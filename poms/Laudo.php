<?php

class Laudo {

    function __construct($linha_corte=50) {
        # O padrão é 50
        $c = $this->linha_corte = $linha_corte;
    }

    function getNumero($ts) {
        $c = $this->linha_corte;
        $maior_fator = $this->retMaiorFator($ts);


        if ($ts->tensao < $c && $ts->depressao < $c &&  $ts->raiva < $c && $ts->vigor > $c && $ts->fadiga < $c &&  $ts->confusao < $c) {
            # se todos < 50 menos e vigor > 50
            return $this->laudo01();
        } else if ($maior_fator == "fadiga") {
            return $this->laudo02();
        } else if ($maior_fator == "confusao") {
            return $this->laudo03();
        } else if ($maior_fator == "depressao") {
            return $this->laudo04();
        } else if ($maior_fator == "tensao" && $ts->raiva < 70) {
            return $this->laudo05();
        } else if ($maior_fator == "raiva" && $ts->tensao < 70) {
            return $this->laudo06();
        } else if ($ts->tensao > 70 && $ts->raiva > 70) {
            return $this->laudo07();
        } else {
            return $this->laudoDesconhecido();
        }
    }

    function retMaiorFator($tscore) {
        # cria um array sem o fator 'vigor'
        $arr = array(
            "tensao"    => $tscore->tensao,
            "depressao" => $tscore->depressao,
            "raiva"     => $tscore->raiva,
            # "vigor"   => $tscore->vigor,
            "fadiga"    => $tscore->fadiga,
            "confusao"  => $tscore->confusao
        );

        # anota o maior fator
        $maior_valor = max($arr);

        $maior_fator = "";
        foreach ($arr as $key => $value) {
            if ($maior_valor == $value) {
                $maior_fator = $key;
            }
        }

        return $maior_fator;
    }

    /**
     * Laudo 01 - Ânimo Ótimo
     */
    function laudo01() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Ánimo Ótimo - ";
        $this->titulo_a3 = "'Perfil Iceberg' - ao lado";
        $this->corpo     = "Indica que a pessoa avaliada apresenta um Estados de Humor/ Ánimo com índices de energias "
            . "afetivas dentro da média populacional e com disposição para agir e lidar normalmente para "
            . "levar adiante suas atividades pessoais e profissionais. Indica que os seis fatores "
            . "(vigor-afetividade, tensão-ansiedade, depressao-melancolia; agressividade-cólera, "
            . "fadiga-inércia e confusão-desorientação) que constituem o \"Perfil Iceberg\" estão com índices "
            . "de energias afetivas relacionais capazes de levar a pessoa a manter um padrão de comportamento "
            . "caracterizado por autodomínio, autoconfiança e autonomia de competência para superar obstáculos "
            . "impelida por estados de ánimo/humor estáveis e com pouca oscilação. De uma pessoa confiante, "
            . "animada e produtiva com impulso competitivo, determinada a fazer com que as coisas aconteçam. "
            . "Esse Perfil Iceberg representa que a pessoa está agindo normalmente ao fazer as coisas no seu "
            . "dia-a-dia e adaptando-se às condições de mudanças no meio social ambiental e com impulso para "
            . "tomar decisões, assumir riscos visando melhor aproveitamento do seu perfil pessoal e profissional.";
        return "vigor-otimo";
    }

    function laudo02() {
        return "fadiga-inercia";
    }

    function laudo03() {
        return "confusao-desorientacao";
    }

    function laudo04() {
        return "depressao-melancolia";
    }

    function laudo05() {
        return "tensao-ansiedade";
    }

    function laudo06() {
        return "agressividade-colera";
    }

    function laudo07() {
        return "tensao-raiva";
    }

    function laudoDesconhecido() {
        return "Laudo desconhecido";
    }

}