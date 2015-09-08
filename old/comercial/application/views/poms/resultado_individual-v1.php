<?php
define("TITULO",
       "Sistema de Diagnósticos e Métricas dos Estados de humor - Versão POMS");


$fpdf->AddPage();


// Cabeçalho

$fpdf->SetFont('Arial','B',12);
$fpdf->Cell(0, 7, utf8_decode(TITULO), 0);

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


// Gráfico

$poms_graf->setPontuacao($tscore, $row_score); # <--- PONTUAÇÂO
$poms_graf->setNomeArquivo();
$poms_graf->setDisplay(Poms_graf::GRAVAR_NO_DISCO);
$poms_graf->display();

$x = 50;
$y = 80;
$w = 100;
$h = 100;
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
$fpdf->Cell(0, 7, utf8_decode('Página 1'));


// Display

$fpdf->SetDisplayMode('fullpage', 'single'); # Modo de visualização
$fpdf->Output();

?>