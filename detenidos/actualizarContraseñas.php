<?php
$conexion = new mysqli('localhost', 'web', 'W3b2015_@', 'detenidos');
$sql = " SELECT id, password FROM db_users where id>=756";
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
}
