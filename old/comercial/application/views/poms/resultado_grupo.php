<?php
define("TITULO",
       "Sistema de Diagnósticos e Métricas dos Estados de humor - Versão POMS");


// Primeira pagina
$fpdf->AddPage();

    cabecalho($fpdf);

    $pagMarEsquerda = 20;
    
    $fpdf->SetFont('Arial','', 14);
    $fpdf->Ln(10);
    $fpdf->SetX($pagMarEsquerda);
    $fpdf->Cell(10, 10, utf8_decode("Resultado em grupo"), 0, 1);

    $poms_graf->setPontuacao($media['tscore'], $media['row_score']);
    $poms_graf->setNomeArquivo();
    $poms_graf->setDisplay(Poms_graf::GRAVAR_NO_DISCO);
    $poms_graf->display();

    // Gráfico com a média do grupo    
    $fpdf->Image($poms_graf->getNomeArquivo(), $pagMarEsquerda, 45 , 100, 100);
    $poms_graf->deletar_imagem();
    
    // Lista os nomes dos pesquisados
    $fpdf->SetY(150);
    $fpdf->SetX($pagMarEsquerda);
    $wd = 15; 
    $ht = 5;         

    $fpdf->SetFont('Arial','B', 7);
    $fpdf->Cell(10, $ht, utf8_decode("Participam do resultado:"), 0, 1);

    foreach($pesquisados as $pesquisado){
        $fpdf->SetX($pagMarEsquerda);
        $fpdf->SetFont('Arial','', 7);
        $fpdf->Cell(10, $ht, utf8_decode($pesquisado['pesquisado']->nome), 0, 1);
    }

    rodape($fpdf);
    
    
// Segunda página em diante
$contador_pesq = 0;
$qtde_por_pag = 3;
$x_img = $pagMarEsquerda;
foreach($pesquisados as $pesquisado){
    
    if($contador_pesq % $qtde_por_pag == 0){
        $fpdf->AddPage();
        cabecalho($fpdf);
        
        $y_img = 40;
    } else {
        $y_img += 80;
    }    
    
    $poms_graf->setPontuacao($pesquisado['tscore'], $pesquisado['row_score']);
    $poms_graf->setNomeArquivo();
    $poms_graf->setDisplay(Poms_graf::GRAVAR_NO_DISCO);
    $poms_graf->display();

    // Gráfico com a média do grupo    
    $fpdf->Image($poms_graf->getNomeArquivo(), $x_img, $y_img, 50, 50);
    $poms_graf->deletar_imagem();
    
    // Dados do pesquisado
    $fpdf->SetY($y_img);
    $fpdf->SetX(80);
    $fpdf->SetFont('Arial','', 7);
    $fpdf->Cell(100, $ht, utf8_decode('Nome: '.$pesquisado['pesquisado']->nome), 0, 1);
    $fpdf->SetY($y_img+5);
    $fpdf->SetX(80);
    $fpdf->Cell(100, $ht, utf8_decode('Cpf: '.$pesquisado['pesquisado']->cpf), 0, 1);
    $fpdf->SetY($y_img+10);
    $fpdf->SetX(80);
    $fpdf->Cell(100, $ht, utf8_decode('Email: '.$pesquisado['pesquisado']->email), 0, 1);
    $fpdf->SetY($y_img+15);
    $fpdf->SetX(80);
    $fpdf->Cell(100, $ht, utf8_decode('Sexo: '.$pesquisado['pesquisado']->sexo), 0, 1);
    
    if($contador_pesq % $qtde_por_pag == 0){
        rodape($fpdf);
    }
    
    $contador_pesq++;
}
    
    
// Display
$fpdf->SetDisplayMode("fullpage", "single"); # Modo de visualização
$fpdf->Output();




// Cabeçalho
function cabecalho($fpdf){
    $fpdf->SetFont('Arial','B',12);
    $fpdf->Cell(0, 7, utf8_decode(TITULO), 0);

    $fpdf->SetY(12);
    $fpdf->SetX(175);
    $fpdf->SetFont('Arial','B', 7);
    $fpdf->Cell(0, 7, utf8_decode("acsimoes@usp.br"), 0, 1);

    $fpdf->Line(10, 17, 200, 17);
}

// Rodap´é
function rodape($fpdf){
    $fpdf->Line(10, 269, 200, 269);

    $fpdf->SetFont('Arial','',7);
    $fpdf->SetY(269 + 1);

    $impresso_em = date('d/m/Y').' às '.date('G:i').'hs';
    $fpdf->Cell(10, 2, "Impresso em ".utf8_decode($impresso_em).".");

    $fpdf->SetY(269 - 1.5);
    $fpdf->SetX(180);
    $fpdf->Cell(0, 7, utf8_decode("Página ".$fpdf->PageNo()));
}

?>
