<?php

require_once dirname(__FILE__) . "/../includes/pdf/fpdf.php";
require_once dirname(__FILE__) . "/../includes/pdf/pdfwritetag.php";
require_once dirname(__FILE__) . "/Relatorio.php";

class RelatorioGrupo extends PdfWriteTag {

    private $fpdf;

    function __construct() {
        parent::__construct($orientation='P', $unit='mm', $format='A4');
        date_default_timezone_set('America/Sao_Paulo');
        $this->texto = array(
            'titulo'       => utf8_decode("LAUDO DE AVALIAÇÂO SITUACIONAL DE ESTADO DE HUMOR"),
            'POMS'         => utf8_decode("\"POMS\""),
            'pesquisado'   => array(
                'nome'  => "\$pesquisado->nome",
                'cpf'   => "\$pesquisado->cpf",
                'email' => "\$pesquisado->email",
                'sexo'  => "\$pesquisado->genero",
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
                'titulo-a1' => "\$laudo->titulo_a1",
                'titulo-a2' => "\$laudo->titulo_a2",
                'titulo-a3' => "\$laudo->titulo_a3",
                'corpo'     => "\$laudo->corpo"
            ),
            'rodape-esq'   => utf8_decode('Gerado em ' . date('d/m/Y') . ' às ' . date('G:i') . 'hs' . '.'),
            'rodape-dir'   => utf8_decode("Página ")
        );

    }

    function setGrafico($arquivo) {
        $this->nome_arquivo_grafico = $arquivo;
    }

    function setMedia() {
    }

    function Header() {
        $this->SetFont('Arial','B',12);
        $this->Cell(0, 7, $this->texto['titulo'], 0, 1, "C");
        $this->Cell(0, 7, $this->texto['POMS'], 0, 0, "C");
        $this->Line($x1=10, $y1=24, $x2=200, $y2=24);
        $this->SetY(25);
    }    

    function Footer() {
        $this->Line(10, 269, 200, 269);
        $this->SetY(269 + 1);

        $this->SetFont('Arial','',7);
        $this->Cell(10, 2, $this->texto['rodape-esq']);

        $this->SetY(269 - 1.5);
        $this->SetX(180);
        $this->Cell(0, 7, $this->texto['rodape-dir'] . $this->PageNo());
    }

    function gerar($grupo) {
        $this->AddPage();
        foreach ($grupo as $profissional) {
            $this->add($profissional);
        }
    }

    function add($profissional) {
        $relatorio = Relatorio::fabricar($profissional);
        $relatorio->setPDF($this);
        $relatorio->body($relatorio->texto);
        $profissional->grafico->deletar_imagem();
    }

    function getNomeArquivo() {
        return dirname(__FILE__) . "/../files-temp/laudo.pdf";
    }

    function gravar() {
        $this->SetDisplayMode('fullpage', 'single');
        $this->Output($this->getNomeArquivo());
    }

    function download($nome_para_download) {
        $this->Output($nome_para_download . ".pdf", "D");
    }

    function deletar_relatorio() {
        unlink($this->getNomeArquivo());
    }

}
?>