<?php

// front end
require_once "../includes/pdf/fpdf.php";
require_once "../includes/pdf/pdfwritetag.php";

// testes
//require_once "includes/pdf/fpdf.php";
//require_once "includes/pdf/pdfwritetag.php";

class Relatorio {

    private $fpdf;

    function __construct($pesquisado, $laudo) {
        date_default_timezone_set('America/Sao_Paulo');
        $this->texto = array(
            'titulo'       => "LAUDO DE AVALIAÇÂO SITUACIONAL DE ESTADO DE HUMOR",
            'POMS'         => "\"POMS\"",
            'pesquisado'   => array(
                'nome'  => $pesquisado->nome,
                'cpf'   => $pesquisado->cpf,
                'email' => $pesquisado->email,
                'sexo'  => $pesquisado->genero,
            ),
            'sub-titulo-1' => "1. Descrição do Dispositivo de diagnóstico e métricas de avaliação \"POMS\" \- "
                            . "Profile of Moode State (de MacNair, Loor y Dropleman (1971)).",
            'descricao-1'  => "O POMS é um dispositivo de diagnóstico situacional do estado de ânimo - autoinforme emocional - "
                            . "que tem como objetivo avaliar seis estados de ânimo ou estados afetivos relacionais caracterizados, "
                            . "como: tensão-ansiedade (fator T); depressão-melancolia (fator D); agressividade-cólera (fator A); "
                            . "vigor afetividade (fator V); fadiga-inércia (fator F) e confusão-desorientação (fator C). "
                            . "Os estados de ânimo são flutuantes e transitórios, oscilando entre dois pólos: desde os "
                            . "estados de ânimos agradáveis até os estados de ânimos desagradáveis, dependendo da gravitação "
                            . "de energias (física, social, emocional, espiritual, etc.) pela qual as pessoas estão sujeitas a "
                            . "sentimentos de segurança ou insegurança. É composto por um conjunto de sessenta e cinco adjetivos "
                            . "como medidas de avaliação e alterações de estados de ânimo/humor das pessoas no contexto social e "
                            . "organizacional. Um dispositivo de avaliação que pode ser utilizado na seleção de pessoas, sempre e "
                            . "quando administrado em conjunto com outros dispositivos para tal finalidade. A pontuação "
                            . "de cada fator de estado de ânimo/humor é obtida pela soma das respostas como medidas de "
                            . "avaliação de estados de humor e suas relações com o contexto social e organizacional em geral. "
                            . "A somatória total das pontuações aos seis estados de ânimo/humor determina o que chamamos de: Perfil Iceberg.",
            'sub-titulo-2' => "2. Apresentação e Análise dos Resultados.",
            'laudo'        => array(
                'titulo-a1' => $laudo->titulo_a1,
                'titulo-a2' => $laudo->titulo_a2,
                'titulo-a3' => $laudo->titulo_a3,
                'corpo'     => $laudo->corpo
            ),
            'rodape-esq'   => 'Gerado em ' . date('d/m/Y') . ' às ' . date('G:i') . 'hs' . '.',
            'rodape-dir'   => "Página 1"
        );

        /**
         * Codificar para utf8
         *
         * Débito técnico: percorrer em profundidade de forma mais decente!
         */
        foreach ($this->texto as $key => $value) {
            if ($key == "laudo") {
                foreach ($value as $laudo_key => $laudo_value) {
                    $this->texto[$key][$laudo_key] = utf8_decode($laudo_value);
                }
            } else if ($key == "pesquisado") {
                foreach ($value as $pesq_key => $pesq_value) {
                    $this->texto[$key][$pesq_key] = utf8_decode($pesq_value);
                }
            } else {
                $this->texto[$key] = utf8_decode($value);
            }
        }
    }

    function setGrafico($arquivo) {
        $this->nome_arquivo_grafico = $arquivo;
    }

