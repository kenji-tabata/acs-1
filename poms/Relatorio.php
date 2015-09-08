<?php

require_once "includes/pdf/fpdf.php";
require_once "includes/pdf/pdfwritetag.php";
require_once "Grafico.php";
require_once "RowScore.php";
require_once "TScore.php";



class Pesquisado {

}

$pesquisado = new Pesquisado();
$pesquisado->nome  = "Flávio";
$pesquisado->cpf   = "111.2222.333.45";
$pesquisado->email = "fulano@qualquer.com.br";
$pesquisado->sexo  = "masculino";

$laudo = array(
    "titulo-1" => "Estado de Humor / Ánimo Ótimo - ",
    "titulo-2" => "'Perfil Iceberg' - ao lado",
    "corpo" => "Indica que a pessoa avaliada apresenta um Estados de Humor/ Ánimo com índices de energias afetivas dentro da média populacional e com disposição para agir e lidar normalmente para levar adiante suas atividades pessoais e profissionais. Indica que os seis fatores (vigor-afetividade, tensão-ansiedade, depressao-melancolia; agressividade-cólera, fadiga-inércia e confusão-desorientação) que constituem o \"Perfil Iceberg\" estáo com índices de energias afetivas relacionais capazes de levar a pessoa a manter um padrão de comportamento caracterizado por autodomínio, autoconfiança e autonomia de competência para superar obstáculos impelida por estados de ánimo/humor estáveis e com pouca oscilação. De uma pessoa confiante, animada e produtiva com impulso competitivo, determinada a fazer com que as coisas aconteçam. Esse Perfil Iceberg representa que a pessoa está agindo normalmente ao fazer as coisas no seu dia-a-dia e adaptando-se às condições de mudanças no meio social ambiental e com impulso para tomar decisões, assumir riscos visando melhor aproveitamento do seu perfil pessoal e profissional.",
);


$fpdf = new PdfWriteTag();

/******************************************************************
 ******************************************************************
 **                                                              **
 **                          Cabeçalho                           **
 **                                                              **
 ******************************************************************
 ******************************************************************/
$fpdf->AddPage();
$fpdf->SetFont('Arial','B',12);
$fpdf->Cell(0, 7, utf8_decode("LAUDO DE AVALIAÇÂO SITUACIONAL DE ESTADO DE HUMOR"), 0, 1, "C");
$fpdf->Cell(0, 7, "\"POMS\"", 0, 0, "C");


$x1 = 10;
$y1 = 24;#17
$x2 = 200;
$y2 = $y1;
$fpdf->Line($x1, $y1, $x2, $y2);




/******************************************************************
 ******************************************************************
 **                                                              **
 **                         Pesquisado                           **
 **                                                              **
 ******************************************************************
 ******************************************************************/
$fpdf->SetY(25); # toma distância do cabeçalho
$wd = 15;        # tamanho dos campos
$ht = 5;         # altura das linhas

$fpdf->SetFont('Arial','B', 7);
$fpdf->Cell($wd, $ht, "Nome :");
$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(10, $ht, utf8_decode($pesquisado->nome), 0, 1);

$fpdf->SetFont('Arial','B', 7);
$fpdf->Cell($wd, $ht, "Cpf :");
$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(10, $ht, utf8_decode($pesquisado->cpf), 0, 1);

$fpdf->SetFont('Arial','B', 7);
$fpdf->Cell($wd, $ht, "Email: ");
$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(10, $ht, utf8_decode($pesquisado->email), 0, 1);

$fpdf->SetFont('Arial','B', 7);
$fpdf->Cell($wd, $ht, "Sexo: ");
$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(10, $ht, utf8_decode($pesquisado->sexo), 0, 1);
$fpdf->Ln();




/******************************************************************
 ******************************************************************
 **                                                              **
 **                           Texto                              **
 **                                                              **
 ******************************************************************
 ******************************************************************/
$fpdf->SetStyle($tag="p",
                $fonte="Arial",
                $style="N",
                $size=7,
                $cor="0, 0, 0"
              );


$texto = utf8_decode("1. Descrição do Dispositivo de diagnóstico e métricas de avaliação \"POMS\" \- Profile of Moode State (de MacNair, Loor y Dropleman (1971)).");
$fpdf->WriteTag($w=0,
                $h=6,
                "<p>".$texto."</p>",
                $border=0,
                $align="J",
                $fill=0,
                $padding=0);
$fpdf->Ln();


