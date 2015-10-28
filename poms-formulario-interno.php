<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Formulário POMS</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container" style="margin-bottom: 200px;">

            <div class="jumbotron">
                <h1>POMS</h1>
                <p>Formulário Interno</p>
            </div>

            <form action="/poms/formulario/salvar/" method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">Preencha os dados</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="txt-nome">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="txt-nome" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="txt-email">Email</label>
                                    <input type="text" class="form-control" name="email" id="txt-email" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt-cpf">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="txt-cpf" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4">
                                <div class="radio">
                                    <label><input type="radio" name="genero" id="genero-mas" value="m">Masculino</label>
                                    <label><input type="radio" name="genero" id="genero-fem" value="f">Feminino</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success col-md-offset-6 col-xs-offset-4" id="btn-salvar-dados">Salvar dados</button>
                    </div>
                </div>

                <div>
                    <p>Preencha todos as palavras com valores de 1 a 5, conforme a legenda abaixo.</p>
                    <ul>
                        <li>1 = Extremamente baixo.</li>
                        <li>2 = Baixo.</li>
                        <li>3 = Médio.</li>
                        <li>4 = Alto.</li>
                        <li>5 = Extremamente alto.</li>
                    </ul>
                </div>

                <div class="form-horizontal">

                    <?php foreach (FormularioPoms::adjetivos() as $key => $adjetivo): ?>
                        <div class="form-group">
                            <label for="" class="col-md-offset-2 col-sm-4 col-xs-8 control-label"><?php echo $key . ". " . ucfirst($adjetivo) ?></label>
                            <div class="col-sm-1 col-xs-3">
                                <input type="text" class="form-control" name="adjetivos[]" />
                            </div>
                        </div>
                    <?php endforeach; ?>


                    <div class="form-group">
                        <div class="col-md-offset-5 col-md-2">
                            <button type="submit" class="btn btn-success btn-block" id="btn-salvar-e" />Salvar e...</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-5 col-md-2">
                            <div class="radio">
                                <label><input type="radio" name="depois-de-salvar" value="voltar-para-lista" checked="checked" />...voltar para lista.</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-5 col-md-2">
                            <div class="radio">
                                <label><input type="radio" name="depois-de-salvar" value="ver-laudo" />...ver laudo.</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-5 col-md-2">
                            <div class="radio">
                                <label><input type="radio" name="depois-de-salvar" value="continuar-inserindo" />...continuar inserindo.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

    
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.0/backbone-min.js"></script>            
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    </body>
</html>