<?php 
require 'vendor/autoload.php';
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
$dao = new FGEServicesDAO();

$idusuario = mysql_real_escape_string($_POST['idusuario']);
$nameusuario = mysql_real_escape_string($_POST['nameusuario']);
$estado = mysql_real_escape_string($_POST['estado']);


if( $idusuario != "" && $nameusuario != "" && $estado == 2){
	
	?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<title> Activacion de Cuenta </title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
	</head>

	<body>
		<div class="container" role="main">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php


					$resultado=$dao->getEstadoCuenta($idusuario);
	
				if( count($resultado)>0){
					$usuario = $resultado[0]['username'];
					if( sha1($usuario) === $nameusuario ){

						
							$resultado = $dao->activarCuenta($idusuario);
							if($resultado!=null){								
								?>
								<script>
									swal({
										  title: '¡Hecho!',
										  text: 'La cuenta se a Activado con exito.',
										  type: 'success',
										  timer: 5000
										}).then(
										  function () {
										  	location.href ="login.php";
										  },
										  // handling the promise rejection
										  function (dismiss) {
										    if (dismiss === 'timer') {
										      location.href ="login.php";
										    }
										    location.href ="login.php";
										  }
										);
								</script>
								
								<?php
							}
							else{
								?>
								<script>
									swal({
										  title: '¡Atención!',
										  text: 'Ocurrió un error al activar la cuenta, intentalo más tarde.',
										  type: 'error',
										  timer: 5000
										}).then(
										  function () {
										  	location.href ="login.php";
										  },
										  // handling the promise rejection
										  function (dismiss) {
										    if (dismiss === 'timer') {
										      location.href ="login.php";
										    }
										    location.href ="login.php";
										  }
										);
								</script>
								<?php
							}
						

					}
					else{
						?>
						<script>
									swal({
										  title: '¡Atención!',
										  text: 'El proceso no es válido.',
										  type: 'error',
										  timer: 5000
										}).then(
										  function () {
										  	location.href ="login.php";
										  },
										  // handling the promise rejection
										  function (dismiss) {
										    if (dismiss === 'timer') {
										      location.href ="login.php";
										    }
										    location.href ="login.php";
										  }
										);
								</script>
						<?php
					}	
				}
				else{
					?>
					<script>
									swal({
										  title: '¡Atención!',
										  text: 'El proceso no es válido.',
										  type: 'error',
										  timer: 5000
										}).then(
										  function () {
										  	location.href ="login.php";
										  },
										  // handling the promise rejection
										  function (dismiss) {
										    if (dismiss === 'timer') {
										      location.href ="login.php";
										    }
										    location.href ="login.php";
										  }
										);
								</script>
					<?php
				}
				?>
			</div>
			<div class="col-md-2"></div>
		</div> <!-- /container -->
		
    
	</body>
	</html>
	<?php
}
else{
	
	header('Location:login.php');
}
?>