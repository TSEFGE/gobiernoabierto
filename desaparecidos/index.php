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
 * Consult.
 * Input:       Toma los parametros POST de la consulta a realizar titular, oficina, cargo.
 * Output:      Regresa la lista de registros coincidentes con los parametros de busqueda. 
 * Test Cases:
 *  Success:            HTTP 200 OK
 *  Failure:            HTTP 500 Error
 *  Errors:             HTTP 400 Exception
 *      Exceptions:
 *          Missin Data Fields       HTTP 417 Exception
 * 
 * @todo finish the functions on this page
 */
$app->post('/consulta', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    try {
        if($app->request()->getBody() === ''){
            throw new Exception('Missing Data Fields', 417);
        }
        $request = json_decode($app->request()->getBody());
        $nombre = !empty($request->nombre)?$request->nombre:NULL;
        $paterno = !empty($request->paterno)?$request->paterno:NULL;
        $materno = !empty($request->materno)?$request->materno:NULL;
        $sexo = !empty($request->sexo)?$request->sexo:NULL;
        $edad = !empty($request->edad)?$request->edad:NULL;
        $registros = $dao->getDesaparecidosByParams($nombre,$paterno, $materno,$sexo, $edad);
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
    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});



/**
 * Consult.
 * Input:       Toma los parametros POST de la consulta a realizar titular, oficina, cargo.
 * Output:      Regresa la lista de registros coincidentes con los parametros de busqueda. 
 * Test Cases:
 *  Success:            HTTP 200 OK
 *  Failure:            HTTP 500 Error
 *  Errors:             HTTP 400 Exception
 *      Exceptions:
 *          Missin Data Fields       HTTP 417 Exception
 * 
 * @todo finish the functions on this page
 */
$app->post('/consultaById', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    try {
        if($app->request()->getBody() === ''){
            throw new Exception('Missing Data Fields', 417);
        }
        $request = json_decode($app->request()->getBody());
        $id = !empty($request->id)?$request->id:NULL;
        $registros = $dao->getDesaparecidoById($id);
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
    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});


$app->post('/insertInforme', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    try {
        if($app->request()->getBody() === ''){
            throw new Exception('Missing Data Fields', 417);
        }
        $request = json_decode($app->request()->getBody());
        $id = !empty($request->id)?$request->id:NULL;
        $informe = !empty($request->informe)?$request->informe:NULL;
        $registros = $dao->insertInforme($id, $informe);
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
    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});

$app->post('/Reporte', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;   

    try{
        $request = json_decode($app->request()->getBody());
        $fechaInicial = !empty($request->fechaInicial)?$request->fechaInicial:NULL;
        $fechaFinal = !empty($request->fechaFinal)?$request->fechaFinal:NULL;
        $registros = $dao->Reporte($fechaInicial, $fechaFinal, $_SESSION['idUsuario'], $_SESSION['userLevel']);
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
        $logger->debug('Reporte: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
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

$app->post('/enviaReporte', function () use ($app, $logger,$dao) {
    $app->response()->header('Content-Type', 'application/json; charset=utf-8');
    $response = array();
    $request =$app->request()->getBody()!=='' ? json_decode($app->request()->getBody()): null;    
    try{
        $request = json_decode($app->request()->getBody());
        $fechaInicial = !empty($request->fechaInicial)?$request->fechaInicial:NULL;
        $fechaFinal = !empty($request->fechaFinal)?$request->fechaFinal:NULL;
        $registros = $dao->enviaReporte($fechaInicial, $fechaFinal, $_SESSION['idUsuario'], $_SESSION['userLevel']);
        echo $registros;
        if (!$registros) {
            throw new Exception('No existe registro', 418);
        }
        else{
            return;
        }
    } catch (Exception $e) {
        $response['error_code'] = $e->getCode();
        $response['error_message'] = $e->getMessage();
        $logger->debug('enviaReporte: ' . $e->getMessage());

    }
      echo json_encode($response, JSON_UNESCAPED_UNICODE);
});


$app->run();
?>
