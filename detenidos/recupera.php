<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Recuperar Password</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>

	<link rel="stylesheet" href="css/cssfonts.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/login.css">

</head>

<body>

	<div class="container">
		<header>
			<div class="row">
				<div class="col-md-2 col-xs-3 logotipo">
					<img src="./img/logo.png" align="left" border="1" width="100" height="100"/>
				</div>
				<div class="col-md-8 col-xs-9">
					<h3 align="center"><strong><span class="titulo1">RECUPERAR</span><br><span class="titulo2">CONTRASEÑA</span></strong></h3>
					<br>
				</div>
			</div>
		</header>
	</div>


	<div class="container-fluid">
		<div>
			<div class="col-xs-12  col-sm-2 col-md-2 col-lg-3"></div>
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-6 login-body">
				<div class="col-xs-12  col-md-4 col-lg-4">
					<img class="img-responsive imagenlogin" src="img/complementlogin.jpg"  style="border-bottom: 20px solid #a5a5a5;" alt="" height="100%">
				</div>
				<div class="col-xs-12  col-md-8 col-lg-8">

					<img class="img-responsive imagenlogin2" src="img/complementlogin2.jpg" alt="" >
					<div class="login">
						<h2>RECUPERA TU CONTRASEÑA</h2><br>
						

						<form method="post" action="PENDIENTE POR DEFINIR">
							<div class="form-group">
								<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" maxlength="100">
							</div>
							
							<div class="form-group">
								<input type="newpassword" class="form-control" name="newpassword" id="newpassword" placeholder="Nueva Contraseña" maxlength="100">
							</div>
							
							<div class="form-group">
								<input type="passwordconfirm" class="form-control" name="passwordconfirm" id="passwordconfirm" placeholder="confirmar Contraseña" maxlength="100">
							</div>

							<div class="login-button-row">
								<input type="submit" name="login-submit" id="login-submit" value="Enviar" title="Login now"><br><br>

							</div>
							
						</form>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-3"></div>
		</div>
	</div>
	<br><br><br><br><br>


	<footer>
		<img src="img/footerlogin.jpg" width="100%"/>        
	</footer>
</body>
</html>							