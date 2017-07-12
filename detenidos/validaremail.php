<?php
	function generarLinkTemporal($idusuario, $username){

		$cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
		$token = sha1($cadena);
		
		$conexion = new mysqli('localhost', 'root', '', 'detenidos');

		$sql = "INSERT INTO tblreseteopass (idusuario, username, token, creado) VALUES($idusuario,'$username','$token',NOW());";

		$resultado = $conexion->query($sql);
		if($resultado){
			$enlace = $_SERVER["SERVER_NAME"].'/proyectos/gobiernoabierto/detenidos/restablecer.php?idusuario='.sha1($idusuario).'&token='.$token;
			return $enlace;
		}
		else
			return FALSE;
	}

	function enviarEmail( $email, $link ){

		$mensaje = '<html>
		<head>
 			<title>Restablece tu contrase&ntilde;a</title>
		</head>
		<body>
 			<p>Hemos recibido una petici&oacute;n para restablecer la contrase&ntilde;a de tu cuenta.</p>
 			<p>Si hiciste esta petici&oacute;n, haz clic en el siguiente enlace, si no hiciste esta petici&oacute;n puedes ignorar este correo.</p>
 			<p>
 				<strong>Enlace para restablecer tu contrase&ntilde;a</strong><br>
 				<a href="'.$link.'"> Restablecer contrase&ntilde;a </a>
 			</p>
		</body>
		</html>';

		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: RECUPERAR CONTRASE&ntilde;A:FGE <central@fiscalia.gob.mx>' . "\r\n";
		
		mail($email, "Recuperar contrase&ntilde;a", $mensaje, $cabeceras);
	}
	
	$email = $_POST['email'];
	$respuesta = new stdClass();

	if( $email != "" ){   
   		$conexion = new mysqli('localhost', 'root', '', 'detenidos');

   		$sql = " SELECT * FROM db_users WHERE correo = '$email' ";
   		$resultado = $conexion->query($sql);

   		if($resultado->num_rows > 0){
      		$usuario = $resultado->fetch_assoc();
			$linkTemporal = generarLinkTemporal( $usuario['id'], $usuario['username'] );
      		if($linkTemporal){
        		enviarEmail( $email, $linkTemporal );
        		$respuesta->mensaje = '<div class="alert alert-info"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contrase&ntilde;a </div>';
      		}
   		}
   		else
   			$respuesta->mensaje = '<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';
	}
	else
   		$respuesta->mensaje= "Debes introducir el email de la cuenta";
 	echo json_encode( $respuesta );