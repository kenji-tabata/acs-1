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

        <script type="text/template" id="lista-poms-profissionais">
            <table class="table">
                <tr>
                    <th>id</th>
                    <th>nome</th>
                    <th>email</th>
                    <th>cpf</th>
                    <th>sexo</th>
                    <th>quando preencheu</th>
                    <th>controles</th>
                </tr>
                /*<% for(var prof in profissionais) { %>*/
                <% _.each(profissionais, function(prof) { %>
                    <tr>
                        <td><%= prof.id %></td>
                        <td><%= prof.nome %></td>
                        <td>email</td>
                        <td>cpf</td>
                        <td>sexo</td>
                        <td>quando preencheu</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span
                                </button>
                                <button type="button" class="btn btn-default" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                <% }); %>
                /*<% } %>*/
            </table>
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.0/backbone-min.js"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>