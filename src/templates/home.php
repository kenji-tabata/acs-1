<?php require "poms/Formulario.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ACS</title>

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
            <div class="jumbotron"></div>
            <div id="content"></div>
        </div>

        <script type="text/template" id="poms-lista">
            <thead>
                <tr>
                    <th>
                        <button type="button" class="btn btn-default btn-relatorio-grupo" aria-label="Left Align" title="Relatório">gr</button>
                        <button type="button" class="btn btn-default btn-relatorio-parecer" aria-label="Left Align" title="Relatório">par</button>
                    </th>
                    <th>id</th>
                    <th>nome</th>
                    <th>email</th>
                    <th>cpf</th>
                    <th>sexo</th>
                    <th>quando preencheu</th>
                    <th>controles</th>
                </tr>
            </thead>
            <tbody></tbody>
        </script>

        <script type="text/template" id="poms-lista-item">
            <td><input type="checkbox" class="btn-selecionar"/></td>
            <td><%= prof.id %></td>
            <td><%= prof.nome %></td>
            <td><%= prof.email %></td>
            <td><%= prof.cpf %></td>
            <td><%= prof.genero %></td>
            <td><%= prof.preench %></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-delete" aria-label="Left Align" title="Deletar">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-formulario" aria-label="Left Align" title="Formulário">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-relatorio" aria-label="Left Align" title="Relatório">
                        <span class="glyphicon glyphicon-file" aria-hidden="true"></span
                    </button>
                </div>
            </td>
        </script>



<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Parecer</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <textarea class='form-control' rows='15'></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='laudo-parecer' >Emitir Laudo</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

        <script type="text/template" id="poms-formulario">
            <form action="salvar/" method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">Preencha os dados</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label form-group" for="txt-nome">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="txt-nome" maxlength="200" value="<%= nome %>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label form-group" for="txt-preench">Data de preenchimento</label>
                                    <input type="text" class="form-control" name="preench" id="txt-preench" maxlength="10" placeholder='__/__/____' value="<%= preench %>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label form-group" for="txt-email">Email</label>
                                    <input type="text" class="form-control" name="email" id="txt-email" maxlength="200" value="<%= email %>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label form-group" for="txt-cpf">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="txt-cpf" maxlength="14"  value="<%= cpf %>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4">
                                <div class="radio form-group">
                                    <label><input type="radio" name="genero" id="genero-masc" value="m" <% if (genero == 'm') { %>checked="checked"<%} %> >Masculino</label>
                                    <label><input type="radio" name="genero" id="genero-fem" value="f" <% if (genero == 'f') { %>checked="checked"<% } %> >Feminino</label>
                                </div>
                            </div>
                        </div>

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
                            <label for="" class="col-md-offset-2 col-sm-4 col-xs-8 control-label" style="font-size: 1.2em">
                                <?php echo ucfirst($adjetivo) ?>
                            </label>
                            <div class="col-sm-1 col-xs-3">
                                <input type="text" class="form-control" name="adjetivos" maxlength="1"/>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="form-group">
                        <div class="col-md-offset-5 col-md-2">
                            <button type="submit" class="btn btn-success btn-block" id="btn-salvar" >Salvar e...</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-5 col-md-3">
                            <div class="radio">
                                <label><input type="radio" name="eDepois" value="voltar-para-lista" checked="checked" />...voltar para lista.</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-5 col-md-3">
                            <div class="radio">
                                <label><input type="radio" name="eDepois" value="ver-laudo" />...ver laudo.</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-5 col-md-3">
                            <div class="radio">
                                <label><input type="radio" name="eDepois" value="continuar-inserindo" />...continuar inserindo.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.0/backbone-min.js"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="poms/poms.js"></script>
    </body>
</html>