    function gerar() {
        $this->fpdf = new PdfWriteTag();
        $this->fpdf->AddPage();

        # Cabeçalho
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->Cell(0, 7, $this->texto['titulo'], 0, 1, "C");
        $this->fpdf->Cell(0, 7, $this->texto['POMS'], 0, 0, "C");
        $this->fpdf->Line($x1=10, $y1=24, $x2=200, $y2=24);
        $this->fpdf->SetY(25);

        # Informações do pesquisado
        $wd = 15; # tamanho dos campos
        $ht = 5;  # altura das linhas

        $this->fpdf->SetFont('Arial','B', 7);
        $this->fpdf->Cell($wd, $ht, "Nome :");
        $this->fpdf->SetFont('Arial','', 7);
        $this->fpdf->Cell(10, $ht, $this->texto['pesquisado']['nome'], 0, 1);

        $this->fpdf->SetFont('Arial','B', 7);
        $this->fpdf->Cell($wd, $ht, "Cpf :");
        $this->fpdf->SetFont('Arial','', 7);
        $this->fpdf->Cell(10, $ht, $this->texto['pesquisado']['cpf'], 0, 1);

        $this->fpdf->SetFont('Arial','B', 7);
        $this->fpdf->Cell($wd, $ht, "Email: ");
        $this->fpdf->SetFont('Arial','', 7);
        $this->fpdf->Cell(10, $ht, $this->texto['pesquisado']['email'], 0, 1);

        $this->fpdf->SetFont('Arial','B', 7);
        $this->fpdf->Cell($wd, $ht, "Sexo: ");
        $this->fpdf->SetFont('Arial','', 7);
        $this->fpdf->Cell(10, $ht, $this->texto['pesquisado']['sexo'], 0, 1);

        $this->fpdf->Ln();
        $this->fpdf->SetStyle($tag="p", $fonte="Arial", $style="N", $size=7, $cor="0, 0, 0" );

        # Sub título 1
        $texto = $this->texto['sub-titulo-1'];
        $this->fpdf->WriteTag($w=0, $h=6,  "<p>".$texto."</p>", $border=0, $align="J", $fill=0, $padding=0);
        $this->fpdf->Ln();

        # Descrição 1
        $texto = $this->texto['descricao-1'];
        $this->fpdf->WriteTag($w=0, $h=6, "<p>".$texto."</p>", $border=0, $align="J", $fill=0, $padding=0);
        $this->fpdf->Ln(10);

        # Sub título 2
        $texto = $this->texto['sub-titulo-2'];
        $this->fpdf->WriteTag($w=0, $h=6, "<p>".$texto."</p>", $border=0, $align="J", $fill=0, $padding=0);
        $this->fpdf->Ln(8);

        $this->fpdf->Image($this->nome_arquivo_grafico, $x=10, $y=130, $w=70, $h=70);

        # Texto específico do laudo
        $margem_esquerda = 75;
        $this->fpdf->SetFont('Arial','B',12);

        $this->fpdf->Cell($margem_esquerda);
        $this->fpdf->Cell(0, 7, $this->texto['laudo']['titulo-a1'], 0, 1);

        $this->fpdf->Cell($margem_esquerda);
        $this->fpdf->Cell(0, 7, $this->texto['laudo']['titulo-a2'], 0, 1);

        $this->fpdf->Cell($margem_esquerda);
        $this->fpdf->Cell(0, 7, $this->texto['laudo']['titulo-a3'], 0, 0);
        $this->fpdf->Ln(60);

        # corpo do laudo
        $this->fpdf->SetStyle($tag="p", $fonte="Arial", $style="N", $size=7, $cor="0, 0, 0");
        $this->fpdf->WriteTag($w=0, $h=6, "<p>" . $this->texto['laudo']['corpo'] . "</p>", $border=0, $align="J",  $fill=0,  $padding=0);

        $this->fpdf->Ln();

        # Rodapé
        $this->fpdf->Line(10, 269, 200, 269);
        $this->fpdf->SetY(269 + 1);

        $this->fpdf->SetFont('Arial','',7);
        $this->fpdf->Cell(10, 2, $this->texto['rodape-esq']);

        $this->fpdf->SetY(269 - 1.5);
        $this->fpdf->SetX(180);
        $this->fpdf->Cell(0, 7, $this->texto['rodape-dir']);

    }

    function getNomeArquivo() {
        return "files-temp/laudo.pdf";
    }

    function gravar() {
        $this->fpdf->SetDisplayMode('fullpage', 'single');
        $this->fpdf->Output($this->getNomeArquivo());
    }

    function download() {
        $this->fpdf->Output($this->getNomeArquivo(), "D");
    }

    function deletar_relatorio() {
        unlink($this->getNomeArquivo());
    }

}
?>