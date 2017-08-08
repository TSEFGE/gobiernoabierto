<?php
/*$conexion = new mysqli('localhost', 'root', '', 'detenidos');
$sql = " SELECT id, password FROM db_users";
$resultado = $conexion->query($sql);

if( $resultado->num_rows > 0 ){
	while($usuario = $resultado->fetch_assoc()){
		$password = $usuario['password'];
		echo $usuario['password']."---------";
		$hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
		$sql = "UPDATE db_users SET password = '".$hash."' WHERE id = ".$usuario['id'];
		$resultado2 = $conexion->query($sql);
		echo $hash."<br>";
	}
}*/