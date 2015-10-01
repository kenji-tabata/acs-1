<?php
define("TITULO",
       "ACS - Comportamento Ideologico de liderança");


/*
 *  Primeira página
 */
$fpdf->AddPage();

cabecalho($fpdf);
$pagMarEsquerda = 20;

/*
 * Novo gráfico
 */
$real_equipe_graf_new->setNomeArquivo();
$real_equipe_graf_new->main($media_resultado);

// Gráfico com a média do grupo
$fpdf->Image($real_equipe_graf_new->getNomeArquivo(), $pagMarEsquerda, 45 , 100, 100);
$real_equipe_graf_new->deletar_imagem();

/*
 * Gráfico anterior
 */
//$real_equipe_graf->setPontuacao();
//$real_equipe_graf->setNomeArquivo();
//$real_equipe_graf->setDisplay(Real_equipe_graf::GRAVAR_NO_DISCO);
//$real_equipe_graf->display();
//
//// Gráfico com a média do grupo
//$fpdf->Image($real_equipe_graf->getNomeArquivo(), $pagMarEsquerda, 45 , 100, 100);
//$real_equipe_graf->deletar_imagem();


$ydim = 145;
$d_nome = array(
    "rh" => "Relações Humanas",
    "et" => "Executção de tarefas",
    "per" => "Perssuasivo",
    "rec" => "Reconciliador",
    "int" => "Intuitivo",
    "tof" => "Tolerância a falhas"
);

foreach($media_resultado as $dimensao_nome => $dimensao_valor){
    $ydim += 5;
    $fpdf->SetY($ydim);
    $fpdf->SetFont('Arial','', 7);

    $fpdf->SetX(20);
    $fpdf->Cell(100, 0, utf8_decode($d_nome[$dimensao_nome]), 0, 1);

    $fpdf->SetX(50);
    $fpdf->Cell(100, 0, $dimensao_valor, 0, 1);

}


/*
 *  Segunda página em diante
 */
rodape($fpdf);
$contador_pesq = 0;
$qtde_por_pag = 3;
$x_img = $pagMarEsquerda;
foreach($pesquisados as $pesquisado){

    if($contador_pesq % $qtde_por_pag == 0){
        $fpdf->AddPage();
        cabecalho($fpdf);

        $y_img = 50;
    } else {
        $y_img += 80;
    }


    /*
     *  Gráfico Individual - NOVO
     */
    $real_equipe_graf_new->setNomeArquivo();
    $real_equipe_graf_new->main( $pesquisado->resultado );

    $fpdf->Image($real_equipe_graf_new->getNomeArquivo(), $x_img, $y_img, 50, 50);
    $real_equipe_graf_new->deletar_imagem();

    /*
     *  Gráfico Individual - anterior
     */
//    $real_equipe_graf->setPontuacao();
//    $real_equipe_graf->setNomeArquivo();
//    $real_equipe_graf->setDisplay(Real_equipe_graf::GRAVAR_NO_DISCO);
//    $real_equipe_graf->display();
//
//    $fpdf->Image($real_equipe_graf->getNomeArquivo(), $x_img, $y_img, 50, 50);
//    $real_equipe_graf->deletar_imagem();

    // Dados do pesquisado
    $ht = 5;

    $fpdf->SetY($y_img);
    $fpdf->SetX(80);
    $fpdf->SetFont('Arial','', 7);
    $fpdf->Cell(100, $ht, utf8_decode('Nome: '.$pesquisado->nome), 0, 1);
    if($pesquisado->lider == "sim"){
        $fpdf->SetY($y_img+5);
        $fpdf->SetX(80);
        $fpdf->Cell(100, $ht, utf8_decode('LÍDER'), 0, 1);
    }


    if($contador_pesq % $qtde_por_pag == 0){
        rodape($fpdf);
    }

    $contador_pesq++;

}  # end foreach







/*
 * Display
 */
$fpdf->SetDisplayMode("fullpage", "single"); # Modo de visualização
$fpdf->Output();





/*
 *  Cabecalho
 */
function cabecalho($fpdf){
    $fpdf->SetFont('Arial','B', 12);
    $fpdf->Cell(0, 7, utf8_decode(TITULO), 0);

    $fpdf->SetY(12);
    $fpdf->SetX(175);
    $fpdf->SetFont('Arial','B', 7);
    $fpdf->Cell(0, 7, utf8_decode("acsimoes@usp.br"), 0, 1);

    $fpdf->Line(10, 17, 200, 17);
}

/*
 *  Rodape
 */
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