<?php 
require 'vendor/autoload.php';
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
$dao = new FGEServicesDAO();

$password1 = mysql_real_escape_string(strtoupper($_POST['password1']));
$password2 = mysql_real_escape_string(strtoupper($_POST['password2']));
$idusuario = mysql_real_escape_string($_POST['idusuario']);
$token = mysql_real_escape_string($_POST['token']);

if( $password1 != "" && $password2 != "" && $idusuario != "" && $token != "" ){
	
	?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<title> Restablecer contraseña </title>
		
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


					$resultado=$dao->getToken($token);
	
				if( count($resultado)>0){
					$usuario = $resultado[0]['idusuario'];
					if( sha1($usuario) === $idusuario ){

						if( $password1 === $password2 ){
							$resultado = $dao->recuperarPass($password1,$usuario);
							if($resultado!=null){
								
								$dao->borrarToken($token);
								
								?>
								<script>
									swal({
										  title: '¡Hecho!',
										  text: 'La contraseña se actualizó con exito.',
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
										  text: 'Ocurrió un error al actualizar la contraseña, intentalo más tarde.',
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
										  text: 'Las contraseñas no coinciden.',
										  type: 'warning',
										  timer: 5000
										}).then(
										  function () {
										  	history.back(1);
										  },
										  // handling the promise rejection
										  function (dismiss) {
										    if (dismiss === 'timer') {
										      history.back(1);
										    }
										    history.back(1);
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
										  text: 'El token no es válido.',
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
										  text: 'El token no es válido.',
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