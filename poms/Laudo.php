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

    /**
     * Laudo 02 - Fadiga-Inérica
     */
    function laudo02() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Ânimo com alteração nos Fatores:  ";
        $this->titulo_a3 = "Fadiga-Inérica, 'Perfil Iceberg' - ao lado";
        $this->corpo     = "Esse 'Perfil Iceberg' é de uma pessoa que está com dificuldade de agir normalmente para "
            . "levar adiante suas atividades profissionais e pessoais.  O fator FADIGA-INÉRCIA mostra-se com índices de "
            . "energias afetivas relacionais acima dos 50% quando comparado com os demais fatores (tensão-ansiedade, "
            . "depressão-melancolia, agressividade-cólera, vigor afetividade, confusão-desorientação) que constituem o "
            . "Perfil Iceberg. Esse perfil é de uma pessoa que está se comportando impelida por níveis de energias "
            . "afetiva-relacionais orientados de maneira negativa. Significa que o fator fadiga-inércia está distante "
            . "da média populacional - a pessoa está agindo com pouca disposição para levar adiante suas atividades "
            . "pessoais e profissionais devido a oscilação de estados de ânimo gerados pela apatia, cansaço e "
            . "esgotamento físico e mental.  Indica que o nível de cansaço físico e mental da pessoa é alto.  "
            . "Há necessidade, por conseguinte, que o instrumento 'Poms' seja reaplicado em momentos diferentes para "
            . "observar se esse estado de humor/ânimo se repete no transcorrer de semanas.  O resultados obtidos, "
            . "portanto, estão indicando que o ritmo de trabalho da pessoa está comprometido por um baixo nível de "
            . "concentração, apatia e esgotamento físico e mental.";
        return "fadiga-inercia";
    }

    /**
     * Laudo 03 - Confusão-Desorientação
     */
    function laudo03() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Ânimo com alteração nos Fatores:  ";
        $this->titulo_a3 = "Confusão-Desorientação, 'Perfil Iceberg' - ao lado";
        $this->corpo     = "Indica que a pessoa situcionalmente está com dificuldade de agir normalmente para levar "
            . "adiante suas atividades profissionais e pessoais. Isto significa que o fator CONFUSÃO-DESORIENTAÇÃO "
            . "mostra-se com índices de energias afetivas relacionais preocupantes em relação aos demais fatores "
            . "(tensão-ansiedade; depressão-melancolia; agressividade-cólera; vigor afetividade e fadiga-inércia) que "
            . "constituem o Perfil Iceberg e da média populacional. Esse perfil Iceberg mostra que a pessoa está "
            . "mantendo um padrão de comportamento caracterizado por estados de humor/ ânimo, impelidos por "
            . "'atordoamentos' (estados de ansiedade, depressão ou emocionais relacionados) em suas habilidades de "
            . "lidar com problemas.  Está apresentando oscilação de estados de humor/ânimo para levar adiante uma "
            . "sequência de ações com altos padrões de realização para si e para seus companheiros de trabalho. Está "
            . "menos afetiva e com dificuldade de se ajustar as mudanças comportamentais norteadas por um alto nível "
            . "de confiança e menos interessado em seu trabalho e na concretização de seus objetivos. Seu ritmo de "
            . "trabalho está comprometido pela insatisfação profissional, por sentimento de culpa, desânimo, baixa "
            . "energia de resistência física e esgotamento emocional, com facilidade ao isolamento pessoal, grupal e "
            . "institucional quando colocado em situações que exigem um alto padrão de realização para si mesmo e para "
            . "seus companheiros.";
        return "confusao-desorientacao";
    }

    /**
     * Laudo 04 - Depressão-Melancolia
     */
    function laudo04() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Ânimo com alteração nos Fatores:  ";
        $this->titulo_a3 = "Depressão-Melancolia, 'Perfil Iceberg' - ao lado";
        $this->corpo     = "Esse 'Perfil Iceberg' indica que a pessoa está situacionalmente com dificuldade de agir "
            . "normalmente para levar adiante suas atividades profissionais e pessoais.  O fator DEPRESSÃO-MELANCOLIA, "
            . "mostra-se com índices de energias afetivas relacionais preocupantes em relação aos demais fatores "
            . "(tensão-ansiedade, agressividade-cólera, vigor afetividade, confusão-desorientação, fadiga-inércia). "
            . "Os escores dos níveis de energias estão acima dos 50% quando comparado com os demais que determinam o "
            . "'Perfil Iceberg' dentro da média populacional.  Indica que a pessoa situacionalmente está mantendo um "
            . "padrão de comportamento com alto nível de energia canalizada de forma negativa, através da sensação de "
            . "depressão e confusão, acompanhado por dificuldade de ajustamento, isolamento pessoal e sentimento de "
            . "tristeza e de culpa que merecem ser investigados. Esse perfil mostra que o ritmo de trabalho dessa "
            . "pessoa está comprometido por uma inadequação pessoal quando colocado em situações que exigem um alto "
            . "padrão de realização em relação a si mesmo e aos seus companheiros.";
        return "depressao-melancolia";
    }

    /**
     * Laudo 05 - Tensão-Ansiedade
     */
    function laudo05() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Ânimo com alteração nos Fatores:  ";
        $this->titulo_a3 = "Tensão-Ansiedade, 'Perfil Iceberg' - ao lado";
        $this->corpo     = "Esse 'Perfil Iceberg' indica que a pessoa situacionalmente está com dificuldade de agir "
            . "normalmente para levar adiante suas atividades profissionais e pessoais.  Os escores acima dos 50% "
            . "encontrados no fator TENSÃO-ANSIEDADE, quando comparado com os demais fatores (agressividade-cólera, "
            . "vigor afetividade, confusão-desorientação, depressão-melancolia, fadiga-inércia), que configuram o "
            . "\"Perfil Iceberg\", estão fora da média populacional. Esses resultados indicam que a pessoa está "
            . "mantendo um padrão de comportamento preocupante devido a uma alta concentração de energia afetiva "
            . "relacional canalizada de forma negativa, através da raiva e da tensão, prejudicando o desenvolvimento "
            . "de suas atividades profissionais e pessoais, que merecem ser investigados mais profundamente.  A pessoa "
            . "avaliada está apresentando oscilação de estados de humor/ânimo e com fortes tendências comportamentais "
            . "para reagir com individualidade e irritabilidade diante de situações imprevistas. Esse perfil mostra que "
            . "o ritmo de trabalho dessa pessoa está comprometido por uma inadequação pessoal quando colocado em "
            . "situações que exigem melhor absorção de conteúdos afetivos relacionais para não prejudicar o "
            . "desenvolvimento de suas atividades pessoais e profissionais.";
        return "tensao-ansiedade";
    }

    /**
     * Laudo 06 - Agressividade-Cólera
     */
    function laudo06() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Ânimo com alteração nos Fatores:  ";
        $this->titulo_a3 = "Agressividade-Cólera, 'Perfil Iceberg' - ao lado";
        $this->corpo     = "Esse 'Perfil Iceberg' indica que a pessoa está com dificuldade de agir normalmente para "
            . "levar adiante suas atividades profissionais e pessoais.  Os escores acima dos 50% encontrados no fator "
            . "AGRESSIVIDADE-CÓLERA, está fora da média populacional. Esses índices quando comparados com o demais "
            . "fatores (vigor afetividade, tensão-ansiedade, confusão-desorientação, depressão-melancolia, "
            . "fadiga-inércia) que configuram o 'Perfil Iceberg'. Indicam que a pessoa está mantendo um padrão de "
            . "comportamento preocupante devido a uma alta concentração de energia afetiva relacional canalizada de "
            . "forma negativa, apresentando oscilação de estados de humor, e um acentuado nível de resistência para "
            . "lidar com mudanças para agir normalmente e desenvolver suas atividades profissionais e pessoais.  "
            . "É uma pessoa com fortes tendências comportamentais para ficar aborrecido, irritado e para agir com "
            . "individualidade quando está sob pressão no meio social ambiental.  Uma pessoa impulsionada por oscilação "
            . "de estados de humor/ânimo quando colocada diante de situações que exijam habilidade para tomar decisões "
            . "e assumir responsabilidades por elas. Seu ritmo de trabalho está situacionalmente comprometido pela "
            . "inadequação pessoal quando colocado em situações que exigem melhor absorção de conteúdos afetivos "
            . "relacionais sob certas circunstâncias do seu dia-a-dia.";
        return "agressividade-colera";
    }

    /**
     * Laudo 07 - Tensão e raiva
     */
    function laudo07() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Ânimo com alteração nos Fatores:  ";
        $this->titulo_a3 = "Tensão-Raiva, 'Perfil Iceberg' - ao lado";
        $this->corpo     = "Esse 'Perfil Iceberg' é de uma pessoa que não está se comportando normalmente para levar "
            . "adiante suas atividades profissionais e pessoais. Apresenta situacionalmente um 'Perfil Iceberg' com "
            . "índices preocupantes em relação ao seu estado de humor/ânimo. Os índices de energia - acima de 70% - "
            . "encontrados no fator TENSÃO-RAIVA (definido como alta tensão musculoesquelética) se encontram fora da "
            . "média populacional. Esses índices indicam que a pessoa está situacionalmente se comportando com fortes "
            . "tendências a estados de humor/ânimo relacionados com atitudes e condutas antipática e raiva em relação "
            . "às demais pessoas e a si mesmo. Apresentando sentimentos de hostilidade e reagindo com elevado nível de "
            . "estresse, revelando possível comprometimento no desenvolvimento de suas atividades profissionais/pessoais. "
            . "Está se comportando de forma desajustada no desenvolvimento de suas atividades laborais posicionadas "
            . "pela demanda exigida no exercício de sua função profissional atual. Seus sentimentos e reações às "
            . "situações estressantes oscilam com irritabilidade e desanimo quando submetido à discordância em "
            . "situações de adversidade pessoais, grupais e institucionais, especialmente diante de situações "
            . "repetitivas. Seu ritmo de trabalho, por conseguinte, está sendo comprometido pela inadequação pessoal "
            ." quando colocado em situações que exigem melhor absorção de conteúdos afetivos relacionais no seu dia-a-dia.";
        return "tensao-raiva";
    }

    function laudoDesconhecido() {
        $this->titulo_a1 = "Parecer Psicológico";
        $this->titulo_a2 = "Estado de Humor / Laudo desconhecido ";
        $this->titulo_a3 = "";
        $this->corpo     = "";
        return "Laudo desconhecido";
    }

}