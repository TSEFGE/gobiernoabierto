<html ng-app="detenidosApp">
<head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

    <link rel="stylesheet" type="text/css" media="screen" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/prettify-1.0.css" rel="stylesheet">

    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/base.css" rel="stylesheet">

    <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <link href="./libjs/bootstrap-combined.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-messages.js"></script>

    <script src="./js/detenidos.js"></script>
    <title>Gobierno Abierto - Registro Público de Personas Detenidas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        body{
            margin-left: 30px;
            margin-right: 30px;
              font-size: 12px;
                font-weight: bolder;
                font-family: sans-serif;
        }
       input {
            text-transform: uppercase;
        }
        input.ng-invalid {
             border: 1px solid red;
        }
        input.ng-invalid-required.ng-dirty {
             border: 1px solid blue;
        }
        
    
        legend {
                font-size: 12px;
                font-weight: bolder;
                font-family: sans-serif;
        }
        legend img {
            width:50px;
            height:50px;
        }
        label{
               font-size: 16px;
                font-weight: bolder;
                font-family: sans-serif;
        }
        </style>
    </head>
    <body>
         <header><center>
                    <img src="./img/header.jpg" />
        </header>
        <a href="https://drive.google.com/open?id=0B3WZvqbqPu3pRzJKWEVVXzFzbEk"><img src="./img/manual.png" width="60" height="60" style="cursor: pointer; margin-right: 40px ;" data-toggle="tooltip" data-placement="top" title="Manual de usuario"/><p>Manual de Usuario</p></a>



        <div>
             <html><!-- This form will post to current page and trigger our PHP script. -->
</head>
<div class="login-body" style="margin: 0 auto; width: 600px; ">
<fieldset class="scheduler-border">
            <legend class="scheduler-border" style="font-size: 14px; font-weight: bolder; font-family: sans-serif;"><img src="./img/login.png" style="width:64px; height:64px;"/> Iniciar Sesión</legend>
<form method="post" action="authentication.php">
		<?php
			if (isset($error)) {
				echo "<div class='errormsg'>$error</div>";
			}
		?>
		<div class="form-row">
			<label for="usuario">Usuario:</label>
			<input type="text" name="usuario" id="usuario" placeholder="usuario" maxlength="100">
		</div>
		<div class="form-row">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" id="password" placeholder="Contraseña" maxlength="100">
		</div>

		<div class="login-button-row">
			<input type="submit" name="login-submit" id="login-submit" value="INGRESAR" title="Login now">
		</div>
</form>
        </fieldset>
</div>
    <footer>
        <img src="./img/footer.jpg" width="100%" style="vertical-align:center;"/>        
    </footer>
    </body>
</html> 