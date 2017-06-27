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
        $condition = empty($condition) ? 'edad like \'%'.$edad .'%\'': $condition . ' AND edad like \'%'.$edad .'%\'';     
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
    $sqlSelect = " SELECT rutfoto, nombre, apat, amat, sexo, edad, nac, origen,estado,mun, DATE_FORMAT(fextrav,'%d-%m-%Y') fextrav ,est,compl,ojos,piel,cab,tcab,nariz,labios,cejas  FROM desaparecidos WHERE id=".$id;
    //    $sqlSelect = " SELECT rutfoto, nombre, apat, amat, sexo, edad, nac, origen,estado,mun, DATE_FORMAT(fextrav,'%d-%m-%Y') fextrav ,est,compl,ojos,piel,cab,tcab,nariz,labios,cejas  FROM desaparecidos2 WHERE id=".$id;
        $this->logger->debug('getDesaparecidoById: ' . $sqlSelect);
        $result = $this->select($sqlSelect);
        if(count($result) >= 1)
            return $result;
        else 
            return NULL;
    }
}
?>
