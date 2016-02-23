<?php

require_once dirname(__FILE__) . "/../includes/pdf/fpdf.php";
require_once dirname(__FILE__) . "/../includes/pdf/pdfwritetag.php";
require_once dirname(__FILE__) . "/Relatorio.php";

class RelatorioGrupo extends PdfWriteTag {

    private $fpdf;
    private $grupo;

    function __construct($grupo) {
        $this->grupo = $grupo;

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

    function retRowScoreMedio() {
        $rowScoreSoma  = new RowScore;

        foreach ($this->grupo as $prof) {
            $rowScoreSoma->tensao    += $prof->rowScore->tensao;
            $rowScoreSoma->depressao += $prof->rowScore->depressao;
            $rowScoreSoma->raiva     += $prof->rowScore->raiva;
            $rowScoreSoma->vigor     += $prof->rowScore->vigor;
            $rowScoreSoma->fadiga    += $prof->rowScore->fadiga;
            $rowScoreSoma->confusao  += $prof->rowScore->confusao;
        }

        $divisor = $this->fatorMedia();

        $rowScoreMedio = new RowScore;
        $rowScoreMedio->tensao    = $rowScoreSoma->tensao    / $divisor;
        $rowScoreMedio->depressao = $rowScoreSoma->depressao / $divisor;
        $rowScoreMedio->raiva     = $rowScoreSoma->raiva     / $divisor;
        $rowScoreMedio->vigor     = $rowScoreSoma->vigor     / $divisor;
        $rowScoreMedio->fadiga    = $rowScoreSoma->fadiga    / $divisor;
        $rowScoreMedio->confusao  = $rowScoreSoma->confusao  / $divisor;

        return $rowScoreMedio;
    }

    function fatorMedia() {
        return count($this->grupo);
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
        foreach ($this->grupo as $profissional) {
            $this->add($profissional);
        }
    }

    function add($profissional) {
        $relatorio = Relatorio::fabricar($profissional);
        $relatorio->setPDF($this);
        $relatorio->body();
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