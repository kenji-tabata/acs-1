<?php
define("TITULO",
       "LAUDO DE AVALIA��O SITUACIONAL DE ESTADO DE HUMOR \"POMS\"");


$fpdf->AddPage();


// Cabe�alho

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

$fpdf->SetY(30); # toma dist�ncia do cabe�alho
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

$texto = "1. Descri��o do Dispositivo de diagn�stico e m�tricas de avalia��o �POMS� � Profile of Moode State (de MacNair, Loor y Dropleman (1971)).";
$fpdf->WriteTag($w=0,
				$h=6,
				"<p>".$texto."</p>",
				$border=0,
				$align="J",
				$fill=0,
				$padding=0);
$fpdf->Ln();
				
			  
$texto = "O POMS � um dispositivo de diagn�stico situacional do estado de �nimo � autoinforme emocional � que tem como objetivo avaliar seis estados de �nimo ou estados afetivos relacionais caracterizados, como: tens�o-ansiedade (fator T); depress�o-melancolia (fator D); agressividade-c�lera (fator A); vigor afetividade (fator V); fadiga-in�rcia (fator F) e confus�o-desorienta��o (fator C). Os estados de �nimo s�o flutuantes e transit�rios, oscilando entre dois p�los: desde os estados de �nimos agrad�veis at� os estados de �nimos desagrad�veis, dependendo da gravita��o de energias (f�sica, social, emocional, espiritual, etc.) pela qual as pessoas est�o sujeitas a sentimentos de seguran�a ou inseguran�a. � composto por um conjunto de sessenta e cinco adjetivos como medidas de avalia��o e altera��es de estados de �nimo/humor das pessoas no contexto social e organizacional. Um dispositivo de avalia��o que pode ser utilizado na sele��o de pessoas, sempre e quando administrado em conjunto com outros dispositivos para tal finalidade. A pontua��o de cada fator de estado de �nimo/humor � obtida pela soma das respostas como medidas de avalia��o de estados de humor e suas rela��es com o contexto social e organizacional em geral. A somat�ria total das pontua��es aos seis estados de �nimo/humor determina o que chamamos de: Perfil Iceberg.";

			  
$fpdf->WriteTag($w=0,
				$h=6,
				"<p>".$texto."</p>",
				$border=0,
				$align="J",
				$fill=0,
				$padding=0);

				
$fpdf->Ln(10);
$texto = "1. 1.	Apresenta��o e An�lise dos Resultados.";
$fpdf->WriteTag($w=0,
				$h=6,
				"<p>".$texto."</p>",
				$border=0,
				$align="J",
				$fill=0,
				$padding=0);
				

// Gr�fico

$poms_graf->setPontuacao($tscore, $row_score); # <--- PONTUA��O
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


// Rodap�

$r_x1 = 10;
$r_y1 = 269;
$r_x2 = 200;
$r_y2 = $r_y1;
$fpdf->Line($r_x1, $r_y1, $r_x2, $r_y2);

$fpdf->SetFont('Arial','',7);
$fpdf->SetY($r_y1 + 1);
$fpdf->Cell(10, 2, utf8_decode('Impresso em '.date('d/m/Y').' �s '.date('G:i').'hs'.'.'));

$fpdf->SetY($r_y1 - 1.5);
$fpdf->SetX(180);
$fpdf->Cell(0, 7, 'P�gina 1');


// Display

$fpdf->SetDisplayMode('fullpage', 'single'); # Modo de visualiza��o
$fpdf->Output();

?>