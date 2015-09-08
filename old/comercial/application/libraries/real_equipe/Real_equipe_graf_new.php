<?php

/* CAT:Polar and radars */
/* pChart library inclusions */
include("application/libraries/pChart/class/pData.class.php");
include("application/libraries/pChart/class/pDraw.class.php");
include("application/libraries/pChart/class/pRadar.class.php");
include("application/libraries/pChart/class/pImage.class.php");


class Real_equipe_graf_new{

    private $imagem;    # array

    public function setNomeArquivo() {
        $this->imagem['nome'] = './img/temp/' . uniqid() . '.png';
    }

    public function getNomeArquivo() {
        return $this->imagem['nome'];
    }

	public function deletar_imagem() {
        unlink($this->imagem['nome']);
    }
	
	
	function main($resultado){
		/* Create and populate the pData object */
		$MyData = new pData();

		# $resultado vem lс do controller...
		# passa pela view e chaga tщ aqui.
		$MyData->addPoints(array(
								$resultado['et'],
								$resultado['per'],
								$resultado['rec'],
								$resultado['rh'],
								$resultado['tof'],
								$resultado['int']),
								"Score");
		#$MyData->setSerieDescription("Score", "Application A");
		$MyData->setPalette("Score", array("R" => 157, "G" => 196, "B" => 22));

		/* Define the absissa serie */
		$MyData->addPoints(array("Execuчуo de tarefas", "Persuasivo", "Reconciliador", "Relaчѕes Humanas", "Tolerтncia a falhas", "Intuitivo"), "Families");
		$MyData->setAbscissa("Families");
		#var_dump($MyData); die();


		/* Create the pChart object */
		$myPicture = new pImage(600, 600, $MyData);
		$myPicture->drawGradientArea(0,
									 0,
									 600,
									 600,
									 DIRECTION_VERTICAL,
									 array(
										 "StartR" => 200,
										 "StartG" => 200,
										 "StartB" => 200,
										 "EndR" => 240,
										 "EndG" => 240,
										 "EndB" => 240,
										 "Alpha" => 100));
		$RectangleSettings = array("R" => 180, "G" => 180, "B" => 180, "Alpha" => 100);

		/* Set the default font properties */
		$myPicture->setFontProperties(array(
										"FontName" => "application/libraries/pChart/fonts/Forgotte.ttf",
										"FontSize" => 16,
										"R" => 80,
										"G" => 80,
										"B" => 80));

		/* Enable shadow computing */
		$myPicture->setShadow(TRUE, array(
										"X" => 2,
										"Y" => 2,
										"R" => 0,
										"G" => 0,
										"B" => 0,
										"Alpha" => 10));

		/* Draw a radar chart */
		$myPicture->setGraphArea(5, 10, 590, 590);



		/* Create the pRadar object */
		$SplitChart = new pRadar();
		$Options = array(
					"DrawPoly" => TRUE,
					"WriteValues" => TRUE,
					"ValueFontSize" => 16,
					"AxisRotation" => -90,
					"FixedMax" => 50,
					"Layout" => RADAR_LAYOUT_CIRCLE,
					"BackgroundGradient" => array(
												"StartR" => 255,
												"StartG" => 255,
												"StartB" => 255,
												"StartAlpha" => 100,
												"EndR" => 207,
												"EndG" => 227,
												"EndB" => 125,
												"EndAlpha" => 50));
		$SplitChart->drawRadar($myPicture, $MyData, $Options);

		/* Render the picture (choose the best way) */
		$myPicture->render($this->imagem['nome']);	
	
	}


}


?>