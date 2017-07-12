<?php 
	$token = $_GET['token'];
	$idusuario = $_GET['idusuario'];
	
	$conexion = new mysqli('localhost', 'root', '', 'detenidos');

	$sql = "SELECT * FROM tblreseteopass WHERE token = '$token'";
	$resultado = $conexion->query($sql);
	
	if( $resultado->num_rows > 0 ){
		$usuario = $resultado->fetch_assoc();

		if( sha1($usuario['idusuario']) == $idusuario ){
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
						<h2>RECUPERA TU CONTRASEÑA</h2>
						
						<h5>¡Bienvenido!</h5>

						<form method="post" action="cambiarpassword.php">
												
							<div class="form-group">
								<input type="password" class="form-control" name="password1" placeholder="Nueva Contraseña" required>
							</div>
							
							<div class="form-group">
								<input type="password" class="form-control" name="password2" placeholder="confirmar Contraseña" required>
							</div>
							
							<input type="hidden" name="token" value="<?php echo $token ?>">
              				<input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
							<div class="login-button-row">
								<input type="submit" class="btn btn-primary" value="Recuperar contraseña" ><br><br>

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
<?php
		}
		else{
			header('Location:login.php');
		}
	}
	else{
		header('Location:login.php');
	}
?>