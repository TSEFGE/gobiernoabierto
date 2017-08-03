<?php
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
generarReportesDiarios();
function generarReportesDiarios(){
    $dao = new FGEServicesDAO();
    $usuarios = $dao->getUsuariosReporte();
    if(!$usuarios) {
        throw new Exception('No existen usuarios para enviar el reporte', 418);
    }
    else{
        foreach($usuarios as $usuario){
           $dao->enviaReporte(date("d/m/Y",time() - 24 * 60 * 60), date("d/m/Y",time()), $usuario['id'], $usuario['level']);
        }
    }
}