<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'vendor/autoload.php';
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';

$dao = new FGEServicesDAO();
$logger = Logger::getLogger("index.php");


$app = new \Slim\Slim(array(
    'debug' => false
        ));
$app->get('/', function () {
    echo ''; 
}); 




 /**
     * Busca por un registro en el directorio telefonico.
     * @param string $nombre Nombre del detenido. 
     * @param string $paterno Apellido Paterno del detenido. 
     * @param string $materno Apellido Materno del detenido. 
     * @param string $sexo Sexo del detenido. 
     * @param string $fechaNacimiento fechaNacimiento del detenido 
     * @return array La información del detenido en caso de existir de acuerdo a los parametros establecidos.
     */
$app->post('/getDetencion', function () use ($app, $logger,$dao) {
      $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;
    try {
        if( empty($request) ||  empty($request->nombre)  ||  empty($request->paterno)  ||  empty($request->materno)  ||  empty($request->sexo)  ||  empty($request->fechaNacimiento)){            
            throw new Exception('Por favor especificar todos los campos, son necesarios para el registro ', 417);
        }
        $request = json_decode($app->request()->getBody());
        $nombre = !empty($request->nombre)?$request->nombre:NULL;
        $paterno = !empty($request->paterno)?$request->paterno:NULL;
        $materno = !empty($request->materno)?$request->materno:NULL;
        $sexo = !empty($request->sexo)?$request->sexo:NULL;
        $fechaNacimiento = !empty($request->fechaNacimiento)?$request->fechaNacimiento:NULL;
        $detenido = $dao->getDetencion($nombre,$paterno, $materno, $sexo, $fechaNacimiento);
        if (!$detenido) {
            throw new Exception('No existe registro ó alguno de los datos proporcionados por la persona detenidas son distintos a los especificados', 418);
        }
        else{
            echo json_encode($detenido, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();

        $logger->debug('getDetencion: ' . $e->getMessage());
    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});


$app->post('/addDetenido', function () use ($app, $logger,$dao) {
   
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;
    try {
        if( empty($request) ||  empty($request->nombre)  ||  empty($request->paterno)  ||  empty($request->materno)  ||  empty($request->sexo)  ||  empty($request->fechaNacimiento)   ||  empty($request->idUnidad)  ||  empty($request->fechaInicio)  ||  empty($request->fechaFin)){            
            throw new Exception('Por favor especificar todos los campos, son necesarios para el registro ', 417);
        }
        $nombre = !empty($request->nombre)?$request->nombre:NULL;
        $paterno = !empty($request->paterno)?$request->paterno:NULL;
        $materno = !empty($request->materno)?$request->materno:NULL;
        $sexo = !empty($request->sexo)?$request->sexo:NULL;
        $fechaNacimiento = !empty($request->fechaNacimiento)?$request->fechaNacimiento:NULL;
        $ubicacion = !empty($request->ubicacion)?$request->ubicacion:NULL;
        $idUnidad = !empty($request->idUnidad)?$request->idUnidad:NULL;
        $fechaInicio = !empty($request->fechaInicio)?$request->fechaInicio:NULL;
        $fechaFin = !empty($request->fechaFin)?$request->fechaFin:NULL;

        $detenido = $dao->insertDetenido($nombre,$paterno, $materno, $sexo, $fechaNacimiento , $idUnidad ,$ubicacion, $fechaInicio, $fechaFin,$_SESSION['idUsuario']);


       // $this->logger->debug('addDetenido-> | Usuario:' . $_SESSION['idUsuario']. '| ip:'.$ip  . ' datos '.$nombre.$paterno.$materno );


        if (!$detenido) {
            throw new Exception('Error al insertar el registro; si el error persiste, comunicarse al departamento de sistemas ext.3238', 418);
        }
        else{
            echo json_encode($detenido, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('addDetenido: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});

$app->post('/updateDetenido', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;
    try {
       /* if( empty($request) ||  empty($request->nombre)  ||  empty($request->paterno)  ||  empty($request->materno)  ||  empty($request->sexo)  ||  empty($request->fechaNacimiento)   ||  empty($request->idUnidad)  ||  empty($request->fechaInicio)  ||  empty($request->fechaFin)){            
            throw new Exception('Por favor especificar todos los campos, son necesarios para el registro ', 417);
        }*/

        $nombre = !empty($request->nombre)?$request->nombre:NULL;
        $paterno = !empty($request->paterno)?$request->paterno:NULL;
        $materno = !empty($request->materno)?$request->materno:NULL;
        $sexo = !empty($request->sexo)?$request->sexo:NULL;
        $fechaNacimiento = !empty($request->fechaNacimiento)?$request->fechaNacimiento:NULL;
        $ubicacion = !empty($request->ubicacion)?$request->ubicacion:NULL;
        $idUnidad = !empty($request->idUnidad)?$request->idUnidad:NULL;
        $fechaInicio = !empty($request->fechaInicio)?$request->fechaInicio:NULL;
        $fechaFin = !empty($request->fechaFin)?$request->fechaFin:NULL;
        $idDetencion = !empty($request->idDetencion)?$request->idDetencion:NULL;

        $detenido=$dao->updateDetenido($nombre,$paterno, $materno, $sexo, $fechaNacimiento , $idUnidad ,$ubicacion, $fechaInicio, $fechaFin,$idDetencion);
         if (!$detenido) {
         //   throw new Exception('Error al insertar el registro; si el error persiste, comunicarse al departamento de sistemas ext.3238', 418);
        }
        else{
            echo json_encode($detenido, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('addDetenido: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});

$app->get('/getUnidades', function () use ($app, $logger,$dao) {
    try{
       $registros = $dao->getUnidades();
        if (!$registros) {
            throw new Exception('No data found', 418);
        }
        else{
            echo json_encode($registros, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('getUnidades: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});

$app->get('/getUltimaActualizacion', function () use ($app, $logger,$dao) {
        $ultimaActualizacion=$dao->getUltimaActualizacion();
        echo json_encode($ultimaActualizacion, JSON_UNESCAPED_UNICODE);
});

$app->post('/updatePassword', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;
    try {
       /* if( empty($request) ||  empty($request->nombre)  ||  empty($request->paterno)  ||  empty($request->materno)  ||  empty($request->sexo)  ||  empty($request->fechaNacimiento)   ||  empty($request->idUnidad)  ||  empty($request->fechaInicio)  ||  empty($request->fechaFin)){            
            throw new Exception('Por favor especificar todos los campos, son necesarios para el registro ', 417);
        }*/
       $idUsuario = !empty($request->idUsuario)?$request->idUsuario:NULL;
       $current_password = !empty($request->current_password)?$request->current_password:NULL;
       $new_password = !empty($request->new_password)?$request->new_password:NULL;
       $usuario=$dao->updatePassword($idUsuario,$current_password,$new_password);
        if (!$usuario) {
            throw new Exception("error",418);
        }
        else{
            echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('updatePassword: ' . $e->getMessage());
    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});

$app->post('/getReporte', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;    
    try{
        $request = json_decode($app->request()->getBody());
        $fechaInicial = !empty($request->fechaInicial)?$request->fechaInicial:NULL;
        $fechaFinal = !empty($request->fechaFinal)?$request->fechaFinal:NULL;
       $registros = $dao->getReporte($fechaInicial, $fechaFinal, $_SESSION['idUsuario'], $_SESSION['userLevel']);
        if (!$registros) {
            throw new Exception('No existe registro', 418);
        }
        else{
            echo json_encode($registros, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('getUnidades: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});

$app->post('/detalleReporte', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;    
    try{
        $request = json_decode($app->request()->getBody());
        //$fechaInicial = !empty($request->fechaInicial)?$request->fechaInicial:NULL;
        $idUnidad = !empty($request->idUnidad)?$request->idUnidad:NULL;
       $registros = $dao->detalleReporte($idUnidad, $_SESSION['idUsuario'], $_SESSION['userLevel']);
        if (!$registros) {
            throw new Exception('No existe registro', 418);
        }
        else{
            echo json_encode($registros, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('getUnidades: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});


$app->post('/enviaReporte', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;    
    try{
        $request = json_decode($app->request()->getBody());
        $fechaInicial = !empty($request->fechaInicial)?$request->fechaInicial:NULL;
        $fechaFinal = !empty($request->fechaFinal)?$request->fechaFinal:NULL;
       $registros = $dao->getReporte($fechaInicial, $fechaFinal, $_SESSION['idUsuario'], $_SESSION['userLevel']);
        
        //Comprobación true false
        if (!$registros) {
            throw new Exception('No existe registro', 418);
        }
        else{
            echo json_encode($registros, JSON_UNESCAPED_UNICODE);
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('getUnidades: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});


$app->run();
?>
