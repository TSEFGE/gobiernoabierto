<?php

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

$app->run();
?>
