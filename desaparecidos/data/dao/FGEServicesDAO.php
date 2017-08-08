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
    $sqlSelect = 'SELECT id,nombre, apat, amat, sexo, edad, origen, rutfoto,mun,estado,DATE_FORMAT(fextrav,\'%d-%m-%Y\') fextrav FROM desaparecidos WHERE '.$condition . ' AND tipo="INTERNO" AND public=1 AND status=1 order by apat,amat, nombre asc' ;
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
            $sqlSelect='SELECT id, username, password, name, level,idUnidad FROM db_users WHERE username="'.$user.'" ';

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
}
?>
