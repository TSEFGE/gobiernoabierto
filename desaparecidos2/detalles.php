<?php 

require 'vendor/autoload.php';
	include_once 'init.php';
	include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
	$dao = new FGEServicesDAO();

	$id = mysql_real_escape_string($_GET['id']);
	

	$resultado=$dao->getdesaparecidolink($id);

	if( count($resultado)>0){
		$nombre=$resultado[0]['nombre'];
		$apat=$resultado[0]['apat'];
		$amat=$resultado[0]['amat'];
		$sexo=$resultado[0]['sexo'];
		$fecdes=$resultado[0]['fextrav'];
		echo "entro";
		$titulo="Ayudanos a encontrar a ".$nombre." ".$apat." ".$amat;
		$description="Ayudanos a encontrar a ".$nombre." ".$apat." ".$amat." se extravio en la fecha ".$fecdes;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:title" content="<?php echo $titulo ?>">
	<meta property="og:type" content="article">
	<meta property="og:description" content="<?php echo $description ?>">
	<meta property="og:url" content="http://gobiernoabierto.fiscaliaveracruz.gob.mx/desaparecidos/">
	<link rel="stylesheet" href="">
</head>
<body>
	<?php 
	echo $titulo;
 
?>
<br>
<?php  
	echo $description; 
	 ?>
</body>
</html>
<?php 
}else{header('Location:index4.html');
}


?>