<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Real_equipe_graf {

    private $imagem;    # array
    const IMG_TEMP = "./img/temp/temp.png";
    const IMG_TRI  = './application/libraries/real_equipe/tri.png';

    const MOSTRAR_NO_BROWSER = 1;
    const GRAVAR_NO_DISCO = 2;

    public function setNomeArquivo() {
        $this->imagem['nome'] = './img/temp/' . uniqid() . '.png';
    }

    public function getNomeArquivo() {
        return $this->imagem['nome'];
    }

    public function setDisplay($display) {
        $this->imagem['display'] = $display;
    }

    public function setPontuacao() {


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
        unlink(self::IMG_TEMP);        
    }

    private function desenhar_imagem() {
        /******************************************************************
         **                  Aqui inicia a imagem                        **
         **                                                              **
         ******************************************************************/        
        # inicia imagem
        $w = 800;
        $h = 570;
        $imagem = imagecreatetruecolor($w, $h);

        # cores
        $black = imagecolorallocate($imagem, 0, 0, 0);
        $cinza = imagecolorallocate($imagem, 240, 240, 240);
        $red   = imagecolorallocate($imagem, 255, 0, 0);
        $blue  = imagecolorallocate($imagem, 0, 0, 255);

        # backgroud
        imagefill($imagem, 0, 0, $cinza);

        # Define as fontes
        #$font = '/usr/share/fonts/truetype/msttcorefonts/arial.ttf';
        $font = './system/fonts/arial.ttf';


        /******************************************************************
         **                           Grade                              **
         **                                                              **
         ******************************************************************/
        $grade_cor    = $black;
        $grade_aresta = 40;

        $grade_qtd_linhas_ver = 18;
        $grade_qtd_linhas_hor = 13;

        $grade_marg_sup = 20;
        $grade_marg_esq = 40;

        $grade_altura  = ($grade_aresta*$grade_qtd_linhas_hor) + $grade_marg_sup;
        $grade_largura = ($grade_aresta*$grade_qtd_linhas_ver) + $grade_marg_esq;

        # Verticais
        $x1 = $grade_marg_esq;
        $y1 = $grade_marg_sup;
        $x2 = $x1;
        $y2 = $grade_altura;
        for($i = 0; $i < $grade_qtd_linhas_ver; $i++){
            $x1 = $x1 + $grade_aresta;
            $x2 = $x1;
            imageline($imagem, $x1, $y1, $x2, $y2, $grade_cor);
        }

        # Horizontais
        $x1 = $grade_marg_esq;
        $y1 = $grade_marg_sup;
        $x2 = $grade_largura;
        $y2 = $y1;
        for($i = 0; $i < $grade_qtd_linhas_hor; $i++){
            $y1 = $y1 + $grade_aresta;
            $y2 = $y1;
            imageline($imagem, $x1, $y1, $x2, $y2, $grade_cor);
        }

        # Primeira linha vertical(que o laço for não desenha)
        $x1 = $grade_marg_esq;
        $y1 = $grade_marg_sup;
        $x2 = $grade_marg_esq;
        $y2 = 540;
        imageline($imagem, $x1, $y1, $x2, $y2, $grade_cor);

        # Primeira linha horizontal(que o laço for não desenha)
        $x1 = $grade_marg_esq;
        $y1 = $grade_marg_sup;
        $x2 = 760;
        $y2 = $grade_marg_sup;
        imageline($imagem, $x1, $y1, $x2, $y2, $grade_cor);





        /******************************************************************
         **                           Legendas                           **
         **                                                              **
         ******************************************************************/
        $size     = 9;
        $angle    = 0;
        $color    = $red;
        $fontfile = $font;

        # ...esquerda
        $x        = 15;

        $y        = 30;
        $text     = "16";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 32;
        $text     = "14";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "12";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "10";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x = $x + 6;
        $y        = $y + 40;
        $text     = "8";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "6";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "4";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "2";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "0";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x = $x - 3;
        $y        = $y + 40;
        $text     = "-2";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "-4";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "-6";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "-8";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $y        = $y + 40;
        $text     = "10";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);
        // ===================================================================== //




        # ...inferior
        $x        = 35;
        $y        = 560;
        $text     = "-9";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 38;
        $y        = 560;
        $text     = "-8";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 42;
        $y        = 560;
        $text     = "-7";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 38;
        $y        = 560;
        $text     = "-6";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 40;
        $y        = 560;
        $text     = "-5";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 38;
        $y        = 560;
        $text     = "-4";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 40;
        $y        = 560;
        $text     = "-3";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 42;
        $y        = 560;
        $text     = "-2";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 40;
        $y        = 560;
        $text     = "-1";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 43;
        $y        = 560;
        $text     = "0";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 38;
        $y        = 560;
        $text     = "1";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 42;
        $y        = 560;
        $text     = "2";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 38;
        $y        = 560;
        $text     = "3";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 40;
        $y        = 560;
        $text     = "4";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 38;
        $y        = 560;
        $text     = "5";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 40;
        $y        = 560;
        $text     = "6";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 42;
        $y        = 560;
        $text     = "7";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 40;
        $y        = 560;
        $text     = "8";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);

        $x        = $x + 43;
        $y        = 560;
        $text     = "9";
        imagettftext($imagem, $size, $angle, $x, $y, $color, $fontfile, $text);





        /******************************************************************
         **                          Triangulo                           **
         **                                                              **
         ******************************************************************/
        //$tri_topo      = 100;
        //$tri_base_dist = 460;
        //
        //$tri_base_x1   = 160;
        //$tri_base_meio = 400;
        //$tri_base_x2   = 640;
        //
        //
        //# base
        //$x1 = $tri_base_x1;
        //$y1 = $tri_base_dist;
        //$x2 = $tri_base_x2;
        //$y2 = $tri_base_dist;
        //imageline($imagem, $x1, $y1, $x2, $y2, $blue);
        //
        //# aste da esquerda
        //$x1 = $tri_base_x1;
        //$y1 = $tri_base_dist;
        //$x2 = $tri_base_meio;
        //$y2 = $tri_topo;
        //imageline($imagem, $x1, $y1, $x2, $y2, $blue); 
        //
        //# aste da direita
        //$x1 = $tri_base_meio;
        //$x2 = $tri_base_x2;
        //$y1 = $tri_topo;
        //$y2 = $tri_base_dist;
        //imageline($imagem, $x1, $y1, $x2, $y2, $blue); 




        /******************************************************************
         **                          Estrela                             **
         **                                                              **
         ******************************************************************/

        # decres
        $x1 = 80;
        $x2 = 720;
        $y1 = 180;
        $y2 = 500;
        imageline($imagem, $x1, $y1, $x2, $y2, $red);

        # cres
        $x1 = 80;
        $x2 = 720;
        $y1 = 500;
        $y2 = 180;
        imageline($imagem, $x1, $y1, $x2, $y2, $red);

        # vertical
        $x1 = 400;
        $x2 = 400;
        $y1 = 60;
        $y2 = 500;
        imageline($imagem, $x1, $y1, $x2, $y2, $red);

        

        /******************************************************************
         **                  Monta a imagem final                        **
         **                                                              **
         ******************************************************************/

        # Salva uma imagem temporária
        imagepng($imagem, self::IMG_TEMP);
               
        $w = 800;
        $h = 570;
        $imgDest = imagecreatetruecolor($w, $h);
        imageFill($imgDest, 0, 0, ImageColorAllocate($imgDest, 250, 250, 200));

        $tri     = imageCreateFromPng(self::IMG_TRI);
        $grafico = imageCreateFromPng(self::IMG_TEMP);

        # Junta o gráfico
        $dst_x = 0; 
        $dst_y = 0;
        $src_x = 0;
        $src_y = 0;
        $src_w = 800;
        $src_h = 570;
        imageCopy ($imgDest, $grafico, $dst_x, $dst_y, $src_x,$src_y, $src_w, $src_h);

        # Junta o tringâulo
        $dst_x = 154;
        $dst_y = 90;
        $src_x = 0;
        $src_y = 0;
        $src_w = 490;
        $src_h = 430;
        imageCopy($imgDest, $tri, $dst_x, $dst_y, $src_x,$src_y, $src_w, $src_h);

        $this->imagem['imagem'] = $imgDest;
        
    }# end function desenhar_imagem

}# end of file