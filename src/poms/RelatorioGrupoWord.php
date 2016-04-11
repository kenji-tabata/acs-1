<?php
// require_once dirname(__FILE__) . "/../poms/Relatorio.php";
// require_once dirname(__FILE__) . "/../poms/Profissional.php";
// require_once dirname(__FILE__) . "/../poms/Laudos.php";
// require_once dirname(__FILE__) . "/../poms/Grafico.php";
// require_once dirname(__FILE__) . "/../poms/TScore.php";
// require_once dirname(__FILE__) . "/../poms/RowScore.php";

#
# Recebendo dados
#
$nome_arquivo = $_POST['nome_arquivo'] = "foo.doc";
$id_pesq      = $_POST['id-pesq']      = 14;

#
#
#
function printTableProfissional($profissional) {
    ?>
    <table>
        <tr>
            <th>Nome:</th><td><?php echo $profissional->nome ?></td>
        </tr>
        <tr>
            <th>Cpf:</th><td><?php echo $profissional->cpf ?></td>
        </tr>
        <tr>
            <th>Email:</th><td><?php echo $profissional->email ?></td>
        </tr>
        <tr>
            <th>Sexo:</th><td><?php echo $profissional->genero ?></td>
        </tr>
    </table>        
    <?php
}



$profissional = new Profissional();
$profissional->nome   = "Fulano";
$profissional->cpf    = "111.2222.333.45";
$profissional->email  = "fulano@qualquer.com.br";
$profissional->genero = "masculino";

// var_dump($profissional);
// var_dump($grupo->grafico->getURLArquivo());

// $grafico_url = App::$path['dominio'] . "/src/poms/graficos/nome_img";
$grafico_url = App::$path['dominio'] . $grupo->grafico->getURLArquivo();

// die();

#
# Abrir no MS- Word
#
// header("Content-type: application/vnd.ms-word");
// header("Content-type: application/force-download");
// header("Content-Disposition: attachment; filename=$nome_arquivo");
// header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Relatório em Grupo</title>
        <meta charset="utf-8">

    </head>
    <body>


        <p>1. Descrição do Dispositivo de diagnóstico e métricas de avaliação "POMS" \- Profile of Moode State (de MacNair, Loor y Dropleman (1971)).<p>

        <p style="text-align: justify">
            O POMS é um dispositivo de diagnóstico situacional do estado de ânimo - autoinforme emocional - que tem como objetivo avaliar seis estados de ânimo ou estados afetivos
            relacionais caracterizados, como: tensão-ansiedade (fator T); depressão-melancolia (fator D); agressividade-cólera (fator A); vigor afetividade (fator V); fadiga-inércia (fator
            F) e confusão-desorientação (fator C). Os estados de ânimo são flutuantes e transitórios, oscilando entre dois pólos: desde os estados de ânimos agradáveis até os estados
            de ânimos desagradáveis, dependendo da gravitação de energias (física, social, emocional, espiritual, etc.) pela qual as pessoas estão sujeitas a sentimentos de segurança
            ou insegurança. É composto por um conjunto de sessenta e cinco adjetivos como medidas de avaliação e alterações de estados de ânimo/humor das pessoas no contexto
            social e organizacional. Um dispositivo de avaliação que pode ser utilizado na seleção de pessoas, sempre e quando administrado em conjunto com outros dispositivos para
            tal finalidade. A pontuação de cada fator de estado de ânimo/humor é obtida pela soma das respostas como medidas de avaliação de estados de humor e suas relações
            com o contexto social e organizacional em geral. A somatória total das pontuações aos seis estados de ânimo/humor determina o que chamamos de: Perfil Iceberg
        </p>

        <p>2. Apresentação e Análise dos Resultados</p>

        <img src=<?php echo $grafico_url ?> />

        <img src="http://www.whatstube.com.br/wp-content/uploads/2016/03/brasileiro-ta-tranquilo.jpg" height="300px" width="300px" />
        
        <p style="text-align: justify">
            Indica que a pessoa situcionalmente está com dificuldade de agir normalmente para levar adiante suas atividades profissionais e pessoais. Isto significa que o fator
            CONFUSÃO-DESORIENTAÇÃO mostra-se com índices de energias afetivas relacionais preocupantes em relação aos demais fatores (tensão-ansiedade;
            depressão-melancolia; agressividade-cólera; vigor afetividade e fadiga-inércia) que constituem o Perfil Iceberg e da média populacional. Esse perfil Iceberg mostra que a
            pessoa está mantendo um padrão de comportamento caracterizado por estados de humor/ ânimo, impelidos por 'atordoamentos' (estados de ansiedade, depressão ou
            emocionais relacionados) em suas habilidades de lidar com problemas. Está apresentando oscilação de estados de humor/ânimo para levar adiante uma sequência de
            ações com altos padrões de realização para si e para seus companheiros de trabalho. Está menos afetiva e com dificuldade de se ajustar as mudanças comportamentais
            norteadas por um alto nível de confiança e menos interessado em seu trabalho e na concretização de seus objetivos. Seu ritmo de trabalho está comprometido pela
            insatisfação profissional, por sentimento de culpa, desânimo, baixa energia de resistência física e esgotamento emocional, com facilidade ao isolamento pessoal, grupal e
            institucional quando colocado em situações que exigem um alto padrão de realização para si mesmo e para seus companheiros.
        </p>
    </body>
</html>