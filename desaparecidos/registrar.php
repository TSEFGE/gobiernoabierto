<?php
session_start();
if (!isset($_SESSION['is_auth']) || !$_SESSION['is_auth'] || !isset($_SESSION['idUsuario'])) { //not logged in
    //redirect to homepage
    header("Location: login.php");
    die();
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=5;">
    <title>Gobierno Abierto - Registro Público de Personas Detenidas</title>
    <link rel="icon" href="img/icon.png" sizes="192x192">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    
    <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/base.css" rel="stylesheet">
    <link href="https://eonasdan.github.io/bootstrap-datetimepicker/css/prettify-1.0.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/examples/resources/syntax/shCore.css">
    <link href="./libjs/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./Editor-PHP-1.5.6/examples/resources/demo.css">-->
    
    <!--No funciona con una versión más reciente de jQuery debido al dataTable-->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/base.js"> </script>
    <script type="text/javascript" src="https://eonasdan.github.io/bootstrap-datetimepicker/js/prettify-1.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-messages.js"></script>

    <!--Para las tablas(Al parecer no son necesarios)-->
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
    
    <!--Mis estilos-->
    <link rel="stylesheet" href="css/cssfonts.css">
    <!--<link rel="stylesheet" href="css/sticky-footer.css">-->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/ficha.css">
    <link rel="stylesheet" href="css/estilosRegistrar.css">
    <link rel="stylesheet" href="css/ficha-detalles.css">
    <link rel="stylesheet" href="css/separador.css">
    <link rel="stylesheet" href="css/fichadesaparecido.css">
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!--.......................-->
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/main.js"></script>
    <style>
        @media screen and (max-width: 800px) {
            .barranav nav {
            width: 50%;
            height: 100%;
            position: fixed;
            right:100%;
            margin: 0;
            overflow: scroll;
            margin-top: -103px;
            border-radius: 0;
            }
        }

    </style>
    

</head>

<body>
        <header>
    <div class="container conta">
            <div class="row">
                <div class="col-md-2 col-xs-3 logotipo">
                    <img src="./img/logo.png" align="left" border="1" width="100" height="100"/>
                </div>
                <div class="col-md-8 col-xs-9">
                    <h3 align="center"><strong><span class="titulo1">GOBIERNO</span><br><span class="titulo2">ABIERTO</span></strong></h3>
                    <br>
                </div>
            </div>
    </div>
    <div class="container">
        
            <div class="barranav" >
                <div class="menu_bar">
                    <a href="#" class="bt-menu"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                </div>

                <nav class="text-center">
                    <ul>
                        <li title="Página principal" class="lineamenu">
                            <a href="http://fiscaliaveracruz.gob.mx/" onclick="borrar();"> Fiscalía</a>
                        </li><!--
                        --><li class="lineamenu conta">
                            <a data-toggle="pill" href="#reporte" onclick="borrar();"><span class="fa fa-file-text" aria-hidden="true"></span> Generar Reporte</a>
                        </li><!--
                        --><li class="submenu" id="submenudetenidos">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog" aria-hidden="true"></span> Ajustes<span class="caret"></span></a>
                            <ul class="children" id="detenidos">
                                <li title="Cambiar contraseña" class="conta" style="cursor: pointer;">
                                    <a data-toggle="modal" data-target="#pwModal"><span class="fa fa-key" aria-hidden="true"></span> Cambiar contraseña</a>
                                </li>
                                <li title="Cerrar sesión">
                                    <a href="logout.php"><span class="fa fa-sign-out" aria-hidden="true"></span> Cerrar sesión</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
    </div>
        </header>
    <div class="container conta">
        <div id="pwModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></button>
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
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-content">
            <div id="reporte" class="tab-pane fade in active">
                <div>
                    <form name="reporte" id="reporte" method="POST" novalidate class="simple-form" ng-submit="todoList.submit()">
                        <div class="panel"> 
                            <div class="panel-heading panel2">
                                <h3 class="panel-title text-left"><span class="fa fa-file-text" aria-hidden="true"></span>  Generar Reporte</h3>
                            </div> 
                            <div class="panel-body" id="searchDiv2">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-group espacioForm">
                                                <label for="fechaInicial">De:</label>
                                                <div class="input-group date" id="datetimepicker3">
                                                    <input type="text" class="form-control ng-valid" onclick="this.blur(); "keyup="this.blur();" id="fechaInicial" data-format="yyyy-mm-dd" name="fechaInicial" ng-model="fechaInicial">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 lineaForm">
                                            <div class="form-group espacioForm">
                                                <label for="fechaFinal">A:</label>
                                                <div class="input-group date" id="datetimepicker4">
                                                    <input type="text" class="form-control ng-valid" onclick="this.blur(); "keyup="this.blur();" id="fechaFinal" data-format="yyyy-mm-dd" name="fechaFinal" ng-model="fechaFinal">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row espacioForm">
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <div class="form-group espacioForm">
                                                    <button type="button" class="btn btn-gris" id="searchRep" name="searchRep" value="Buscar">Buscar</button>
                                                    <input class="btn btn-gris" onclick="borrar();" type="button" id="reset" value="Limpiar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <button type="submit" class="btn btn-gris" id="enviaReporte" name="enviaReporte" value="Buscar">Enviar Reporte por Correo</button></br></br>
                <div class="panel" style="padding: 0px;">
                    <div class="panel-heading panel2 text-center"><h5 class="rango"></h5></div>
                </div>
                <div class="table-responsive">
                    <table id="reportes" class="display table-striped table-hover table-bordered" cellspacing="0" width="99%">
                        <thead class="cabecera">
                            <tr>
                                <th style="padding: 10px;">id</th>
                                <th style="padding: 10px;">idDesaparecido</th>
                                <th style="padding: 10px;">Nombre Desaparecido</th>
                                <th style="padding: 10px;">Aviso</th>
                                <th style="padding: 10px;">Fecha Envío</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div id="modalDetalleRep" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body text-center cuerpo-modal">
                        <div class="table-responsive">
                            <table class="display table-striped table-hover table-bordered" cellspacing="0" width="99%">
                                <thead class="cabecera">
                                    <tr>
                                        <th style="text-align: right;"></th>
                                        <th style="padding: 10px;">Nombre</th>
                                        <th style="padding: 10px;">Paterno</th>
                                        <th style="padding: 10px;">Materno</th>
                                        <th style="padding: 10px;">Fecha nacimiento</th>
                                        <th style="padding: 10px;">Fec. Inicio Detención</th>
                                        <th style="padding: 10px;">Fec. Fin Detención</th>
                                    </tr>
                                </thead>
                                <tbody id="detalleReporte"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de mostrar los resultadosmodal -->
        <div class="col-xs-12 ">
          <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog">
              <div class="modal-content ficha-detalles" id="detailsDiv"></div>
            </div>
          </div>
        </div>

    </div>
    <footer>
        <img class="img-responsive center barra" src="./img/barra.png"/>
    </footer>
    
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker0').datetimepicker({format: 'YYYY/MM/DD',locale: 'es'});
        });

        $(function () {
            $('#datetimepicker1').datetimepicker({format: 'YYYY/MM/DD HH:mm:ss',locale: 'es'});
        });
        $(function () {
            $('#datetimepicker2').datetimepicker({format: 'YYYY/MM/DD HH:mm:ss',locale: 'es'});
        });

        $(function () {
            $('#datetimepicker3').datetimepicker({format: 'YYYY-MM-DD',locale: 'es'});
            $('#datetimepicker4').datetimepicker({format: 'YYYY-MM-DD',locale: 'es'});
            $("#datetimepicker3").on("dp.change", function (e) {
                $('#datetimepicker4').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker4").on("dp.change", function (e) {
                $('#datetimepicker3').data("DateTimePicker").maxDate(e.date);
            });
        });

        function borrar(){
            $('#datetimepicker3').data("DateTimePicker").clear();
            $('#datetimepicker4').data("DateTimePicker").clear();
            var tablaR = $('#reportes').DataTable();
            tablaR.clear().draw();
            $( "#enviaReporte" ).prop( "disabled", true);
        };
                                            
        $(document).ready(function () {
            var tablaR = $('#reportes').DataTable({
                "order": [[ 2, "desc" ]],
                "pagingType": "full_numbers",
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                "columns": [
                    { "data": "id"},
                    { "data": "idDesaparecido"},
                    { "data": "nombre"},
                    { "data": "aviso"},
                    { "data": "fechaEnvio"}
                ],
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [ 1 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('#reportes tbody').on('click', 'tr', function () {
                var data = tablaR.row( this ).data();
                var idDesaparecido = data['idDesaparecido'];
                //alert( 'Has dado clic en la fila de ' +idUnidad);           
                  $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: './index.php/consultaById',
                    dataType: "json",                  
                    data: JSON.stringify({
                      id: idDesaparecido,
                    }),
                    success: function (data) {
                      $('#detailsDiv').empty();
                      $.each(data, function(key, item) {
                        if (key=="error_code"){
                          htmlElement = $('<h4>No existen resultados para la busqueda realizada</h4>');
                          $('#detailsDiv').append(htmlElement);
                          return false;
                        }
                        var partefoto="";
                        if(item.rutfoto!=null){
                          partefoto=item.rutfoto.split("\\").pop();
                        }
                        var foto=item.rutfoto == null || item.rutfoto === "" ?'./img/desapsf.jpg':'./img/fotos/'+partefoto;
                        if(foto=='./img/desapsf.jpg'){
                          foto='./img/noexiste.jpg';//Para generar error automáticamente
                        }
                        var sexo=item.sexo=='M'?'Masculino':'Femenino';
                        var origen=item.origen==null?'S/D':item.origen;
                        if (item.apat==null) {
                            item.apat='';
                          }
                          if (item.amat==null) {
                            item.amat='';
                          }
                          if (item.fextrav=='00-00-0000') {
                            item.fextrav=' Sin Dato';
                          }
                        htmlElement = $('<div class="modal-header" style="border:none; "> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"> </span> </button> </div> <div class="modal-body "><div class="row"> <div class="col-xs-12 col-sm-4" style="text-align: center;""> <span><img style="border: 4px solid #919396;" class="image_mini " src="'+foto+'" onerror="epic(this);" width="150" height="195"/></span> </div> <br><br> <div class="data_mini col-xs-12 col-sm-8"> <p class="fuente-ficha">'+item.nombre+' '+ item.apat +' '+ item.amat +'</p> <hr class="separador2"> <br>'+item.edad+' años<br> <hr class="separador2"> '+sexo+'<br> <hr class="separador2"> <span>Extraviado:'+item.fextrav+'</span> <br><hr class="separador2"><br> <br> </div> <div> <p class="fuente-ficha" style="padding-left:15px;">DESCRIPCI&Oacute;N</p> </div> <div class="col-xs-6">Estatura: '+item.est +'<br>Complexi&oacute;n: '+item.compl +'<br>Ojos: '+item.ojos +'<br>Piel: '+item.piel +'<br>Cabello: '+item.cab +'<br> </div> <div class="col-xs-6"> Tipo de Cabello: '+item.tcab +'<br> Nariz: '+ item.nariz +'<br> Labios: '+item.labios +'<br> Cejas: '+item.cejas +'</div> </div> </div> <div class="numeros-contacto"> <span> <h4 align="center" class="fuente-ficha" style="color:#fff;"> <b>SI LO HA VISTO O LO RECONOCE</b> </h4>COMUNIQUESE A:<br><span class="glyphicon glyphicon-phone-alt"></span> 2288416170 Ext. 3000 <br><span class="glyphicon glyphicon-earphone"> </span> 2288120841 <br><i class="fa fa-whatsapp" aria-hidden="true" style="color:#fff;margin: 0px;"></i> 2281704493</span><br><span class="glyphicon glyphicon-envelope"></span> localizarlosfiscalia_ver@veracruz.gob.mx<br>'+
                          ' SU INFORMACIÓN SER&Aacute; AN&Oacute;NIMA Y CONFIDENCIAL.</div><div class="agradecimiento" ></div> ');
                        $('#detailsDiv').append(htmlElement);
                        $('#success').modal('show');
                      });
                      $('#detailsDiv').css("visibility", "visible");
                      $('#warningDiv').css("visibility", "visible");
                      var scrollPos = $('#detailsDiv');
                      $(window).scrollTop(scrollPos);
                    }
                  });
            });

            $( "#enviaReporte" ).prop( "disabled", true);
            var totalwidth = 190 * $('.cabecera').length;
            $('.cabecera').css('width', totalwidth);
        });

        $( "#searchRep" ).click( function () {
            var cadena1 = "Reporte generado de ";
            var fecha1 = ($("#fechaInicial").val() == "") ? '2017-01-01' :  $("#fechaInicial").val();
            var cadena2 = " a ";
            var f = new Date();
            var fecha = f.getFullYear() + "-" + (f.getMonth() +1) + "-"  + f.getDate();
            var fecha2 = ($("#fechaFinal").val() == "") ? fecha :  $("#fechaFinal").val();
            var cadena = cadena1.concat(fecha1, cadena2, fecha2);
            $(".rango").html(cadena);
            $.ajax({
                type: 'POST',
                contentType: 'application/json',
                url: 'index.php/Reporte',
                dataType: "json",
                data: JSON.stringify({
                    fechaInicial: $("#fechaInicial").val(),
                    fechaFinal: $("#fechaFinal").val()
                }),
                success: function (data) {
                    var tablaR = $('#reportes').DataTable();
                    tablaR.clear().draw();
                    $.each(data, function(key, item) {
                        if (key=="error_code"){
                            $( "#enviaReporte" ).prop( "disabled", true);
                            swal(
                                'Atención',
                                'No se encontraron registros para generar el reporte.',
                                'warning'
                            );
                            return false;
                        }else{
                            $( "#enviaReporte" ).prop( "disabled", false);
                        }
                    });
                    //var json_str =  JSON.stringify(data);//Convierte el json a string
                    //alert(json_str);
                    tablaR.rows.add( data ).draw();
                }
        });

        $( "#enviaReporte" ).click( function () {
            $.ajax({
                type: 'POST',
                contentType: 'application/json',
                url: 'index.php/enviaReporte',
                dataType: "json",
                data: JSON.stringify({
                    fechaInicial: $("#fechaInicial").val(),
                    fechaFinal: $("#fechaFinal").val()
                }),
                success: function (data) {
                    $.each(data, function(key, item) {
                        if (key=="error_code"){
                            swal(
                                'Atención',
                                'Ha ocurrido un error al mandar el reporte.',
                                'error'
                            );
                            return false;
                        }else{
                            var json_str =  JSON.stringify(data);//Convierte el json a string
                            if(json_str == '{"estado":"enviado"}'){
                                swal(
                                    'Hecho',
                                    'Se ha enviado correctamente el reporte.',
                                    'success'
                                );
                                return true;
                            }else{
                                swal(
                                    'Atención',
                                    'No se ha podido mandar el reporte.',
                                    'error'
                                );
                                return false;
                            }
                        }
                    });
                }
            });
        });
    });
    </script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
</body>
</html> 