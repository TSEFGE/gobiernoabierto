<?php
session_start();
if (!isset($_SESSION['is_auth']) || !$_SESSION['is_auth'] || !isset($_SESSION['idUsuario'])) { //not logged in
    //redirect to homepage
    header("Location: login.php");
    die();
}
?>

<html ng-app="detenidosApp">
<head>
   <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
 <!--   <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>-->
 <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
 
    <link rel="stylesheet" type="text/css" media="screen" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/prettify-1.0.css" rel="stylesheet">

    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/base.css" rel="stylesheet">
    <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <link href="./libjs/bootstrap-combined.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-messages.js"></script>



    <link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/css/editor.DataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/autofill/2.1.2/css/autoFill.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/autofill/2.1.2/js/dataTables.autoFill.min.js"></script>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>

    <link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/examples/resources/syntax/shCore.css">
            <link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/examples/resources/demo.css">




    <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
        <link href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
        <link href="https://cdn.datatables.net/rowreorder/1.1.2/css/rowReorder.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/rowreorder/1.1.2/js/dataTables.rowReorder.min.js"></script>

    <link href="./Editor-PHP-1.5.6/css/editor.dataTables.min.css" rel="stylesheet">    
    <script type="text/javascript" language="javascript" src="./Editor-PHP-1.5.6/js/dataTables.editor.js"></script>

    <script type="text/javascript" language="javascript" src="./Editor-PHP-1.5.6/js/dataTables.editor.min.js"></script>
        <!--
        <script type="text/javascript" language="javascript" src="./Editor-PHP-1.5.6/examples/resources/editor-demo.js"></script>
    <script type="text/javascript" language="javascript" src="./Editor-PHP-1.5.6/examples/resources/syntax/shCore.js"></script>-->
    


    <script src="./js/denidosDataTable.js"></script>
    <script src="./js/detenidos.js"></script>

    <title>Gobierno Abierto - Registro Público de Personas Detenidas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        body{
            margin-left: 30px;
            margin-right: 30px;
        }
       input {
            text-transform: uppercase;
        }
        input.ng-invalid {
             border: 1px solid red;
        }
        input.ng-invalid-required.ng-dirty {
             border: 1px solid blue;
        }
        
        body table tr td {
            padding: 5px;
            font-size: 14px;
            font-weight: bolder;
            color:  #000000;
            font-weight: bold;
            padding: 5px;
        }
        legend {
                font-size: 12px;
                font-weight: bolder;
                font-family: sans-serif;
        }
        legend img {
            width:50px;
            height:50px;
        }
        </style>
    </head>



<div id="pwdModal" class="modal" tabindex="100" role="dialog" aria-hidden="true">
<!--<div class="modal" id="pwdModal">-->
    <div class="modal-header">
        <h3>Cambiar Contraseña <span class="extra-title muted"></span></h3>
    </div>
    <div class="modal-body form-horizontal">

        <div class="control-group">
            <label for="current_password" class="control-label">Contraseña Actual</label>
            <div class="controls">
                <input type="hidden" name="idUsuario"  id="idUsuario"  value=<?php echo $_SESSION['idUsuario'];?>>
                <input type="password" id="current_password"  name="current_password">
            </div>
        </div>
        <div class="control-group">
            <label for="new_password" class="control-label">Nueva Contraseña</label>
            <div class="controls">
                <input type="password" id="new_password"  name="new_password">
            </div>
        </div>
        <div class="control-group">
            <label for="confirm_password" class="control-label">Confirmar Nueva Contraseña</label>
            <div class="controls">
                <input type="password" id="confirm_password"  name="confirm_password">
            </div>
        </div>      
    </div>
    <div class="modal-footer">

        <button ng-click="limpiarUpdatePassword()" class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <button ng-click="updatePassword()" class="btn btn-primary" id="password_modal_save">Guardar</button>
        <div> 
            {{ messagePassword }}
          </div>
    </div>

