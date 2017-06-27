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
        
        body table tr td {
            padding: 5px;
            font-size: 14px;
            font-weight: bolder;
            color:  #EF9E9F;
            font-weight: bold;
            padding: 5px;
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
        </style>
    </head>
    <body>
         <header><center>
                    <img src="./img/header.jpg" />
        </header>
        <!--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"> </script> -->
        <!-- <script type="text/javascript" src="./libjs/bootstrap.min.js"> </script>-->
        <!--<script type="text/javascript" src="./libjs/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"> </script>-->
        <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/base.js"> </script>
        <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/prettify-1.0.min.js"> </script>
        <div>
             <html><!-- This form will post to current page and trigger our PHP script. -->
</head>
<form method="post" action="">
	<div class="login-body">
		<?php
			if (isset($error)) {
				echo "<div class='errormsg'>$error</div>";
			}
		?>
		<div class="form-row">
			<label for="emailaddress">Email:</label>
			<input type="text" name="emailaddress" id="emailaddress" placeholder="Email Address" maxlength="100">
		</div>
		<div class="form-row">
			<label for="pass">Password:</label>
			<input type="password" name="pass" id="pass" placeholder="Password" maxlength="100">
		</div>

		<div class="login-button-row">
			<input type="submit" name="login-submit" id="login-submit" value="Login" title="Login now">
		</div>
	</div>
</form>
    <footer>
        <img src="./img/footer.jpg" width="100%" style="vertical-align:center;"/>        
    </footer>
    </body>
</html> 
