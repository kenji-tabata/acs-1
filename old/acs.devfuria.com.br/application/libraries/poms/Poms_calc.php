<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poms_calc {

    public $row_score;
    public $tscore;

    function setResultados($resultado) {

        $this->_setRowScores($resultado);
        $this->_setTScores($resultado);
    }

    private function _setRowScores($resultado) {

        # Inicia variáveis
        $relacao = $this->_setRelacao();

        $rowscore = array(
            "tensao" => 0,
            "depressao" => 0,
            "raiva" => 0,
            "vigor" => 0,
            "fadiga" => 0,
            "confusao" => 0
        );

        foreach ($resultado as $id_teste => $valor_teste) {

            $valor_teste--; # valor real
            $fator = $relacao[$id_teste]; # A que fator refere-se as alternativas?
            # Um pequeno ajuste
            $somar = TRUE;
            if ($id_teste == 22 || $id_teste == 54)
                $somar = NULL;

            /*
             * Operação
             */
            # Somar
            if ($somar) {
                $rowscore[$fator] += $valor_teste;
            }
            # Subtrair
            else {
                $rowscore[$fator] -= $valor_teste;
                $rowscore[$fator] += 4;
                $somar = TRUE;
            }
        }

        # Atribuição final
        $this->row_score->tensao = $rowscore['tensao'];
        $this->row_score->depressao = $rowscore['depressao'];
        $this->row_score->raiva = $rowscore['raiva'];
        $this->row_score->vigor = $rowscore['vigor'];
        $this->row_score->fadiga = $rowscore['fadiga'];
        $this->row_score->confusao = $rowscore['confusao'];
    }

    private function _setRelacao() {
        return array(
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
    }

    private function _setTScores() {

        # Inicia variáveis
        $relTW = $this->_setRelTW();


        # Relaciona
        $key = $this->row_score->tensao;
        if (array_key_exists($key, $relTW['tensao']))
            $this->tscore->tensao = $relTW['tensao'][$key];

        $key = $this->row_score->depressao;
        if (array_key_exists($key, $relTW['depressao']))
            $this->tscore->depressao = $relTW['depressao'][$key];

        $key = $this->row_score->raiva;
        if (array_key_exists($key, $relTW['raiva']))
            $this->tscore->raiva = $relTW['raiva'][$key];

        $key = $this->row_score->vigor;
        if (array_key_exists($key, $relTW['vigor']))
            $this->tscore->vigor = $relTW['vigor'][$key];

        $key = $this->row_score->fadiga;
        if (array_key_exists($key, $relTW['fadiga']))
            $this->tscore->fadiga = $relTW['fadiga'][$key];

        $key = $this->row_score->confusao;
        if (array_key_exists($key, $relTW['confusao']))
            $this->tscore->confusao = $relTW['confusao'][$key];
    }

    private function _setRelTW() {
        # Esquema:
        # relTW['fator'][rwascore] = tscore;

        $relTW['tensao'] = array(
            0 => 40,
            1 => 43,
            2 => 44,
            3 => 45,
            4 => 46,
            5 => 48,
            6 => 49,
            7 => 52,
            8 => 53,
            9 => 55,
            10 => 57,
            11 => 59,
            12 => 60,
            13 => 13,
            14 => 63,
            15 => 65,
            16 => 66,
            17 => 67,
            18 => 70,
            19 => 72,
            20 => 73,
            21 => 75,
            22 => 76,
            23 => 78,
            24 => 80,
            25 => 82,
            26 => 83,
            27 => 85,
            28 => 86,
            29 => 89,
            30 => 90,
            31 => 93,
            32 => 94,
            33 => 95,
            34 => 98,
            35 => 99,
            36 => 100
        );

        $relTW['depressao'] = array(
            0 => 40,
            1 => 41,
            2 => 42,
            3 => 43,
            4 => 44,
            5 => 45,
            6 => 46,
            7 => 47,
            8 => 48,
            9 => 49,
            10 => 50,
            11 => 51,
            12 => 52,
            13 => 53,
            14 => 54,
            15 => 55,
            16 => 56,
            17 => 57,
            18 => 58,
            19 => 59,
            20 => 60,
            21 => 61,
            22 => 62,
            23 => 63,
            24 => 64,
            25 => 65,
            26 => 66,
            27 => 67,
            28 => 68,
            29 => 69,
            30 => 70,
            31 => 71,
            32 => 72,
            33 => 73,
            34 => 74,
            35 => 75,
            36 => 76,
            37 => 77,
            38 => 78,
            39 => 79,
            40 => 80,
            41 => 81,
            42 => 82,
            43 => 83,
            44 => 84,
            45 => 85,
            46 => 86,
            47 => 87,
            48 => 88,
            49 => 89,
            50 => 90,
            51 => 91,
            52 => 92,
            53 => 93,
            54 => 94,
            55 => 95,
            56 => 96,
            57 => 97,
            58 => 98,
            59 => 99,
            60 => 100
        );

        $relTW['raiva'] = array(
            0 => 40,
            1 => 41,
            2 => 42,
            3 => 43,
            4 => 45,
            5 => 46,
            6 => 47,
            7 => 49,
            8 => 50,
            9 => 51,
            10 => 53,
            11 => 54,
            12 => 55,
            13 => 56,
            14 => 57,
            15 => 58,
            16 => 60,
            17 => 61,
            18 => 62,
            19 => 63,
            20 => 65,
            21 => 66,
            22 => 67,
            23 => 68,
            24 => 70,
            25 => 71,
            26 => 72,
            27 => 73,
            28 => 75,
            29 => 76,
            30 => 77,
            31 => 78,
            32 => 80,
            33 => 81,
            34 => 82,
            35 => 83,
            36 => 85,
            37 => 86,
            38 => 87,
            39 => 88,
            40 => 90,
            41 => 91,
            42 => 92,
            43 => 93,
            44 => 95,
            45 => 96,
            46 => 97,
            47 => 98,
            48 => 100
        );

        $relTW['vigor'] = array(
            0 => 40,
            1 => 41,
            2 => 43,
            3 => 44,
            4 => 45,
            5 => 46,
            6 => 47,
            7 => 48,
            8 => 49,
            9 => 50,
            10 => 51,
            11 => 52,
            12 => 53,
            13 => 54,
            14 => 55,
            15 => 56,
            16 => 57,
            17 => 58,
            18 => 59,
            19 => 60,
            20 => 61,
            21 => 63,
            22 => 64,
            23 => 65,
            24 => 66,
            25 => 67,
            26 => 68,
            27 => 69,
            28 => 70,
            29 => 71,
            30 => 72,
            31 => 73,
            32 => 74,
            33 => 75,
            34 => 76,
            35 => 77,
            36 => 78,
            37 => 80,
            38 => 81,
            39 => 82,
            40 => 83,
            41 => 84,
            42 => 85,
            43 => 86,
            44 => 87,
            45 => 88,
            46 => 89,
            47 => 90,
            48 => 91,
            49 => 92,
            50 => 93,
            51 => 94,
            52 => 95,
            53 => 96,
            54 => 97,
            55 => 98,
            56 => 100
        );

        $relTW['fadiga'] = array(
            0 => 40,
            1 => 41,
            2 => 42,
            3 => 43,
            4 => 46,
            5 => 50,
            6 => 54,
            7 => 55,
            8 => 56,
            9 => 58,
            10 => 60,
            11 => 63,
            12 => 66,
            13 => 69,
            14 => 70,
            15 => 71,
            16 => 73,
            17 => 75,
            18 => 77,
            19 => 79,
            20 => 82,
            21 => 85,
            22 => 87,
            23 => 89,
            24 => 91,
            25 => 93,
            26 => 95,
            27 => 97,
            28 => 100
        );

        $relTW['confusao'] = array(
            0 => 40,
            1 => 43,
            2 => 46,
            3 => 49,
            4 => 51,
            5 => 53,
            6 => 55,
            7 => 57,
            8 => 60,
            9 => 63,
            10 => 66,
            11 => 68,
            12 => 70,
            13 => 71,
            14 => 72,
            15 => 76,
            16 => 80,
            17 => 84,
            18 => 85,
            19 => 86,
            20 => 87,
            21 => 90,
            22 => 94,
            23 => 99,
            24 => 100
        );
        return $relTW;
    }

}

/* End of file Poms_calc.php */