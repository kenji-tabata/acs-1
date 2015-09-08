<?php
/*/
 * Teste manual do gerador de imangens do gráfico Poms
 *
 *     $ php PomsGraficosTestManual.php
 *
 * Veja imagem gerada em `../temp-files/`
 *
 */
require_once "poms/Grafico.php";
require_once "poms/TScore.php";
require_once "poms/RowScore.php";

$tScore = new TScore();
$tScore->tensao    = 46;
$tScore->depressao = 40;
$tScore->raiva     = 40;
$tScore->vigor     = 80;
$tScore->fadiga    = 40;
$tScore->confusao  = 51;

$rowScore = new RowScore();
$rowScore->tensao    = 4;
$rowScore->depressao = 0;
$rowScore->raiva     = 0;
$rowScore->vigor     = 37;
$rowScore->fadiga    = 0;
$rowScore->confusao  = 4;

$graf = new Grafico();
$graf->setPontuacao($tScore, $rowScore);
$graf->setNomeArquivo();
$graf->setDisplay(Grafico::GRAVAR_NO_DISCO);
$graf->display(Grafico::GRAVAR_NO_DISCO);

print($graf->getNomeArquivo(). "\n");