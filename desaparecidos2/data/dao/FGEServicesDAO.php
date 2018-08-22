	<?php

include_once __DIR__ . '/../../init.php';
include_once __DATA_PATH__ . '/GenericDAO.php';

/**
 * Description of VeoServicesDAO
 *
 */
class FGEServicesDAO extends GenericDAO {

    private $logger;

    public function __construct() {
        parent::__construct();
        $this->logger = Logger::getLogger('FGEServicesDAO');
    }
 /**
     * Busca por un registro en el directorio telefonico.
     * @param string $titular Nombre del titular. 
     * @param string $cargo Cargo del funcionario 
     * @param string $oficina oficina
     * @return array La informaci�n del funcionario o funcionarios.
     */
    public function getDesaparecidosByParams($nombre=null, $paterno=null, $materno=null,$sexo=null,$edad=null) {
	$condition=""; 

	if (empty($nombre) && empty($paterno) && empty($materno) && empty($sexo) && empty($edad))  
		throw new Exception('Por favor especifique al menos un valor de busqueda');
	if (!empty($nombre))
		$condition .= 'nombre like \'%'.$nombre .'%\''; 
	if (!empty($paterno))
		$condition = empty($condition) ? 'apat like \'%'.$paterno .'%\'': $condition . ' AND apat like \'%'.$paterno .'%\''; 
	if (!empty($materno))
		$condition = empty($condition) ? 'amat like \'%'.$materno .'%\'': $condition . ' AND amat like \'%'.$materno .'%\''; 
    if (!empty($sexo))
        $condition = empty($condition) ? 'sexo like \'%'.$sexo .'%\'': $condition . ' AND sexo like \'%'.$sexo .'%\''; 
    if (!empty($edad))
        $condition = empty($condition) ? 'edad = \''.$edad .'\'': $condition . ' AND edad = \''.$edad .'\'';     
    $sqlSelect = 'SELECT id,nombre, apat, amat, sexo, edad, origen, rutfoto,mun,estado,DATE_FORMAT(fextrav,\'%d-%m-%Y\') fextrav FROM desaparecidos WHERE '.$condition . ' AND Fcaptura <= "01/01/2017" AND tipo="INTERNO" AND public=1 AND status=1 order by apat,amat, nombre asc' ;
    //$sqlSelect = 'SELECT id,nombre, apat, amat, sexo, edad, origen, rutfoto,mun,estado,DATE_FORMAT(fextrav,\'%d-%m-%Y\') fextrav FROM desaparecidos2 WHERE '.$condition . '  order by apat,amat, nombre asc' ;
        $this->logger->debug('getDesaparecidosByParams: ' . $sqlSelect);
        $result = $this->select($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
    }


    public function getDesaparecidoById($id=null) {
    if (empty($id)){
        throw new Exception('Por favor especifique un id');
    } 
    $sqlSelect = " SELECT id, rutfoto, nombre, apat, amat, sexo, edad, nac, origen,estado,mun, DATE_FORMAT(fextrav,'%d-%m-%Y') fextrav ,est,compl,ojos,piel,cab,tcab,nariz,labios,cejas  FROM desaparecidos WHERE id=".$id;
    //    $sqlSelect = " SELECT rutfoto, nombre, apat, amat, sexo, edad, nac, origen,estado,mun, DATE_FORMAT(fextrav,'%d-%m-%Y') fextrav ,est,compl,ojos,piel,cab,tcab,nariz,labios,cejas  FROM desaparecidos2 WHERE id=".$id;
        $this->logger->debug('getDesaparecidoById: ' . $sqlSelect);
        $result = $this->select($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
    }


    public function insertInforme($id=null, $informe=null) {
    if (empty($id)){
        throw new Exception('Por favor especifique un id');
    }
    if (empty($informe)){
        throw new Exception('Por favor especifique un informe');
    }
    $fecha = date('Y-m-d H:i:s');
    $sqlInsert = "INSERT INTO tbl_avisos (idDesaparecido, aviso, fechaEnvio) VALUES ('$id','$informe','$fecha')";
        $this->logger->debug('insertInforme: ' . $sqlInsert);
        $result = $this->insert($sqlInsert);

        if(count($result) >= 1)
            $estado = '{"estado":"enviado"}';
        else 
            $estado = '{"estado":"error"}';

        return $estado;
    }

    /*pruebas para link de compartir
    */
    public function getdesaparecidolink($id){
        $sqlSelect = 'SELECT id,nombre, apat, amat, sexo, edad, origen, rutfoto,mun,estado,DATE_FORMAT(fextrav,\'%d-%m-%Y\') fextrav FROM desaparecidos WHERE id='.$id ;
        $result = $this->select($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;

    }

    public function authentication($user,$password) {

        if (empty($user) || empty($password)){
            session_destroy();
            return false;
        }
        else{
            $user = stripslashes($user);
            $password = stripslashes($password);

            $user = mysql_real_escape_string($user);
            $password = mysql_real_escape_string($password);
            $sqlSelect='SELECT * FROM db_users WHERE username="'.$user.'" ';

            $row=$this->select($sqlSelect);
            return $row;
        }
    }

    public function updatePassword($idUsuario,$current,$password) {
       // $ip = $_SERVER['HTTP_CLIENT_IP']?$_SERVER['HTTP_CLIENT_IP']:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);

        if (empty($idUsuario) || empty($password))  
            throw new Exception('Es necesario especificar TODOS los datos para actualizar el registro');

        $sqlSelect = "SELECT * FROM db_users WHERE id = '$idUsuario'";
        $row=$this->select($sqlSelect);
        $hash = $row[0]['password'];
        
        if (password_verify($current, $hash)) {
            $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
            $sqlSelect = 'UPDATE db_users SET password="'.$password.'" where id='.$idUsuario .'';
            $result=$this->update($sqlSelect);
            //$this->logger->debug('updatePassword-> |Usuario:' . $idUsuario. '|ip:'.$ip);
            if(count($result) >= 1)
                return $result;
            else 
                 throw new Exception('La contraseña anterior no coincide o existió un error al intentar actualizarla');
        }


        
    }

    public function Reporte($fechaInicial=null, $fechaFinal=null, $idUsuario=null, $idNivel=null) {

    $condition=""; 
    /*if (empty($fechaInicial) || empty($fechaFinal))  
        throw new Exception('Es necesario especificar las dos fechas para realizar la búsqueda');*/
        if($idNivel == 0){
            if (!empty($fechaInicial) && !empty($fechaFinal))
                $condition .= 'WHERE a.`fechaEnvio` BETWEEN \''.$fechaInicial .'\' AND \''.$fechaFinal .'\''; 
        }

        $sqlSelect = 'SELECT a.`id`, a.`idDesaparecido`, CONCAT_WS(" ", d.`Nombre`, d.`APat`, d.`AMat`)nombre, a.`aviso`, a.`fechaEnvio` FROM `tbl_avisos` a INNER JOIN `desaparecidos` d ON a.`idDesaparecido` = d.`Id` '.$condition;
        
        $result = $this->select($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
    }

    /* funciones para recuperacion de contraseña*/

    public function getEmail ($email){

        $sql = " SELECT * FROM db_users WHERE correo = '$email' ";
        $resultado = $this->select($sql);
        
        return $resultado;
        
    }

    public function generarLinkTemporal($idusuario, $username){

        $cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
        $token = sha1($cadena);
        $estado = true;
        $comprobacion = "UPDATE tblreseteopass SET estado = false WHERE idusuario=$idusuario AND estado = true;";
        $this->update($comprobacion);
        
        $sql = "INSERT INTO tblreseteopass (idusuario, username, token, creado, estado) VALUES($idusuario,'$username','$token',NOW() , $estado);";

        $resultado = $this->insert($sql);

        if($resultado){
            $enlace = $_SERVER["SERVER_NAME"].'/gobiernoabierto/desaparecidos/restablecer.php?idusuario='.sha1($idusuario).'&token='.$token.'&estado='.$estado;
            return $enlace;
        }
        else
            return FALSE;
    }

    public function enviarEmail( $email, $link ){

        $mensaje = '<html>
        <head>
            <title>Restablece tu contrase&ntilde;a</title>
            <style type="text/css" media="screen">
                .titulo1, .titulo2{
                    font-family: "neosanspro-bold";
                    font-size: 2.5rem;
                }
                .logotipo{
                    text-align: center;
                }    
            </style>
        </head>
        <body>
            <img src="http://compukami.esy.es/barra3.png" width="100%">
                <br>
            <p>Hemos recibido una petici&oacute;n para restablecer la contrase&ntilde;a de tu cuenta.</p>
            <p>Si hiciste esta petici&oacute;n, haz clic en el siguiente enlace, si no hiciste esta petici&oacute;n puedes ignorar este correo.</p>
            <p>
                <strong>Enlace para restablecer tu contrase&ntilde;a</strong><br>
                <a href="'.$link.'"> Restablecer contrase&ntilde;a </a>
            </p>
        </body>
</html>';

        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= 'From: Fiscalia General Del Estado <central@fiscalia.gob.mx>' . "\r\n";
        $asunto=utf8_decode("Recuperar contraseña");        
        mail($email, $asunto, $mensaje, $cabeceras);
    }

    public function getToken ($token,$estado){    
        if ($estado==true) {
            $sql = "SELECT * FROM tblreseteopass WHERE token = '$token' and estado = $estado";
            $resultado = $this->select($sql);
            return $resultado;
        }
        else
            return null;
    }

    public function recuperarPass($password1,$idusuario){
        $hash = password_hash($password1, PASSWORD_BCRYPT, array("cost" => 10));
        $sql = "UPDATE db_users SET password = '".$hash."' WHERE id = ".$idusuario;
        $resultado = $this->update($sql);
        if(count($resultado) >= 1)
            return $resultado;
        else 
            return NULL;

    }

    public function borrarToken($token){
        $sql = "UPDATE tblreseteopass SET estado = false WHERE token = '$token' AND estado = true;";
        //"DELETE FROM tblreseteopass WHERE token = '$token';";
        $resultado = $this->update( $sql );
    }

    public function enviaReporte($fechaInicial=null, $fechaFinal=null, $idUsuario=null, $idNivel=null){
        $sql = " SELECT * FROM db_users WHERE id = '$idUsuario' ";
        $resultado = $this->select($sql);
        $email = $resultado[0]['correo'];

        $condition=""; 
    /*if (empty($fechaInicial) || empty($fechaFinal))  
        throw new Exception('Es necesario especificar las dos fechas para realizar la búsqueda');*/
        if($idNivel == 0){
            if (!empty($fechaInicial) && !empty($fechaFinal))
                $condition .= 'WHERE a.`fechaEnvio` BETWEEN \''.$fechaInicial .'\' AND \''.$fechaFinal .'\''; 
        }

        $sqlSelect = 'SELECT a.`id`, a.`idDesaparecido`, CONCAT_WS(" ", d.`Nombre`, d.`APat`, d.`AMat`)nombre, a.`aviso`, a.`fechaEnvio` FROM `tbl_avisos` a INNER JOIN `desaparecidos` d ON a.`idDesaparecido` = d.`Id` '.$condition;

        $result = $this->select($sqlSelect);
        $numfilas = count($result);

        $tabla ="";
        $tabla = '<table border=1><thead><tr>No.<th></th><th>Nombre Desaparecido</th><th>Informe</th><th>Fecha Envío</th></tr></thead><tbody>';
        $numero=1;
        $counter= 0;
        while ($counter < $numfilas) {
            $fila = '<tr><td>'.$numero.'</td><td>'.$result[$counter]['nombre'].'</td><td>'.$result[$counter]['aviso'].'</td><td>'.$result[$counter]['fechaEnvio'].'</td></tr>';
            $tabla .= $fila;
            $counter++;
            $numero++;
        }
        $tabla .= '</tbody></table>';

        $mensaje = '<html>
        <head>
            <title>Reporte General de Informes Anónimos</title>
        </head>
        <body>
            <img src="http://compukami.esy.es/barra2.png" width="100%">
                <br>
            <div>'.$tabla.'</div>
        </body>
        </html>';
        $mensaje = utf8_decode($mensaje);

        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= 'From: Fiscalia General Del Estado <central@fiscalia.gob.mx>' . "\r\n";
        $asunto = utf8_decode("Reporte General de Informes Anónimos ");
        $bool = mail($email, $asunto, $mensaje, $cabeceras);
        if ($bool){
            $estado = '{"estado":"enviado"}';
            return $estado;
        }else{
            $estado = '{"estado":"error"}';
            return $estado;
        }
    }

    //validacion del estado de la cuenta

    public function generarLinkActivacion($idusuario){

        
        $comprobacion = "SELECT id, username, password, activacion, name, level,idUnidad FROM db_users WHERE id = ".$idusuario;
        $resultado = $this->select($comprobacion);
      
        if(count($resultado) >= 1){
        
            $estado=$resultado[0]['activacion'];
            $username=$resultado[0]['username'];
            $enlace = $_SERVER["SERVER_NAME"].'/gobiernoabierto/desaparecidos/activacion.php?idusuario='.$idusuario.'&nameusuario='.sha1($username).'&estado='.$estado;
            return $enlace;
        }
        else
            return FALSE;
    }

    public function enviarEmailActivacion( $email, $link ){

        $mensaje = '<html>
        <head>
            <title>Activación de cuenta</title>
            <style type="text/css" media="screen">
                .titulo1, .titulo2{
                    font-family: "neosanspro-bold";
                    font-size: 2.5rem;
                }
                .logotipo{
                    text-align: center;
                }    
            </style>
        </head>
        <body>
            <img src="http://compukami.esy.es/barra3.png" width="100%">
                <br>
            <p>Hemos recibido una petici&oacute;n para la activacion de su cuenta.</p>
            <p>Si hiciste esta petici&oacute;n para registrarte, haz clic en el siguiente enlace, si no hiciste esta petici&oacute;n puedes ignorar este correo.</p>
            <p>
                <strong>Enlace para activar su cuenta</strong><br>
                <a href="'.$link.'"> Activar cuenta </a>
            </p>
        </body>
</html>';

        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= 'From: Fiscalia General Del Estado <central@fiscalia.gob.mx>' . "\r\n";
        $asunto=utf8_decode("Activacion de cuenta");        
        mail($email, $asunto, $mensaje, $cabeceras);
    }


    public function getEstadoCuenta($idusuario){
        $sql = "SELECT * FROM db_users WHERE id = ".$idusuario;
        $resultado = $this->select($sql);
        if(count($resultado) >= 1)
            return $resultado;
        else 
            return NULL;

    }
    

    public function activarCuenta($idusuario){
        $sql = "UPDATE db_users SET activacion = 1 WHERE id = ".$idusuario;
        $resultado = $this->update($sql);
        if(count($resultado) >= 1)
            return $resultado;
        else 
            return NULL;
    }
    
    public function rechazarCuenta($idusuario){
        $sql = "UPDATE db_users SET activacion = 3 WHERE id = ".$idusuario;
        $resultado = $this->update($sql);
        if(count($resultado) >= 1)
            return $resultado;
        else 
            return NULL;
    }

    /*proceso de registro de usuarios*/
    public function registroUsuario($nombre,$usuario,$pass,$correo,$unidad){
        $hash2 = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 10));
        $sql = "INSERT INTO db_users (username, password, activacion, name, idUnidad, correo) VALUES('".$usuario."','".$hash2."', 0 ,'".$nombre."' ,".$unidad." ,'".$correo."'  );";

        $resultado = $this->insert($sql);
        
        if(count($resultado) >= 1)
            return $resultado;
        else 
            return NULL;

    }

    public function getComprobacion ($user,$email){

        $sql = " SELECT * FROM db_users WHERE correo = '".$email."' OR username = '".$user."' AND activacion = 1;";
        $resultado = $this->select($sql);
        
        if(count($resultado) >= 1)
            return $resultado;
        else 
            return NULL;
        
    }

    public function insertUser($nombreUser,$username, $pass, $usercorreo, $idUnidadUser, $levelUser  ,$estadoUser) {
        $hash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 10));
        $condition="";
        if (empty($nombreUser) || empty($username) || empty($pass) || empty($usercorreo) || empty($idUnidadUser) || is_null($levelUser) || is_null($estadoUser))  {
            throw new Exception('Es necesario especificar TODOS los datos para crear el registro');
        }

        $sqlSelect = 'INSERT INTO db_users(`username`, `password`, `activacion`, `name`, `idUnidad`, `correo`, `level`) VALUES ("'. $username .'","'. $hash .'",'. $estadoUser .',"'. $nombreUser .'",' . $idUnidadUser .',"'.$usercorreo.'",'.$levelUser.')' ;
        $result = $this->insert($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
    }

    public function updateUser($idUser, $nombreUser, $username, $usercorreo, $idUnidadUser, $levelUser, $estadoUser){
        if (is_null($idUser) || empty($nombreUser) || empty($username) || empty($usercorreo) || is_null($idUnidadUser) || is_null($levelUser) || is_null($estadoUser)){  
            throw new Exception('Es necesario especificar TODOS los datos para actualizar el registro');
        }

        $sqlSelect = 'UPDATE db_users u SET u.username="'.$username.'", u.activacion='.$estadoUser.', u.name="'.$nombreUser.'", u.idUnidad='.$idUnidadUser.', u.correo="'. $usercorreo.'", u.level='.$levelUser.' WHERE u.id='.$idUser.';';
        
        $result=$this->update($sqlSelect);    

        if(count($result) >= 1)
            return $result;
        else 
            return NULL;

    

    }

    public function autorizarUser($idUser){
        if (is_null($idUser)){  
            throw new Exception('hubo problemas en actualizar TODOS los datos para actualizar el registro');
        }

        $sqlSelect = 'UPDATE db_users u SET u.activacion= 2 WHERE u.id='.$idUser.';';
        
        $result=$this->update($sqlSelect);    

        if(count($result) >= 1)
            return $result;
        else 
            return NULL;

    }

    public function rechazarUser($idUser){
        if (is_null($idUser)){  
            throw new Exception('hubo problemas en actualizar TODOS los datos para actualizar el registro');
        }

        $sqlSelect = 'UPDATE db_users u SET u.activacion= 3 WHERE u.id='.$idUser.';';
        
        $result=$this->update($sqlSelect);    

        if(count($result) >= 1)
            return $result;
        else 
            return NULL;

    }

    public function getEmailActivacion ($idUser){

        $sql = " SELECT * FROM db_users WHERE id = '$idUser' ";
        $resultado = $this->select($sql);
        
        return $resultado;
        
    }

     public function getUnidades() {
        $sqlSelect = 'SELECT * FROM unidad order by nombre' ;
        //     $this->logger->debug('getUnidades: ' . $sqlSelect);
        $result = $this->select($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
    }


}
?>
