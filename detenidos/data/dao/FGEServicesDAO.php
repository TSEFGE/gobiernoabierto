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
    public function getDetencion($nombre=null, $paterno=null, $materno=null, $sexo=null, $fechaNacimiento=null) {

$getLastId=true;
	$condition=""; 
    if (empty($nombre) || empty($paterno) || empty($materno) || empty($sexo) || empty($fechaNacimiento))  
        throw new Exception('Es necesario especificar TODOS los datos (nombre completo, sexo y fechaNacimiento) para realizar la búsqueda');
    if (!empty($nombre))
        $condition .= 'dete.nombre like \''.$nombre .'\''; 
    if (!empty($paterno))
        $condition = empty($condition) ? 'paterno like \''.$paterno .'\'': $condition . ' AND paterno like \''.$paterno .'\''; 
    if (!empty($materno))
        $condition = empty($condition) ? 'materno like \''.$materno .'\'': $condition . ' AND materno like \''.$materno .'\''; 
    if (!empty($sexo))
        $condition = empty($condition) ? 'sexo like \'%'.$sexo .'%\'': $condition . ' AND sexo like \'%'.$sexo .'%\''; 
    if (!empty($fechaNacimiento))
        $condition = empty($condition) ? 'fechaNacimiento =\''.$fechaNacimiento .'\'': $condition . ' AND fechaNacimiento = \''.$fechaNacimiento .'\'';     
      $sqlSelect = 'SELECT det.id id,dete.nombre nombre, dete.paterno paterno, dete.materno materno, dete.fechaNacimiento fechaNacimiento, dete.sexo sexo, det.fechaInicio fechaInicio, det.fechaFin fechaFin, uni.nombre unidad, uni.direccion direccion, uni.latitud latitud, uni.longitud longitud, uni.fiscal fiscal, uni.telefono telefono
                  FROM detenido dete INNER JOIN detencion det ON dete.id=det.idDetenido INNER JOIN unidad uni ON  det.idUnidad=uni.id WHERE '. $condition .' AND fechaInicio <= CURRENT_TIMESTAMP AND fechaFin >= CURRENT_TIMESTAMP ' ;
      $result = $this->select($sqlSelect,$getLastId);

    //    $this->logger->debug('getDetenidoByParams: ' . $sqlSelect);    $result = $this->select($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
    }




    public function insertDetenido($nombre=null, $paterno=null, $materno=null, $sexo=null, $fechaNacimiento=null,$idUnidad=null, $ubicacion=null, $fechaInicio=null, $fechaFin=null,$idUsuario) {
      //  $ip = $_SERVER['HTTP_CLIENT_IP']?$_SERVER['HTTP_CLIENT_IP']:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);
        $condition=""; 
        $getLastId=true;
        if (empty($nombre) || empty($paterno) || empty($materno) || empty($sexo) || empty($fechaNacimiento) || empty($idUnidad) || empty($fechaInicio) || empty($fechaFin))  
            throw new Exception('Es necesario especificar TODOS los datos para crear el registro');
        $sqlSelect = 'INSERT INTO detenido(nombre,paterno,materno,sexo,fechaNacimiento) VALUES ("'. $nombre .'","'. $paterno .'","'. $materno .'","'. $sexo .'","' . $fechaNacimiento .'")' ;
        $lastIdDetenido = $this->insert($sqlSelect,$getLastId);
        $sqlSelect = 'INSERT INTO detencion(idDetenido,idUnidad,fechaInicio,fechaFin,ubicacion,idUsuario) VALUES ('. $lastIdDetenido .','. $idUnidad .',"'. $fechaInicio .'","'. $fechaFin . '","'. $ubicacion .'","'. $idUsuario .'")' ;
        $result = $this->insert($sqlSelect,$getLastId);
     //   $this->logger->debug('insertDetenido-> |Usuario:' . $_SESSION['idUsuario']. '| ip:'.$ip  . '| sql:'.$sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
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
  
   public function getUltimaActualizacion() {
        $sqlSelect = 'SELECT max(fechaInicio) ultimaActualizacion FROM detencion' ;
        $result = $this->select($sqlSelect);
        return $result;
    }
    public function updateDetenido($nombre=null, $paterno=null, $materno=null, $sexo=null, $fechaNacimiento=null,$idUnidad=null, $ubicacion=null, $fechaInicio=null, $fechaFin=null,$idDetencion=null) {
        if (empty($nombre) || empty($paterno) || empty($materno) || empty($sexo) || empty($fechaNacimiento) || empty($idUnidad) || empty($fechaInicio) || empty($fechaFin) || empty($idDetencion) )  
            throw new Exception('Es necesario especificar TODOS los datos para actualizar el registro');
    
        $sqlSelect = 'UPDATE detenido d, detencion de SET d.nombre="'.$nombre.'",d.paterno="'.$paterno.'",d.materno ="'.$materno.'",d.sexo="'.$sexo.'",d.fechaNacimiento="'. $fechaNacimiento.'", de.idUnidad="'.$idUnidad.'", de.fechaInicio ="'. $fechaInicio .'",de.fechaFin="'.$fechaFin.'", de.ubicacion="'. $ubicacion.'" where de.id='.$idDetencion. ' and de.idDetenido=d.id';
        $result=$this->update($sqlSelect);    

    //    $ip = $_SERVER['HTTP_CLIENT_IP']?$_SERVER['HTTP_CLIENT_IP']:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);

     //   $this->logger->debug('updateDetenido-> |Usuario:' . $_SESSION['idUsuario']. '| ip:'.$ip  . '| sql:'.$sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;

    /*  
      $this->logger->debug('updateDetenido: ' . $sqlSelect);


        $sqlSelect = 'UPDATE detencion SET idUnidad="'.$idUnidad.'", fechaInicio ="'. $fechaInicio .'",fechaFin="'.$fechaFin.'", ubicacion="'. $ubicacion.'" where id='.$idDetencion;
        $this->logger->debug('updateDetencion: ' . $sqlSelect);
        $this->update($sqlSelect);
    */

    }

    public function authentication($user,$password) {
       // $ip = $_SERVER['HTTP_CLIENT_IP']?$_SERVER['HTTP_CLIENT_IP']:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);
        if (empty($user) || empty($password)){
            session_destroy();
            return false;
        }
        else{
            $user = stripslashes($user);
            $password = stripslashes($password);

            //$user = mysql_real_escape_string($user);
            //$user = mysql_real_escape_string($user);
            //$password = mysql_real_escape_string($password);
            $sqlSelect='SELECT id, username, password, name, level,idUnidad FROM db_users WHERE username="'.$user.'" and password ="'.$password.'"';
         //   $this->logger->debug('auth-> |Usuario:' . $user. '|ip:'.$ip);
            $row=$this->select($sqlSelect);
            return $row;
        }
    }   


      public function updatePassword($idUsuario,$current,$password) {
       // $ip = $_SERVER['HTTP_CLIENT_IP']?$_SERVER['HTTP_CLIENT_IP']:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);

        if (empty($idUsuario) || empty($password))  
            throw new Exception('Es necesario especificar TODOS los datos para actualizar el registro');

        $sqlSelect = 'UPDATE db_users SET password="'.$password.'" where id='.$idUsuario .' and password="'.$current.'"';
        $result=$this->update($sqlSelect);
        //$this->logger->debug('updatePassword-> |Usuario:' . $idUsuario. '|ip:'.$ip);
        if(count($result) >= 1)
            return $result;
        else 
             throw new Exception('La contraseña anterior no coincide o existió un error al intentar actualizarla');
    }
}
?>