$texto = utf8_decode("O POMS é um dispositivo de diagnóstico situacional do estado de ânimo - autoinforme emocional - que tem como objetivo avaliar seis estados de ânimo ou estados afetivos relacionais caracterizados, como: tensão-ansiedade (fator T); depressão-melancolia (fator D); agressividade-cólera (fator A); vigor afetividade (fator V); fadiga-inércia (fator F) e confusão-desorientação (fator C). Os estados de ânimo são flutuantes e transitórios, oscilando entre dois pólos: desde os estados de ânimos agradáveis até os estados de ânimos desagradáveis, dependendo da gravitação de energias (física, social, emocional, espiritual, etc.) pela qual as pessoas estão sujeitas a sentimentos de segurança ou insegurança. É composto por um conjunto de sessenta e cinco adjetivos como medidas de avaliação e alterações de estados de ânimo/humor das pessoas no contexto social e organizacional. Um dispositivo de avaliação que pode ser utilizado na seleção de pessoas, sempre e quando administrado em conjunto com outros dispositivos para tal finalidade. A pontuação de cada fator de estado de ânimo/humor é obtida pela soma das respostas como medidas de avaliação de estados de humor e suas relações com o contexto social e organizacional em geral. A somatória total das pontuações aos seis estados de ânimo/humor determina o que chamamos de: Perfil Iceberg.");
$fpdf->WriteTag($w=0,
                $h=6,
                "<p>".$texto."</p>",
                $border=0,
                $align="J",
                $fill=0,
                $padding=0);
$fpdf->Ln(10);


$texto = utf8_decode("2. Apresentação e Análise dos Resultados.");
$fpdf->WriteTag($w=0,
                $h=6,
                "<p>".$texto."</p>",
                $border=0,
                $align="J",
                $fill=0,
                $padding=0);




/******************************************************************
 ******************************************************************
 **                                                              **
 **                            Gráfico                           **
 **                                                              **
 ******************************************************************
 ******************************************************************/
$graf = new Grafico();
$graf->setPontuacao(new TScore(), new RowScore());
$graf->setNomeArquivo();
$graf->setDisplay(Grafico::GRAVAR_NO_DISCO);
$graf->display(Grafico::GRAVAR_NO_DISCO);

$graf->deletar_imagem();

// $x = 10;
// $y = 130;
// $w = 70;
// $h = 70;
// $fpdf->Image($graf->getNomeArquivo(), $x, $y , $w, $h);
// $graf->deletar_imagem();
// $fpdf->Ln(8);




/******************************************************************
 ******************************************************************
 **                                                              **
 **                             Laudo                            **
 **                                                              **
 ******************************************************************
 ******************************************************************/

// Nome do laudo
$fpdf->SetFont('Arial','B',12);
$margem_esquerda = 75;

$fpdf->Cell($margem_esquerda);
$fpdf->Cell(0, 7, "Parecer Psicológico", 0, 1);

$fpdf->Cell($margem_esquerda);
$fpdf->Cell(0, 7, utf8_decode($laudo['titulo-1']), 0, 1);

$fpdf->Cell($margem_esquerda);
$fpdf->Cell(0, 7, utf8_decode($laudo['titulo-2']), 0, 0);
$fpdf->Ln(50);

// Corpo do laudo
$fpdf->SetStyle($tag="p",
                $fonte="Arial",
                $style="N",
                $size=7,
                $cor="0, 0, 0"
              );
$fpdf->WriteTag($w=0,
                $h=6,
                "<p>".utf8_decode($laudo['corpo'])."</p>",
                $border=0,
                $align="J",
                $fill=0,
                $padding=0);
$fpdf->Ln();




/******************************************************************
 ******************************************************************
 **                                                              **
 **                             Rodapé                           **
 **                                                              **
 ******************************************************************
 ******************************************************************/
$r_x1 = 10;
$r_y1 = 269;
$r_x2 = 200;
$r_y2 = $r_y1;
$fpdf->Line($r_x1, $r_y1, $r_x2, $r_y2);

$fpdf->SetFont('Arial','',7);
$fpdf->SetY($r_y1 + 1);
$fpdf->Cell(10, 2, utf8_decode('Impresso em '.date('d/m/Y').' às '.date('G:i').'hs'.'.'));

$fpdf->SetY($r_y1 - 1.5);
$fpdf->SetX(180);
$fpdf->Cell(0, 7, 'Página 1');


/******************************************************************
 ******************************************************************
 **                                                              **
 **                            Display                           **
 **                                                              **
 ******************************************************************
 ******************************************************************/
$fpdf->SetDisplayMode('fullpage', 'single'); # Modo de visualização
$fpdf->Output("files-temp/laudo.pdf");
?>