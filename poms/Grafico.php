<?php

class Grafico {

    private $imagem;    # array
    private $tScore;    # PomsTScore
    private $rowScore;  # PomsRowScore

    const MOSTRAR_NO_BROWSER = 1;
    const GRAVAR_NO_DISCO = 2;

    public function setNomeArquivo() {
        $this->imagem['nome'] = 'files-temp/' . uniqid() . '.png';
    }

    public function getNomeArquivo() {
        return $this->imagem['nome'];
    }

    public function setDisplay($display) {
        $this->imagem['display'] = $display;
    }

    public function setPontuacao($tScore, $rowScore) {
        $this->tScore   = $tScore;
        $this->rowScore = $rowScore;
    }

    public function display() {

        $this->desenhar_imagem();

        # Mostrar imagem...
        switch ($this->imagem['display']) {
            case self::MOSTRAR_NO_BROWSER :
                header("Content-type: image/png");
                imagepng($this->imagem['imagem']);
                break;
            case self::GRAVAR_NO_DISCO :
                imagepng($this->imagem['imagem'], $this->imagem['nome']);
                break;
        }
    }

    public function deletar_imagem() {
        unlink($this->imagem['nome']);
    }

    private function desenhar_imagem() {
        /******************************************************************
         ******************************************************************
         **                                                              **
         **                   Aqui inicia a imagem                       **
         **                                                              **
         ******************************************************************
         *******************************************************************/
        $altura = 600;
        $largura = 665;
        $im = imagecreate($largura, $altura);
        $background_color = imagecolorallocate($im, 240, 240, 240);

        #cores
        $cores['branco'] = imagecolorallocate($im, 255, 255, 255);
        $cores['preto'] = imagecolorallocate($im, 66, 66, 66);
        $cores['azul'] = imagecolorallocate($im, 0, 0, 255);

        # fonts
        $font = "fonts/arial.ttf";




        /******************************************************************
         ******************************************************************
         **                                                              **
         **                   Aqui começa a grade                        **
         **                                                              **
         ******************************************************************
         ******************************************************************/
        $marSup = 15;
        $marEsq = 73;

        $espAltura = 80;
        $espLargura = 80;

        $fimAltura = ($espAltura * 6) + $marSup;
        $fimLargura = ($espLargura * 7) + $marEsq;

        $p = $cores['preto'];
        $b = $cores['branco'];
        $pontilhado = array($p, $p, $p, $b, $b, $b);
        imagesetstyle($im, $pontilhado);

        $espAltura = 80;
        $espLargura = 80;

        /*
         * Grade Horizontal
         */
        $x1 = $marEsq;
        $y1 = $marSup + $espAltura;
        $x2 = $fimLargura;
        $y2 = $y1;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1;
        $y1 = $y1 + $espAltura;
        $x2 = $fimLargura;
        $y2 = $y1;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1;
        $y1 = $y1 + $espAltura;
        $x2 = $fimLargura;
        $y2 = $y1;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1;
        $y1 = $y1 + $espAltura;
        $x2 = $fimLargura;
        $y2 = $y1;
        imageline($im, $x1, $y1, $x2, $y2, $cores['azul']);

        $x1 = $x1;
        $y1 = $y1 + $espAltura;
        $x2 = $fimLargura;
        $y2 = $y1;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        /*
         * Grade Vertical
         */
        $x1 = $espLargura + $marEsq;
        $y1 = $marSup;
        $x2 = $x1;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1 + $espLargura;
        $y1 = $y1;
        $x2 = $x1;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1 + $espLargura;
        $y1 = $y1;
        $x2 = $x1;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1 + $espLargura;
        $y1 = $y1;
        $x2 = $x1;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1 + $espLargura;
        $y1 = $y1;
        $x2 = $x1;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);

