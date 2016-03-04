<?php

require_once dirname(__FILE__) . "/../includes/pdf/fpdf.php";
require_once dirname(__FILE__) . "/../includes/pdf/pdfwritetag.php";
require_once dirname(__FILE__) . "/Relatorio.php";

class RelatorioGrupo extends PdfWriteTag {

    private $fpdf;
    private $grupo;

    function __construct($grupo) {
        $this->grupo = $grupo->get();

        parent::__construct($orientation='P', $unit='mm', $format='A4');
        date_default_timezone_set('America/Sao_Paulo');
        $this->texto = array(
            'titulo'       => utf8_decode("LAUDO DE AVALIAÇÂO SITUACIONAL DE ESTADO DE HUMOR"),
            'POMS'         => utf8_decode("\"POMS\""),
            'sub-titulo-1' => "Sub Título",
            'descricao-1'  => "Descrição",
            'rodape-esq'   => utf8_decode('Gerado em ' . date('d/m/Y') . ' às ' . date('G:i') . 'hs' . '.'),
            'rodape-dir'   => utf8_decode("Página ")
        );

    }

    function setGrafico($arquivo) {
        $this->nome_arquivo_grafico = $arquivo;
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

    function gerar() {
        $this->AddPage();
        $this->Image($this->nome_arquivo_grafico, $x=10, $y=40, $w=70, $h=70);
        foreach ($this->grupo as $profissional) {
            $this->AddPage();
            $this->add($profissional);
        }
    }

    function add($profissional) {
        $relatorio = new Relatorio($profissional, $profissional->laudo);
        $relatorio->setGrafico($profissional->grafico->getNomeArquivo());
        $relatorio->setPDF($this);
        $relatorio->body();
        $profissional->grafico->deletar();
    }

    function getNomeArquivo() {
        return dirname(__FILE__) . "/../files-temp/relatorio-grupo.pdf";
    }

    function gravar() {
        $this->SetDisplayMode('fullpage', 'single');
        $this->Output($this->getNomeArquivo());
    }

    function download($nome_para_download) {
        $this->Output($nome_para_download . ".pdf", "D");
    }

    function deletar() {
        unlink($this->getNomeArquivo());
    }

}
?>