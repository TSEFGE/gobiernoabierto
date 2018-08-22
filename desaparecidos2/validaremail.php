<?php


require 'vendor/autoload.php';
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
$dao = new FGEServicesDAO();


	$email = mysql_real_escape_string($_POST['email']);
	$respuesta = new stdClass();

	if( $email != "" ){   
   		
        $resultado=$dao->getEmail($email);

   		if(count($resultado)>0){
      		$usuario = $resultado[0]['username'];
      		$idusuario = $resultado[0]['id'];
            $linkTemporal = $dao->generarLinkTemporal( $idusuario, $usuario );
      		if($linkTemporal){
        		$dao->enviarEmail( $email, $linkTemporal );

        		$respuesta->mensaje = 'correcto';

      		}
   		}
   		else{	
   			$respuesta->mensaje = 'noexiste';
   		}
	}
	echo json_encode( $respuesta );
?>


 	


  