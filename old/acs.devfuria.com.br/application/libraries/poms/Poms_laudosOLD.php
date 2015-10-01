<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poms_laudos {
    

    /**
     * Retorna o laudo conforme o tscore
     * 
     * @param type $tscore
     * @return type
     */
    public function getLaudo($tscore) {
        define("LINHA_CORTE", 50);
        $maior_fator = $this->retMaiorFator($tscore);
//        var_dump($maior_fator); die();
                
        # se todos < 50 menos vigor retorna laudo 01
        if (
                $tscore->tensao < LINHA_CORTE &&
                $tscore->depressao < LINHA_CORTE &&
                $tscore->raiva < LINHA_CORTE &&
                $tscore->vigor > LINHA_CORTE &&
                $tscore->fadiga < LINHA_CORTE &&
                $tscore->confusao < LINHA_CORTE
        ) {
            return $this->Laudo01AnimoOtimo();
        } 
        # se maior for fadiga
        else if ($maior_fator == "fadiga"){
            return $this->Laudo02FadigaInercia();
        }
        # se maior for confusão
        else if ($maior_fator == "confusao"){
            return $this->Laudo03ConfusaoDesorientacao();
        }
        # se maior for depressao
        else if ($maior_fator == "depressao"){
            return $this->Laudo04DepressaoMelancolia();
        }
        # se maior for tensao
        else if ($maior_fator == "tensao" && $tscore->raiva < 70){
            return $this->Laudo05TensaoAnsiedade();
        }
        # se maior for raiva
        else if ($maior_fator == "raiva" && $tscore->tensao < 70){
            return $this->Laudo06AgressividadeColera();
        }
        # se maior for raiva
        else if ($tscore->tensao > 70 && $tscore->raiva > 70){
            return $this->Laudo07TensaoRaiva();
        }
        # desconhecido
        else { 
            return array(
                "titulo-1" => "Estado de Humor desconhecido",
                "titulo-2" => "",
                "corpo" => "",
            );
        }
    }

    
    /**
     *  Retorna o fator de maior valor
     *  
     * @param type $tscore
     * @return type
     */
    private function retMaiorFator($tscore) {
        # cria um array
        $arr = array(
            "tensao" => $tscore->tensao,
            "depressao" => $tscore->depressao,
            "raiva" => $tscore->raiva,
//            "vigor" => $tscore->vigor, # o vigor não entra na conta
            "fadiga" => $tscore->fadiga,
            "confusao" => $tscore->confusao
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
     * Laudo 01
     * 
     * @return type
     */
    private function Laudo01AnimoOtimo(){
        return array(
            "titulo-1" => "Estado de Humor / Ánimo Ótimo - ",
            "titulo-2" => "'Perfil Iceberg' - ao lado",
            "corpo" => "Indica que a pessoa avaliada apresenta um Estados de Humor/ Ánimo com índices de energias afetivas dentro da média populacional e com disposição para agir e lidar normalmente para levar adiante suas atividades pessoais e profissionais. Indica que os seis fatores (vigor-afetividade, tensão-ansiedade, depressao-melancolia; agressividade-cólera, fadiga-inércia e confusão-desorientação) que constituem o \"Perfil Iceberg\" estáo com índices de energias afetivas relacionais capazes de levar a pessoa a manter um padrão de comportamento caracterizado por autodomínio, autoconfiança e autonomia de competência para superar obstáculos impelida por estados de ánimo/humor estáveis e com pouca oscilação. De uma pessoa confiante, animada e produtiva com impulso competitivo, determinada a fazer com que as coisas aconteçam. Esse Perfil Iceberg representa que a pessoa está agindo normalmente ao fazer as coisas no seu dia-a-dia e adaptando-se às condições de mudanças no meio social ambiental e com impulso para tomar decisões, assumir riscos visando melhor aproveitamento do seu perfil pessoal e profissional.",
        );
    }

    /**
     * Laudo 02
     * 
     * @return type
     */
    private function Laudo02FadigaInercia(){
        return array(
            "titulo-1" => "Estado de Humor / Ânimo com alteração nos Fatores - ",
            "titulo-2" => "Fadiga-Inérica 'Perfil Iceberg' - ao lado",
            "corpo" => "Esse 'Perfil Iceberg' é de uma pessoa que está com dificuldade de agir normalmente para levar adiante suas atividades profissionais e pessoais.  O fator FADIGA-INÉRCIA mostra-se com índices de energias afetivas relacionais acima dos 50% quando comparado com os demais fatores (tensão-ansiedade, depressão-melancolia, agressividade-cólera, vigor afetividade, confusão-desorientação) que constituem o Perfil Iceberg. Esse perfil é de uma pessoa que está se comportando impelida por níveis de energias afetiva-relacionais orientados de maneira negativa. Significa que o fator fadiga-inércia está distante da média populacional – a pessoa está agindo com pouca disposição para levar adiante suas atividades pessoais e profissionais devido a oscilação de estados de ânimo gerados pela apatia, cansaço e esgotamento físico e mental.  Indica que o nível de cansaço físico e mental da pessoa é alto.  Há necessidade, por conseguinte, que o instrumento 'Poms' seja reaplicado em momentos diferentes para observar se esse estado de humor/ânimo se repete no transcorrer de semanas.  O resultados obtidos, portanto, estão indicando que o ritmo de trabalho da pessoa está comprometido por um baixo nível de concentração, apatia e esgotamento físico e mental.",
        );
    }

    /**
     * Laudo 03
     * 
     * @return type
     */
    private function Laudo03ConfusaoDesorientacao(){
        return array(
            "titulo-1" => "Estado de Humor / Ânimo com alteração nos Fatores - ",
            "titulo-2" => "Confusão-Desorientação - 'Perfil Iceberg' - ao lado",
            "corpo" => "Indica que a pessoa situcionalmente está com dificuldade de agir normalmente para levar adiante suas atividades profissionais e pessoais. Isto significa que o fator CONFUSÃO-DESORIENTAÇÃO mostra-se com índices de energias afetivas relacionais preocupantes em relação aos demais fatores (tensão-ansiedade; depressão-melancolia; agressividade-cólera; vigor afetividade e fadiga-inércia) que constituem o Perfil Iceberg e da média populacional. Esse perfil Iceberg mostra que a pessoa está mantendo um padrão de comportamento caracterizado por estados de humor/ ânimo, impelidos por 'atordoamentos' (estados de ansiedade, depressão ou emocionais relacionados) em suas habilidades de lidar com problemas.  Está apresentando oscilação de estados de humor/ânimo para levar adiante uma sequência de ações com altos padrões de realização para si e para seus companheiros de trabalho. Está menos afetiva e com dificuldade de se ajustar as mudanças comportamentais norteadas por um alto nível de confiança e menos interessado em seu trabalho e na concretização de seus objetivos. Seu ritmo de trabalho está comprometido pela insatisfação profissional, por sentimento de culpa, desânimo, baixa energia de resistência física e esgotamento emocional, com facilidade ao isolamento pessoal, grupal e institucional quando colocado em situações que exigem um alto padrão de realização para si mesmo e para seus companheiros.",
        );
    }
    
    /**
     * Laudo 04
     * 
     * @return type
     */
    private function Laudo04DepressaoMelancolia(){
        return array(
            "titulo-1" => "Estado de Humor / Ânimo com alteração nos Fatores - ",
            "titulo-2" => "Depressão-Melancoia - 'Perfil Iceberg' - ao lado",
            "corpo" => "Esse 'Perfil Iceberg' indica que a pessoa está situacionalmente com dificuldade de agir normalmente para levar adiante suas atividades profissionais e pessoais.  O fator DEPRESSÃO-MELANCOLIA, mostra-se com índices de energias afetivas relacionais preocupantes em relação aos demais fatores (tensão-ansiedade, agressividade-cólera, vigor afetividade, confusão-desorientação, fadiga-inércia).  Os escores dos níveis de energias estão acima dos 50% quando comparado com os demais que determinam o 'Perfil Iceberg' dentro da média populacional.  Indica que a pessoa situacionalmente está mantendo um padrão de comportamento com alto nível de energia canalizada de forma negativa, através da sensação de depressão e confusão, acompanhado por dificuldade de ajustamento, isolamento pessoal e sentimento de tristeza e de culpa que merecem ser investigados. Esse perfil mostra que o ritmo de trabalho dessa pessoa está comprometido por uma inadequação pessoal quando colocado em situações que exigem um alto padrão de realização em relação a si mesmo e aos seus companheiros.",
        );
    }
    
    /**
     * Laudo 05
     * 
     * @return type
     */
    private function Laudo05TensaoAnsiedade(){
        return array(
            "titulo-1" => "Estado de Humor / Ânimo com alteração nos Fatores - ",
            "titulo-2" => "Tensão-Ansiedade - 'Perfil Iceberg' - ao lado",
            "corpo" => "Esse 'Perfil Iceberg' indica que a pessoa situacionalmente está com dificuldade de agir normalmente para levar adiante suas atividades profissionais e pessoais.  Os escores acima dos 50% encontrados no fator TENSÃO-ANSIEDADE, quando comparado com os demais fatores (agressividade-cólera, vigor afetividade, confusão-desorientação, depressão-melancolia, fadiga-inércia), que configuram o “Perfil Iceberg”, estão fora da média populacional. Esses resultados indicam que a pessoa está mantendo um padrão de comportamento preocupante devido a uma alta concentração de energia afetiva relacional canalizada de forma negativa, através da raiva e da tensão, prejudicando o desenvolvimento de suas atividades profissionais e pessoais, que merecem ser investigados mais profundamente.  A pessoa avaliada está apresentando oscilação de estados de humor/ânimo e com fortes tendências comportamentais para reagir com individualidade e irritabilidade diante de situações imprevistas.  Esse perfil mostra que o ritmo de trabalho dessa pessoa está comprometido por uma inadequação pessoal quando colocado em situações que exigem melhor absorção de conteúdos afetivos relacionais para não prejudicar o desenvolvimento de suas atividades pessoais e profissionais.",
        );
    }
    
    /**
     * Laudo 06
     * 
     * @return type
     */
    private function Laudo06AgressividadeColera(){
        return array(
            "titulo-1" => "Estado de Humor / Ânimo com alteração nos Fatores - ",
            "titulo-2" => "Agressividade-Cólera - 'Perfil Iceberg'- ao lado",
            "corpo" => "Esse 'Perfil Iceberg' indica que a pessoa está com dificuldade de agir normalmente para levar adiante suas atividades profissionais e pessoais.  Os escores acima dos 50% encontrados no fator AGRESSIVIDADE-CÓLERA, está fora da média populacional. Esses índices quando comparados com o demais fatores (vigor afetividade, tensão-ansiedade, confusão-desorientação, depressão-melancolia, fadiga-inércia, ) que configuram o 'Perfil Iceberg'. Indicam que a pessoa está mantendo um padrão de comportamento preocupante devido a uma alta concentração de energia afetiva relacional canalizada de forma negativa, apresentando oscilação de estados de humor, e um acentuado nível de resistência para lidar com mudanças para agir normalmente e desenvolver suas atividades profissionais e pessoais.  É uma pessoa com fortes tendências comportamentais para ficar aborrecido, irritado e para agir com individualidade quando está sob pressão no meio social ambiental.  Uma pessoa impulsionada por oscilação de estados de humor/ânimo quando colocada diante de situações que exijam habilidade para tomar decisões e assumir responsabilidades por elas. Seu ritmo de trabalho está situacionalmente comprometido pela inadequação pessoal quando colocado em situações que exigem melhor absorção de conteúdos afetivos relacionais sob certas circunstâncias do seu dia-a-dia.",
        );
    }
    
    /**
     * Laudo 07
     * 
     * @return type
     */
    private function Laudo07TensaoRaiva(){
        return array(
            "titulo-1" => "Estado de Humor / Ânimo com alteração nos Fatores - ",
            "titulo-2" => " Tensão e raiva' - Perfil Iceberg' - ao lado",
            "corpo" => "Esse 'Perfil Iceberg' é de uma pessoa que não está se comportando normalmente para levar adiante suas atividades profissionais e pessoais.  Apresenta situacionalmente um 'Perfil Iceberg' com índices preocupantes em relação ao seu estado de humor/ânimo.  Os índices de energia - acima de 70% - encontrados no fator TENSÃO-RAIVA (definido como alta tensão musculoesquelética) se encontram fora da média populacional. Esses índices indicam que a pessoa está situacionalmente se comportando com fortes tendências a estados de humor/ânimo relacionados com atitudes e condutas antipática e raiva em relação às demais pessoas e a si mesmo. Apresentando sentimentos de hostilidade e reagindo com elevado nível de estresse, revelando possível comprometimento no desenvolvimento de suas atividades profissionais/pessoais. Está se comportando de forma desajustada no desenvolvimento de suas atividades laborais posicionadas pela demanda exigida no exercício de sua função profissional atual. Seus sentimentos e reações às situações estressantes oscilam com irritabilidade e desanimo quando submetido à discordância em situações de adversidade pessoais, grupais e institucionais, especialmente diante de situações repetitivas.  Seu ritmo de trabalho, por conseguinte, está sendo comprometido pela inadequação pessoal quando colocado em situações que exigem melhor absorção de conteúdos afetivos relacionais no seu dia-a-dia.  .",
        );
    }
    
    
    
}
?>