        $x1 = $x1 + $espLargura;
        $y1 = $y1;
        $x2 = $x1;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);




        /******************************************************************
         ******************************************************************
         **                                                              **
         **            Aqui começa a borda(contorno)                     **
         **                                                              **
         ******************************************************************
         ******************************************************************/
        $corContorno = $cores['preto'];

        # linha hor de cima
        $x1 = $marEsq;
        $y1 = $marSup;
        $x2 = $fimLargura;
        $y2 = $marSup;
        imageline($im, $x1, $y1, $x2, $y2, $corContorno);

        # linha hor de baixo
        $x1 = $marEsq;
        $y1 = $fimAltura;
        $x2 = $fimLargura;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, $corContorno);

        # linha ver da esquerda
        $x1 = $marEsq;
        $y1 = $marSup;
        $x2 = $marEsq;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, $corContorno);

        # linha ver da direita
        $x1 = $fimLargura;
        $y1 = $marSup;
        $x2 = $fimLargura;
        $y2 = $fimAltura;
        imageline($im, $x1, $y1, $x2, $y2, $corContorno);




        /******************************************************************
         ******************************************************************
         **                                                              **
         **                   Aqui começa o iceberg                      **
         **                                                              **
         ******************************************************************
         ******************************************************************/
        $corIce = $cores['azul'];
        imagesetthickness($im, 3);

        $per_tensao    = $this->tScore->tensao;
        $per_depressao = $this->tScore->depressao;
        $per_raiva     = $this->tScore->raiva;
        $per_vigor     = $this->tScore->vigor;
        $per_fadiga    = $this->tScore->fadiga;
        $per_confusao  = $this->tScore->confusao;


        # TENSÂO depressão
        $x1 = $marEsq + 80;
        $y1 = $marSup + $this->retornaDistancia($per_tensao);
        $x2 = $marEsq + (80 * 2);
        $y2 = $marSup + $this->retornaDistancia($per_depressao);
        imageline($im, $x1, $y1, $x2, $y2, $corIce);

        # DEPRESSÃO raiva
        $x1 = $x2;
        $y1 = $y2;
        $x2 = $marEsq + (80 * 3);
        $y2 = $marSup + $this->retornaDistancia($per_raiva);
        imageline($im, $x1, $y1, $x2, $y2, $corIce);

        # RAIVA vigor
        $x1 = $x2;
        $y1 = $y2;
        $x2 = $marEsq + (80 * 4);
        $y2 = $marSup + $this->retornaDistancia($per_vigor);
        imageline($im, $x1, $y1, $x2, $y2, $corIce);

        # VIGOR fadiga
        $x1 = $x2;
        $y1 = $y2;
        $x2 = $marEsq + (80 * 5);
        $y2 = $marSup + $this->retornaDistancia($per_fadiga);
        imageline($im, $x1, $y1, $x2, $y2, $corIce);

        # FADIGA confusão
        $x1 = $x2;
        $y1 = $y2;
        $x2 = $marEsq + (80 * 6);
        $y2 = $marSup + $this->retornaDistancia($per_confusao);
        imageline($im, $x1, $y1, $x2, $y2, $corIce);




        /******************************************************************
         ******************************************************************
         **                                                              **
         **                Aqui começa a legenda esquerda                **
         **                                                              **
         ******************************************************************
         ******************************************************************/
        $text_color = $cores['azul'];

        $font_size = 7;
        $angle = 0;
        $x = 40;
        $y = $marSup + 4; # esse 4 é para centralizar certicalmente


        $texto = "90%";
        imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font, $texto);

        $texto = "80%";
        imagettftext($im, $font_size, $angle, $x, $y+=$espAltura, $text_color, $font, $texto);

        $texto = "70%";
        imagettftext($im, $font_size, $angle, $x, $y+=$espAltura, $text_color, $font, $texto);

        $texto = "60%";
        imagettftext($im, $font_size, $angle, $x, $y+=$espAltura, $text_color, $font, $texto);

        $texto = "50%";
        imagettftext($im, $font_size, $angle, $x, $y+=$espAltura, $text_color, $font, $texto);

        $texto = "40%";
        imagettftext($im, $font_size, $angle, $x, $y+=$espAltura, $text_color, $font, $texto);

        $texto = "30%";
        imagettftext($im, $font_size, $angle, $x, $y+=$espAltura, $text_color, $font, $texto);




        /******************************************************************
         ******************************************************************
         **                                                              **
         **                   Aqui começa o rodapé                       **
         **                                                              **
         ******************************************************************
         ******************************************************************/
        $marSup_rodape = 530;
        $marEsq_rodape = 10;
        $alturaLinha = 20;
        $distColuna = 70;

        /*
         * Set row score
         */
        $row_tensao = $this->rowScore->tensao;
        $row_depressao = $this->rowScore->depressao;
        $row_raiva = $this->rowScore->raiva;
        $row_vigor = $this->rowScore->vigor;
        $row_fadiga = $this->rowScore->fadiga;
        $row_confusao = $this->rowScore->confusao;

        /*
         * Define as fontes
         */
        $font_size = 10;
        $angle = 0;
        $text_color = $cores['preto'];

        # Coluna 0(zero)
        $x = $marEsq_rodape;
        $y = $marSup_rodape + $alturaLinha; # somo com altura da linha para "cair" na 2 linha

        $texto = "RowScore";
        imagettftext($im, $font_size, $angle, $x, $y, $cores['preto'], $font, $texto);

        $texto = "TScore";
        imagettftext($im, $font_size, $angle, $x, $y+=$alturaLinha, $cores['azul'], $font, $texto);

        # Coluna 1
        $texto = "Tensao";
        $x = $marEsq_rodape + $distColuna + 50; # 45 é um valor qualquer
        $y = $marSup_rodape;
        imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font, $texto);

        $texto = $row_tensao;
        imagettftext($im, $font_size, $angle, $x + 15, $y+=$alturaLinha, $text_color, $font, $texto);

        $texto = $per_tensao;
        imagettftext($im, $font_size, $angle, $x + 15, $y+=$alturaLinha, $cores['azul'], $font, $texto);

        # Coluna 2
        $texto = "Depressao";
        $x += $distColuna;
        $y = $marSup_rodape;
        imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font, $texto);

        $texto = $row_depressao;
        imagettftext($im, $font_size, $angle, $x + 25, $y+=$alturaLinha, $text_color, $font, $texto);

        $texto = $per_depressao;
        imagettftext($im, $font_size, $angle, $x + 25, $y+=$alturaLinha, $cores['azul'], $font, $texto);

        # Coluna 3
        $texto = "Raiva";
        $x += $distColuna + 23;
        $y = $marSup_rodape;
        imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font, $texto);

        $texto = $row_raiva;
        imagettftext($im, $font_size, $angle, $x + 12, $y+=$alturaLinha, $text_color, $font, $texto);

        $texto = $per_raiva;
        imagettftext($im, $font_size, $angle, $x + 12, $y+=$alturaLinha, $cores['azul'], $font, $texto);

        # Coluna 4
        $texto = "Vigor";
        $x += $distColuna + 16;
        $y = $marSup_rodape;
        imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font, $texto);

        $texto = $row_vigor;
        imagettftext($im, $font_size, $angle, $x + 5, $y+=$alturaLinha, $text_color, $font, $texto);

        $texto = $per_vigor;
        imagettftext($im, $font_size, $angle, $x + 5, $y+=$alturaLinha, $cores['azul'], $font, $texto);

        # Coluna 5
        $texto = "Fadiga";
        $x += $distColuna + 2;
        $y = $marSup_rodape;
        imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font, $texto);

        $texto = $row_fadiga;
        imagettftext($im, $font_size, $angle, $x + 13, $y+=$alturaLinha, $text_color, $font, $texto);

        $texto = $per_fadiga;
        imagettftext($im, $font_size, $angle, $x + 13, $y+=$alturaLinha, $cores['azul'], $font, $texto);

        # Coluna 6
        $texto = "Confusao";
        $x += $distColuna + 4;
        $y = $marSup_rodape;
        imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font, $texto);

        $texto = $row_confusao;
        imagettftext($im, $font_size, $angle, $x + 20, $y+=$alturaLinha, $text_color, $font, $texto);

        $texto = $per_confusao;
        imagettftext($im, $font_size, $angle, $x + 20, $y+=$alturaLinha, $cores['azul'], $font, $texto);
        

        

        /******************************************************************
         ******************************************************************
         **                                                              **
         **                   Última atribuição                          **
         **                                                              **
         ******************************************************************
         *******************************************************************/
        $this->imagem['imagem'] = $im;
    }

    private function retornaDistancia($porcentagem) {
        $alturaAreaGrafico = 480;
        $relacao = 8; # $alturaAreaGrafico / 60
        $correcao = 30;

        $res = $alturaAreaGrafico - ( ($porcentagem - $correcao) * $relacao );
        return $res;
    }

}
