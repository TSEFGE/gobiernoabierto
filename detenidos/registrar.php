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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="icon" href="img/icon.png" sizes="192x192">
    <title>Gobierno Abierto - Registro Público de Personas Detenidas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link href="./libjs/bootstrap-combined.min.css" rel="stylesheet">-->
    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/prettify-1.0.css" rel="stylesheet">
    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/base.css" rel="stylesheet">
    <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/examples/resources/syntax/shCore.css">
    <!--<link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/examples/resources/demo.css">-->
    
    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-messages.js"></script>

    <!--Para las tablas-->
    <link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/css/editor.DataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/autofill/2.1.2/css/autoFill.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/autofill/2.1.2/js/dataTables.autoFill.min.js"></script>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
    <link href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <link href="https://cdn.datatables.net/rowreorder/1.1.2/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/rowreorder/1.1.2/js/dataTables.rowReorder.min.js"></script>

    <link href="./Editor-PHP-1.5.6/css/editor.dataTables.min.css" rel="stylesheet">    
    <script type="text/javascript" language="javascript" src="./Editor-PHP-1.5.6/js/dataTables.editor.js"></script>
    <script type="text/javascript" language="javascript" src="./Editor-PHP-1.5.6/js/dataTables.editor.min.js"></script>
    

    <script src="./js/denidosDataTable.js"></script>
    <script src="./js/detenidos.js"></script>
    <!--Mis estilos-->
    <link rel="stylesheet" href="css/cssfonts.css">
    <!--<link rel="stylesheet" href="css/sticky-footer.css">-->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/ficha.css">
    <link rel="stylesheet" href="css/estilosRegistrar.css">
</head>

