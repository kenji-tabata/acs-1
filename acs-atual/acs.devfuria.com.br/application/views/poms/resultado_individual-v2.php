<?php
define("TITULO",
       "LAUDO DE AVALIAÇÃO SITUACIONAL DE ESTADO DE HUMOR \"POMS\"");


$fpdf->AddPage();


// Cabeçalho

$fpdf->SetFont('Arial','B',12);
$fpdf->Cell(0, 7, TITULO, 0);

$fpdf->SetY(12);
$fpdf->SetX(175);
$fpdf->SetFont('Arial','B', 7);
$fpdf->Cell(0, 7, utf8_decode('acsimoes@usp.br'), 0, 1);

$x1 = 10;
$y1 = 17;
$x2 = 200;
$y2 = $y1;
$fpdf->Line($x1, $y1, $x2, $y2);


// Dados do pesquisado

$fpdf->SetY(30); # toma distância do cabeçalho
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



/*
 * Texto 
 */
$fpdf->SetStyle($tag="p",
                $fonte="Arial",
                $style="N",
                $size=7,
                $cor="0, 0, 0"
              );

$texto = "1. Descrição do Dispositivo de diagnóstico e métricas de avaliação “POMS” – Profile of Moode State (de MacNair, Loor y Dropleman (1971)).";
$fpdf->WriteTag($w=0,
				$h=6,
				"<p>".$texto."</p>",
				$border=0,
				$align="J",
				$fill=0,
				$padding=0);
$fpdf->Ln();
				
			  
$texto = "O POMS é um dispositivo de diagnóstico situacional do estado de ânimo – autoinforme emocional – que tem como objetivo avaliar seis estados de ânimo ou estados afetivos relacionais caracterizados, como: tensão-ansiedade (fator T); depressão-melancolia (fator D); agressividade-cólera (fator A); vigor afetividade (fator V); fadiga-inércia (fator F) e confusão-desorientação (fator C). Os estados de ânimo são flutuantes e transitórios, oscilando entre dois pólos: desde os estados de ânimos agradáveis até os estados de ânimos desagradáveis, dependendo da gravitação de energias (física, social, emocional, espiritual, etc.) pela qual as pessoas estão sujeitas a sentimentos de segurança ou insegurança. É composto por um conjunto de sessenta e cinco adjetivos como medidas de avaliação e alterações de estados de ânimo/humor das pessoas no contexto social e organizacional. Um dispositivo de avaliação que pode ser utilizado na seleção de pessoas, sempre e quando administrado em conjunto com outros dispositivos para tal finalidade. A pontuação de cada fator de estado de ânimo/humor é obtida pela soma das respostas como medidas de avaliação de estados de humor e suas relações com o contexto social e organizacional em geral. A somatória total das pontuações aos seis estados de ânimo/humor determina o que chamamos de: Perfil Iceberg.";

			  
$fpdf->WriteTag($w=0,
				$h=6,
				"<p>".$texto."</p>",
				$border=0,
				$align="J",
				$fill=0,
				$padding=0);

				
$fpdf->Ln(10);
$texto = "1. 1.	Apresentação e Análise dos Resultados.";
$fpdf->WriteTag($w=0,
				$h=6,
				"<p>".$texto."</p>",
				$border=0,
				$align="J",
				$fill=0,
				$padding=0);
				

// Gráfico

$poms_graf->setPontuacao($tscore, $row_score); # <--- PONTUAÇÂO
$poms_graf->setNomeArquivo();
$poms_graf->setDisplay(Poms_graf::GRAVAR_NO_DISCO);
$poms_graf->display();

$x = 10;
$y = 130;
$w = 70;
$h = 70;
$local = $poms_graf->getNomeArquivo();
$fpdf->Image($local, $x, $y , $w, $h);

$poms_graf->deletar_imagem();


// Rodapé

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


// Display

$fpdf->SetDisplayMode('fullpage', 'single'); # Modo de visualização
$fpdf->Output();

?>