</div>

    <body ng-controller="UnidadesController as todoList">
         <header><center>
                    <img src="./img/header.jpg" /> 
        </header>
        <a href="logout.php"><img src="./img/logout.jpg" width="30" height="30" align="right" style="cursor: pointer; margin-right: 40px ;" data-toggle="tooltip" data-placement="top" title="Cerrar Sesión"/></a>
        <a data-target="#pwdModal" data-toggle="modal"><img src="./img/reset_password.png" width="30" height="30" align="right" style="cursor: pointer; margin-right: 40px ;" data-toggle="tooltip" data-placement="top" title="Cambiar Contraseña"/></a>
        <!--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"> </script> -->
        <!-- <script type="text/javascript" src="./libjs/bootstrap.min.js"> </script>-->
        <!--<script type="text/javascript" src="./libjs/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"> </script>-->
        <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/base.js"> </script>
        <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/prettify-1.0.min.js"> </script>
        <div>





<!--

<div id="pwdModal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Cambiar Contraseña</h1>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          
                          <p>If you have forgotten your password you can reset it here.</p>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control input-lg" placeholder="E-mail Address" name="email" type="email">
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block" value="Send My Password" type="submit">
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
          </div>    
      </div>
  </div>
  </div>
</div>-->

             <form name="detenido" id="detenido" method="POST"  novalidate class="simple-form" ng-submit="todoList.submit()">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border" style="font-size: 12px; font-weight: bolder; font-family: sans-serif;"><img src="./img/personales.png" style="width:30px;
                height:30px;"/> Datos Detenido</legend>
                    <table>
                        <tr>
                            <td>Nombre*</td>
                            <td>Ap. Paterno*</td>
                            <td>Ap. Materno*</td>
                            <td>Sexo*</td>
                            <td>Fecha Nacimiento*</td>
                        </tr>
                         <tr>
                            <td>
                                <input style="height: 30px;" id="nombre" ng-model="nombre" type="text" class="form-control" style="display:inline; width: 150px;" required value="{{}}">  
                                    <!-- <div role="alert" class="has-error">
                                          <span class="error" ng-show="detenido.sexo.$error.required">Requerido</span>                                </div>
                                      -->

                            </td>
                            <td>
                                <input style="height: 30px;" id="paterno" ng-model="paterno" type="text" class="form-control ng-valid ng-dirty" style="display:inline; width: 150px;" required>
                                <!-- <div role="alert" class="has-error">
                                          <span class="error" ng-show="detenido.sexo.$error.required">Requerido</span>                                </div>
                                      -->
                            </td>
                            <td>
                                <input style="height: 30px;" id="materno" ng-model="materno" type="text" class="form-control ng-valid ng-dirty" style="display:inline; width: 150px;" required>
                                <!-- <div role="alert" class="has-error">
                                          <span class="error" ng-show="detenido.sexo.$error.required">Requerido</span>                                </div>
                                      -->
                            </td>
                            <td>
                                <select id="sexo" ng-model="sexo" required><option>MASCULINO</option><option>FEMENINO</option></select>
                                 <!-- <div role="alert" class="has-error">
                                          <span class="error" ng-show="detenido.sexo.$error.required">Requerido</span>                                </div>
                                      -->
                            </td>
                            <td>
                                <!--<input style="height: 30px;" id="edad" ng-model="edad" type="text" class="form-control ng-valid ng-dirty" style="display:inline; width: 75px;" required>-->
                                  <div class="container" style="width:200px;">
                                <div class="row"  style="width:200px;">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <div class="input-group date" id="datetimepicker0">
                                                <input type="text" class="form-control ng-valid" style="height: 30px; display:inline; width: 150px;"  onclick="this.blur(); "keyup="this.blur();" id="fechaNacimiento" data-format="yyyy/mm/dd" name="fechaNacimiento" ng-model="fechaNacimiento">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar" ng-click="$scope.detenido.fechaNacimiento.setDirty(); $scope.detenido.fechaNacimiento.$valid=true; $scope.detenido.fechaNacimiento.$error.required=false;  $scope.detenido.fechaNacimiento.$error={}; "></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker0').datetimepicker({format: 'YYYY/MM/DD',locale: 'es'});
                                    });
                                </script>
                                </div>
                            </div>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border" style="font-size: 12px; font-weight: bolder; font-family: sans-serif;"><img src="./img/detencion.png" style="width:30px;
                height:30px;"/> Datos Detención</legend>
                <table>
                    <tr>
                        <td>Unidad*</td>
                        <td>Ubicación</td>
                        <td>Fec. Inicio Detención*</td>
                        <td>Fec. Fin Detención*</td>
                    </tr>
                    <tr>
                         <td>
                            <select  id="idUnidad" ng-model="idUnidad" name="idUnidad" class="form-control ng-valid ng-dirty"  style="display:inline; width: 250px;">
                                <option ng-repeat="unidad in todoList.unidades" value="{{unidad.id}}">{{unidad.nombre}}</option>
                                <option value="">Select</option>
                            </select>
                        </td>
                         <td>
                             <input style="height: 30px;" id="ubicacion" ng-model="ubicacion" type="text" class="form-control ng-valid ng-dirty" style="display:inline; width: 150px;" required>
                                <!-- <div role="alert" class="has-error">
                                          <span class="error" ng-show="detenido.sexo.$error.required">Requerido</span>                                </div>
                                      -->
                        </td>
                         <td>
                            <div class="container" style="width:200px;">
                                <div class="row"  style="width:200px;">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <div class="input-group date" id="datetimepicker1">
                                                <input type="text" class="form-control ng-valid" style="height: 30px; display:inline; width: 150px;"  onclick="this.blur(); "keyup="this.blur();" id="fechaInicio" data-format="yyyy/mm/dd hh:mm:ss" name="fechaInicio" ng-model="fechaInicio">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar" ng-click="$scope.detenido.fechaInicio.setDirty(); $scope.detenido.fechaInicio.$valid=true; $scope.detenido.fechaInicio.$error.required=false;  $scope.detenido.fechaInicio.$error={}; "></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker1').datetimepicker({format: 'YYYY/MM/DD HH:mm:ss',locale: 'es'});
                                    });
                                </script>
                                </div>
                            </div>
                        </td>
                        <td>
                        <div class="container" style="width:200px;">
                                <div class="row"  style="width:200px;">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <div class="input-group date" id="datetimepicker2">
                                                <input type="text" class="form-control ng-valid" style="height: 30px; display:inline; width: 150px;"  onclick="this.blur(); "keyup="this.blur();" id="fechaFin" data-format="yyyy/mm/dd hh:mm:ss" name="fechaFin"  ng-model="fechaFin" >
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function () {
                                          $('#datetimepicker2').datetimepicker( {format: 'YYYY/MM/DD HH:mm:ss',locale: 'es'});
                                        });
                                    </script>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                </fieldset>
                      <div class="alert alert-amarillo">
                    <span class="i-info"></span> Todos los campos son requeridos para realizar el registro de la detención <strong>.
            </div>
            <!--ng-disabled="detenido.$invalid"-->

                   <input type="button" class="btn btn-success" id="search" value="Agregar" style="text-align:center"  ng-click="addDetenido()">

                   <input class="btn btn-success" onclick="limpiar();" type="button" id="reset" value="Limpiar" style="text-align:center">


                   <input  type="button" class="btn btn-success" name="actualizar" id="actualizar" value="Actualizar" style="text-align: center; display: none;"  ng-click="updateDetenido()">
                   <input  class="btn btn-success" onclick="cancelarEdicion();" type="button" id="cancelar" name="cancelar" value="Cancelar" style="text-align: center; display: none;">

                    <input type="hidden" id="idDetencion" value="">
            </fieldset>
        </form>

          <div id="resultsDiv"> 
            {{ message }}
          </div>
      </div>

<table id="detenidos" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
    <?php
        if($_SESSION['userLevel']==1){
    ?>
        <button id="removeBtn" ng-click="removeDetenido()">Borrar</button>
    <?php
        }
    ?>
        <button id="editBtn" ng-click="editDetenido()">Editar</button>
            <th></th>
            <th>Nombre</th>
            <th>Paterno</th>
            <th>Materno</th>
            <th>Sexo</th>
            <th>Fecha Nac.</th>
            <th>Fec. Inicio Detención</th>
            <th>Fec. Fin Detención</th>
            <th>unidad</th>
            <th>ubicacion</th>
            <th></th>
        </tr>
    </thead>
</table>
    <footer>
        <img src="./img/footer.jpg" width="100%" style="vertical-align:center;"/>        
    </footer>
    </body>
</html> 