<body ng-controller="UnidadesController as todoList">
    <div class="container">
        <header>
            <div class="row">
                <div class="col-md-2 col-xs-3 logotipo">
                    <img src="./img/logo.png" align="left" border="1" width="100" height="100"/>
                </div>
                <div class="col-md-8 col-xs-9">
                    <h3 align="center"><strong><span class="titulo1">GOBIERNO</span><br><span class="titulo2">ABIERTO</span></strong></h3>
                    <br>
                </div>
            </div>
            <div class="row" align="right">
                <div class="col-xs-12">
                    <nav class="navbar">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav">
                                    <li title="Página principal" class="lineamenu">
                                        <a href="http://fiscaliaveracruz.gob.mx/"> Fiscalia</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog" aria-hidden="true"></span> Ajustes<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li title="Cambiar contraseña" style="cursor: pointer;"><a data-toggle="modal" data-target="#pwModal"><span class="fa fa-key" aria-hidden="true"></span> Cambiar contraseña</a>
                                            </li>
                                            <li title="Cerrar sesión"><a href="logout.php"><span class="fa fa-sign-out" aria-hidden="true"></span> Cerrar sesión  </a></li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </nav> 
                </div>
            </div>
        </header>
        <!--<img class="img-responsive center barra" src="./img/barra.png"/>-->
        <!--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"> </script> -->
        <!-- <script type="text/javascript" src="./libjs/bootstrap.min.js"> </script>-->
        <!--<script type="text/javascript" src="./libjs/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"> </script>-->
        <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/base.js"> </script>
        <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/prettify-1.0.min.js"> </script>

        <div id="pwModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center"><strong>Cambiar contraseña</strong></h4>
                    </div>
                    <div class="modal-body text-center">
                        <div class="form-group form-inline">
                            <label for="current_password">Contraseña Actual</label>
                            <div >
                                <input type="hidden" name="idUsuario"  id="idUsuario"  value=<?php echo $_SESSION['idUsuario'];?>>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="new_password">Nueva Contraseña</label>
                            <div >
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="confirm_password">Confirmar Nueva Contraseña</label>
                            <div >
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer">
                        <button ng-click="limpiarUpdatePassword()" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button ng-click="updatePassword()" class="btn btn-primary" id="password_modal_save">Guardar</button>
                        <div>
                            {{ messagePassword }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <form name="detenido" id="detenido" method="POST"  novalidate class="simple-form" ng-submit="todoList.submit()">
                <div class="panel"> 
                    <div class="panel-heading panel2">
                        <h3 class="panel-title text-left"><img src="./img/personales.png" style="width:25px; height:25px;"/>  Datos Detenido</h3>
                    </div> 
                    <div class="panel-body" id="searchDiv">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" id="nombre" name="nombre" ng-model="nombre" class="form-control required ng-valid ng-dirty" ng-required="required" required value="{{}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2 lineaForm">
                                    <div class="form-group">
                                        <label for="paterno">Apellido Paterno:</label>
                                        <input type="text" id="paterno" name="paterno" ng-model="paterno" class="form-control ng-valid ng-dirty" ng-required="required" required>
                                    </div>
                                </div>
                                <div class="clearfix hidden-md hidden-lg"></div>
                                <div class="col-xs-12 col-sm-6 col-md-2 lineaForm">
                                    <div class="form-group">
                                        <label for="materno">Apellido Materno:</label>
                                        <input type="text" id="materno" name="materno" ng-model="materno" class="form-control ng-valid ng-dirty" ng-required="required" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2 lineaForm">
                                    <div class="form-group">
                                        <label for="sexo">Sexo</label>
                                        <div>
                                            <select id="sexo" name="sexo" ng-model="sexo" class="form-control required ng-valid ng-dirty" required>
                                                <option>MASCULINO</option>
                                                <option>FEMENINO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 lineaForm">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <label for="fechaNacimiento">Fecha Nacimiento:</label>
                                        <div class="input-group date" id="datetimepicker0">
                                            <input type="text" class="form-control ng-valid" onclick="this.blur(); "keyup="this.blur();" id="fechaNacimiento" data-format="yyyy/mm/dd" name="fechaNacimiento" ng-model="fechaNacimiento">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar" ng-click="$scope.detenido.fechaNacimiento.setDirty(); $scope.detenido.fechaNacimiento.$valid=true; $scope.detenido.fechaNacimiento.$error.required=false;  $scope.detenido.fechaNacimiento.$error={}; "></span>
                                            </span>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker0').datetimepicker({format: 'YYYY/MM/DD',locale: 'es'});
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel">
                    <div class="panel-heading panel2">
                        <h3 class="panel-title text-left"><img src="./img/detencion.png" style="width:25px; height:25px;"/>  Datos Detención</h3>
                    </div> 
                    <div class="panel-body" id="searchDiv">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <label for="nombre">Unidad:</label>
                                        <div>
                                            <select  id="idUnidad" ng-model="idUnidad" name="idUnidad" class="form-control required ng-valid ng-dirty" required>
                                                <option ng-repeat="unidad in todoList.unidades" value="{{unidad.id}}">{{unidad.nombre}}</option>
                                                <option value="">Seleccionar Unidad</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 lineaForm">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <label for="paterno">Ubicación:</label>
                                        <input id="ubicacion" ng-model="ubicacion" type="text" class="form-control ng-valid ng-dirty" ng-required="required" required>
                                    </div>
                                </div>
                                <div class="clearfix hidden-md hidden-lg"></div>
                                <div class="col-xs-12 col-sm-6 col-md-3 lineaForm">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <label for="fechaInicio">Fec. Inicio Detención:</label>
                                        <div class="input-group date" id="datetimepicker1">
                                            <input type="text" class="form-control ng-valid" onclick="this.blur(); "keyup="this.blur();" id="fechaInicio" data-format="yyyy/mm/dd hh:mm:ss" name="fechaInicio" ng-model="fechaInicio">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar" ng-click="$scope.detenido.fechaInicio.setDirty(); $scope.detenido.fechaInicio.$valid=true; $scope.detenido.fechaInicio.$error.required=false;  $scope.detenido.fechaInicio.$error={}; "></span>
                                            </span>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker1').datetimepicker({format: 'YYYY/MM/DD HH:mm:ss',locale: 'es'});
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 lineaForm">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <label for="fechaFin">Fec. Fin Detención:</label>
                                        <div class="input-group date" id="datetimepicker2">
                                            <input type="text" class="form-control ng-valid" onclick="this.blur(); "keyup="this.blur();" id="fechaFin" data-format="yyyy/mm/dd hh:mm:ss" name="fechaFin"  ng-model="fechaFin" >
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                              $('#datetimepicker2').datetimepicker( {format: 'YYYY/MM/DD HH:mm:ss',locale: 'es'});
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <span class="i-info"></span> Todos los campos son requeridos para realizar el registro de la detención.
                </div>

                
                <div>
                    <input type="button" class="btn btn-gris" id="search" value="Agregar" ng-click="addDetenido()">
                    <input class="btn btn-gris" onclick="limpiar();" type="button" id="reset" value="Limpiar">

                    <input  type="button" class="btn btn-gris" name="actualizar" id="actualizar" value="Actualizar" style="display: none;"  ng-click="updateDetenido()">
                    <input  class="btn btn-gris" onclick="cancelarEdicion();" type="button" id="cancelar" name="cancelar" value="Cancelar" style="display: none;">

                    <input type="hidden" id="idDetencion" value="">
                </div>
            </form>

            <div id="resultsDiv"> 
                {{ message }}
            </div>
        </div>

        <div>
            <?php
                if($_SESSION['userLevel']==1){
            ?>
                <button class="btn btn-gris" id="removeBtn" ng-click="removeDetenido()">Borrar</button>
            <?php
                }
            ?>
                <button class="btn btn-gris" id="editBtn" ng-click="editDetenido()">Editar</button>
        </div>

        <div class="table-responsive">
            <table id="detenidos" class="display table-striped table-hover" cellspacing="0" width="100%">
                <thead class="cabecera">
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Sexo</th>
                        <th>Fecha Nac.</th>
                        <th>Fec. Inicio Detención</th>
                        <th>Fec. Fin Detención</th>
                        <th>Unidad</th>
                        <th>Ubicación</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
    <footer>
        <img class="img-responsive center barra" src="./img/barra.png"/>
    </footer>
</body>
</html> 