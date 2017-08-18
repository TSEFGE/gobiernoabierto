<?php


require 'vendor/autoload.php';
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
$dao = new FGEServicesDAO();


$name = strtoupper(mysql_real_escape_string($_POST['Rname']));
$user = strtoupper(mysql_real_escape_string($_POST['Ruser']));
$email = mysql_real_escape_string($_POST['Remail']);
$pass1 = strtoupper(mysql_real_escape_string($_POST['Rpass1']));
$pass2 = strtoupper(mysql_real_escape_string($_POST['Rpass2']));
$unidad = mysql_real_escape_string($_POST['Runidad']);

$respuesta = new stdClass();

if( $email != "" || $name != "" || $user != "" || $pass1 != "" || $pass2 != "" || $unidad != ""){   


    $resultado=$dao->getComprobacion($user,$email);
    $dbuser=$resultado[0]['username'];
    $dbcorreo=$resultado[0]['correo'];

    if ($dbcorreo==$email) {
        $respuesta->mensaje2 = 'yaexistecorreo';

        }else{
        if ($dbuser==$user) {
            $respuesta->mensaje2 = 'yaexisteuser';
            }else{

                if ($pass2==$pass1) {
                    $registro=$dao->registroUsuario($name,$user,$pass1,$email,$unidad);
                    $resultado=$dao->getComprobacion($user,$email);
                    $idusuario=$resultado[0]['id'];
                    /*
                    if ($registro) {
                        $linkTemporal = $dao->generarLinkActivacion( $idusuario, $user );
                    
                        if($linkTemporal){
                            $dao->enviarEmailActivacion( $email, $linkTemporal );
                            $respuesta->mensaje2 = 'correcto';
                        }
                    }
                    */
                    
                }else{
                    $respuesta->mensaje2 = 'passdiferente';
                }
                
            }
        }

    
}
echo json_encode( $respuesta );
?>


 	


  