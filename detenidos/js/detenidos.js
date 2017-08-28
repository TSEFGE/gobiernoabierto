/*
  function getUltimaActualizacion () {
          var url='./index.php/getUltimaActualizacion';
          $http.get(url)
            .success(function (data, status, headers, config) {
               if(data.error_code==418){
                $scope.message="Error al obtener la ultima actualización";
              }  
              else{
                  $scope.message=data[0].ultimaActualizacion;
              }
      }*/
      
  function limpiar(){
    $("input[type=text]").val("");
    $('#sexo').val([]);
    $('#idUnidad').val("");
    $('#idUnidadUser').val("");
    $('#levelUser').val("");
    $('#estadoUser').val("");
  };
  function limpiarPassword(){
    $('#current_password').val("");
    $('#new_password').val("");
    $('#confirm_password').val("");
  };

  function cancelarEdicion(){
      limpiar();
      $('#search').show();
      $('#reset').show();
      $('#actualizar').hide();
      $('#cancelar').hide();
  };

  function limpiarResultados(){
      $("input[type=text]").val("");
      $('#sexo').val([]);
      $("#resultsDiv").css("display", "none");
      $("#messageDiv").css("display", "none");
  };

    function limpiarUser(){
        $("input[type=text]").val("");
        $('#sexo').val([]);
        $('#idUnidad').val("");
        $('#idUnidadUser').val("");
        $('#levelUser').val("");
        $('#estadoUser').val("");
        $('#usercorreo').val("");
    };
    function cancelarEdicionUser(){
        limpiarUser();
        $('#searchUser').show();
        $('#resetUser').show();
        $('#campopass').show();

        $('#actualizarUser').hide();
        $('#cancelarUser').hide();
    };


angular.module('detenidosApp', [])
.controller('UnidadesController', function($scope, $http){
    var todoList = this;
    $http.get('./index.php/getUnidades').success(function(unidades) {
        todoList.unidades = unidades;
            
    });


       $scope.addDetenido = function() {
       		var url='./index.php/addDetenido';
	        var data=new Object();
          if($('#nombre').val()=="" || $('#paterno').val()=="" ||$('#materno').val()=="" || $('#sexo').val()=="" || $('#fechaNacimiento').val()=="" || $('#idUnidad').val()=="" || $('#fechaInicio').val()=="" || $('#fechaFin').val()==""){
               //$scope.message="Debe capturar todos los datos para registrar la detención";
               //$("#resultsDiv").css("display", "block");
               swal(
                  'Atención',
                  'Debe capturar TODOS los datos para registrar la detención.',
                  'warning'
                );
               return;
          }

            data.nombre= $scope.nombre.trim().toUpperCase();
            data.paterno=$scope.paterno.trim().toUpperCase();
            data.materno=$scope.materno.trim().toUpperCase();
            data.sexo=$scope.sexo.trim().toUpperCase();
            data.fechaNacimiento=$('#fechaNacimiento').val();
            data.idUnidad=$scope.idUnidad;
            data.ubicacion=$scope.ubicacion.trim().toUpperCase();

            data.fechaInicio=$('#fechaInicio').val();
            data.fechaFin=$('#fechaFin').val();

            var dataJSON=JSON.stringify(data);
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
            }
        	};
       		$http.post(url, dataJSON, config)
            .success(function (data, status, headers, config) {
               limpiar();
               //$scope.message="El registro fue agregado exitosamente";
               //$("#resultsDiv").css("display", "block");
               swal(
                  'Hecho',
                  'El registro fue agregado exitosamente.',
                  'success'
                );
               $('#detenidos').DataTable().ajax.reload();
	           })
            .error(function (data, status, headers, config) {
               limpiar();
               //$scope.message="Hubo un error al intentar agregar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238";
               //$("#resultsDiv").css("display", "block");
               swal(
                  'Atención',
                  'Hubo un error al intentar agregar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238.',
                  'error'
                );
            });  
    	};

   $scope.removeDetenido = function() {
          var url='./index.php/removeDetenido';
         /* var data=new Object();
            $("input:checked", table.fnGetNodes()).each(function(){
                
            });*/
           
           $('#detenidos').DataTable().row('selected').remove().draw(false);

            //table.row('.selected').remove().draw( false );

            var dataJSON=JSON.stringify(data);
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
            }
          };
          
            $http.post(url, dataJSON, config)
            .success(function (data, status, headers, config) {
               limpiar();
               //$scope.message="El registro fue eliminado exitosamente";
               swal(
                  'Hecho',
                  'El registro fue eliminado exitosamente.',
                  'success'
                );
               $('#detenidos').DataTable().ajax.reload();
             })
            
            .error(function (data, status, headers, config) {
               limpiar();
               //$scope.message="Hubo un error al intentar elimniar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238";
               //$("#resultsDiv").css("display", "block");
               swal(
                  'Atención',
                  'Hubo un error al intentar elimniar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238.',
                  'error|'
                );
            });
      };
       
      $scope.editDetenido = function() {
            limpiar();
            var data=$('#detenidos').DataTable().row('.selected').data();
            $('#detenidos').DataTable().$('tr.selected').removeClass('selected');
            if(data == undefined){
                //alert('Debe seleccionar un registro antes de seleccionar el boton Editar.');
                swal(
                  'Atención',
                  'Debe seleccionar un registro antes de seleccionar el botón Editar.',
                  'warning'
                );
                $('#search').show();
                $('#reset').show();
                $('#actualizar').hide();
                $('#cancelar').hide();
                return;
                  //   $('#detenidos').DataTable().ajax.reload();
            }
            var dataJSON=JSON.stringify(data);
            $scope.fechaInicio=data.detencion.fechaInicio;
            $scope.fechaFin=data.detencion.fechaFin;
            $scope.ubicacion=data.detencion.ubicacion;
            $scope.nombre=data.detenido.nombre;
            $scope.paterno=data.detenido.paterno;
            $scope.materno=data.detenido.materno;
            $scope.fechaNacimiento=data.detenido.fechaNacimiento;
            $("#idUnidad").val(data.unidad.id);
            $("#sexo").val(data.detenido.sexo);
            $("#idDetencion").val(data.detencion.id);
            $('#search').hide();
            $('#reset').hide();
            $('#actualizar').show();
            $('#cancelar').show();
       };

      $scope.updateDetenido = function() {
          var url='./index.php/updateDetenido';
          var data=new Object();
          if($('#nombre').val()=="" || $('#paterno').val()=="" ||$('#materno').val()=="" || $('#sexo').val()=="" || $('#fechaNacimiento').val()=="" || $('#idUnidad').val()=="" || $('#fechaInicio').val()=="" || $('#fechaFin').val()==""){
               //$scope.message="Debe capturar todos los datos para registrar la detención";
               //$("#resultsDiv").css("display", "block");
               $("#modalCapturar").modal();
               return;
          }
            data.nombre= $scope.nombre.trim().toUpperCase();
            data.paterno=$scope.paterno.trim().toUpperCase();
            data.materno=$scope.materno.trim().toUpperCase();
            data.sexo=$('#sexo').val();
            data.fechaNacimiento=$('#fechaNacimiento').val();
            data.idUnidad=$("#idUnidad").val();;
            data.ubicacion=$scope.ubicacion.trim().toUpperCase();
            data.fechaInicio=$('#fechaInicio').val();
            data.fechaFin=$('#fechaFin').val();
            data.idDetencion=$('#idDetencion').val();
            var dataJSON=JSON.stringify(data);
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
            }
          };
          $http.post(url, dataJSON, config)
            .success(function (data, status, headers, config) {
                      limpiar();
                      $('#search').show();
                      $('#reset').show();
                      $('#actualizar').hide();
                      $('#cancelar').hide();
                     $('#detenidos').DataTable().ajax.reload();
             })
            .error(function (data, status, headers, config) {
                //alert('Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.')
                swal(
                  'Atención',
                  'Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.',
                  'error'
                );
            });
      };

      $scope.updatePassword = function() {
          var url='./index.php/updatePassword';
          var data=new Object();
          if($('#idUsuario').val()=="" || $('#current_password').val()=="" ||$('#new_password').val()==""  ||$('#confirm_password').val()==""){
               //$scope.messagePassword="Especificar todos los datos solicitados";
                swal(
                  'Atención',
                  'Debes especificar todos los datos solicitados.',
                  'error'
                );
               return;
          }
          if($('#new_password').val()!=$('#confirm_password').val()){
               //$scope.messagePassword="No coincide la contraseña nueva y su confirmación";
               swal(
                  'Atención',
                  'No coincide la contraseña nueva y su confirmación.',
                  'warning'
                );
               return;
          }
            data.idUsuario= $('#idUsuario').val().trim().toUpperCase();

            data.current_password=$('#current_password').val().trim().toUpperCase();

            data.new_password=$('#new_password').val().trim().toUpperCase();

            var dataJSON=JSON.stringify(data);

            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
            }
          };
          $http.post(url, dataJSON, config)
            .success(function (data, status, headers, config) {
                    if(data.error_code){
                      //$scope.messagePassword="La contraseña anterior no coincide o existió un error al intentar actualizarla"; 
                      swal(
                        'Atención',
                        'La contraseña anterior no coincide o existió un error al intentar actualizarla.',
                        'error'
                      );
                   }
                   else{
                       $('#pwModal').modal('hide');
                       //$scope.messagePassword="La contraseña ha sido actualizada";
                       swal(
                        'Hecho',
                        'La contraseña ha sido actualizada.',
                        'success'
                      );
                   }
             })
            .error(function (data, status, headers, config) {
                //$scope.messagePassword="La contraseña anterior no coincide o existió un error al intentar actualizarla";
                swal(
                  'Atención',
                  'La contraseña anterior no coincide o existió un error al intentar actualizarla.',
                  'error'
                );
            });
      };
      
      $scope.limpiarUpdatePassword = function() {
         limpiarPassword();
         $scope.messagePassword="";
      }

       $scope.getDetencion = function() {
            if($('#nombre').val()== "" || $('#paterno').val()=="" || $('#materno').val()=="" || $('#sexo').val()=="" || $('#fechaNacimiento').val()==""){
              $("#resultsDiv").css("display", "none");
              swal({
                  title: '<h1>Atención</h1>',
                  type: 'warning',
                  html: '<h4>Debe proporcionar <strong>TODOS</strong> los datos (nombre, paterno, materno, sexo, fecha nacimiento) para realizar la búsqueda.</h4>'
              });
              return;
            }  
            
            var url='./index.php/getDetencion';
            var data=new Object();
            data.nombre=$scope.nombre;
            data.paterno=$scope.paterno;
            data.materno=$scope.materno;
            data.sexo=$scope.sexo;
            data.fechaNacimiento=$('#fechaNacimiento').val();
            var dataJSON=JSON.stringify(data);
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
            }
            };
            $http.post(url, dataJSON, config)
            .success(function (data, status, headers, config) {
               if(data.error_code==418){
                $("#resultsDiv").css("display", "none");
                //$("#messageDiv").css("display", "block");
                //$scope.message="No se encontró ningún registro, favor de verificar los datos proporcionados";
              }
              if(data.error_code!=undefined){
                $("#resultsDiv").css("display", "none");
                swal({
                  title: '<h1>Atención</h1>',
                  type: 'error',
                  html: '<h4><strong>No existe registro</strong> ó alguno de los datos proporcionados por la persona detenida son distintos a los especificados.</h4>'              });
              }
              else{
                limpiarResultados();
                $("#resultsDiv").css("display", "block");

                $scope.itemnombre=data[0].nombre;
                $scope.itempaterno=data[0].paterno;
                $scope.itemmaterno=data[0].materno;
                $scope.itemunidad=data[0].unidad;
                $scope.itemfiscal=data[0].fiscal;
                $scope.itemtelefono=data[0].telefono;
                $scope.itemfechaInicio=data[0].fechaInicio;
                $scope.itemfechaFin=data[0].fechaFin;
                $scope.itemdireccion=data[0].direccion;

                var map;
                var marker ;
                map = new google.maps.Map(document.getElementById('map'));
                marker = new google.maps.Marker({
                  map: map
                });
                marker.setAnimation(google.maps.Animation.BOUNCE);
                marker.addListener('click', toggleBounce);
                
                var pos = new google.maps.LatLng(data[0].latitud,data[0].longitud);
                marker.setPosition(pos);
                marker.setTitle(data[0].unidad);
                map.setZoom(15);
                map.setCenter(marker.getPosition());
                google.maps.event.trigger(map, 'resize');
              }
            });
        };

        function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }

    /*proceso de usuarios*/

        $scope.addUser = function() {
            var url='./index.php/addUser';
            var data=new Object();
            if($('#nombreUser').val()=="" || $('#username').val()=="" || $('#passUser').val()=="" || $('#usercorreo').val()=="" || $('#idUnidadUser').val()=="" || $('#levelUser').val()=="" || $('#estadoUser').val()==""){
                       //$scope.message="Debe capturar todos los datos para registrar la detención";
                       //$("#resultsDiv").css("display", "block");
                swal(
                  'Atención',
                  'Debe capturar TODOS los datos para registrar la Usuario.',
                  'warning'
                );
                return;
            }

            data.nombreUser= $scope.nombreUser.trim().toUpperCase();
            data.username=$scope.username.trim().toUpperCase();
            data.passUser=$scope.passUser.trim().toUpperCase();
            data.usercorreo=$scope.usercorreo.trim().toUpperCase();
            data.idUnidadUser=$scope.idUnidadUser;
            data.levelUser=$scope.levelUser;
            data.estadoUser=$scope.estadoUser;

            var dataJSON=JSON.stringify(data);
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
                }
            };
            
            $http.post(url, dataJSON, config)
            .success(function (data, status, headers, config) {
                limpiarUser();
                //$scope.message="El registro fue agregado exitosamente";
                //$("#resultsDiv").css("display", "block");
                swal(
                   'Hecho',
                   'El registro fue agregado exitosamente.',
                   'success'
                );
                
                $('#usuariosactivos').DataTable().ajax.reload();
                $('#usuariosinactivos').DataTable().ajax.reload();
                $('#usuariosinvalidos').DataTable().ajax.reload();
                $('#usuariospendientes').DataTable().ajax.reload();
            })
            
            .error(function (data, status, headers, config) {
                limpiar();
                //$scope.message="Hubo un error al intentar agregar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238";
                //$("#resultsDiv").css("display", "block");
                swal(
                   'Atención',
                   'Hubo un error al intentar agregar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238.',
                   'error'
                );
            });  
        };
                 
        $scope.editUser = function() {
                    limpiarUser();
                    var data=$('#usuariosactivos').DataTable().row('.selected').data();
                    $('#usuariosactivos').DataTable().$('tr.selected').removeClass('selected');
                    if(data == undefined){
                        //alert('Debe seleccionar un registro antes de seleccionar el boton Editar.');
                        swal(
                          'Atención',
                          'Debe seleccionar un registro antes de seleccionar el botón Editar.',
                          'warning'
                        );
                        $('#searchUser').show();
                        $('#resetUser').show();
                        $('#actualizarUser').hide();
                        $('#cancelarUser').hide();
                        return;
                          //   $('#detenidos').DataTable().ajax.reload();
                    }
                    var dataJSON=JSON.stringify(data);
                    $scope.idUser=data.db_users.id;
                    $scope.nombreUser=data.db_users.name;
                    $scope.username=data.db_users.username;
                    $scope.usercorreo=data.db_users.correo;
                    $("#idUnidadUser").val(data.unidad.id);
                    $("#levelUser").val(data.db_users.level);
                    $("#estadoUser").val(data.db_users.activacion);
                    $('#searchUser').hide();
                    $('#campopass').hide();
                    $('#resetUser').hide();
                    $('#actualizarUser').show();
                    $('#cancelarUser').show();
               };

        $scope.updateUser = function() {
            var url='./index.php/updateUser';
            var data=new Object();
            if($('#idUser').val()=="" || $('#nombreUser').val()=="" || $('#username').val()=="" || $('#usercorreo').val()=="" || $('#idUnidadUser').val()=="" || $('#levelUser').val()=="" || $('#estadoUser').val()==""){    //$scope.message="Debe capturar todos los datos para registrar la detención";
                //$("#resultsDiv").css("display", "block");
                swal(
                  'Atención',
                  'Debe capturar TODOS los datos para registrar la Usuario.',
                  'warning'
                );
                return;
            }
            
            data.idUser= $scope.idUser.trim().toUpperCase();
            data.nombreUser= $scope.nombreUser.trim().toUpperCase();
            data.username=$scope.username.trim().toUpperCase();
           
            data.usercorreo=$scope.usercorreo.trim().toUpperCase();
            data.idUnidadUser=$("#idUnidadUser").val();
            data.levelUser=$('#levelUser').val();
            data.estadoUser=$('#estadoUser').val();
            var dataJSON=JSON.stringify(data);
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
                }
            };
            $http.post(url, dataJSON, config)
            .success(function (data, status, headers, config) {
                limpiarUser();
                $('#searchUser').show();
                $('#resetUser').show();
                $('#actualizarUser').hide();
                $('#campopass').show();
                $('#cancelarUser').hide();
                $('#usuariosactivos').DataTable().ajax.reload();
                $('#usuariosinactivos').DataTable().ajax.reload();
                $('#usuariosinvalidos').DataTable().ajax.reload();
                $('#usuariospendientes').DataTable().ajax.reload();
            })
            
            .error(function (data, status, headers, config) {
                    //alert('Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.')
                swal(
                  'Atención',
                  'Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.',
                  'error'
                );
            });
        };


        $scope.autorizarUser = function() {
            var url='./index.php/autorizarUser';
            var data2=new Object();
            limpiarUser();
            var data1=$('#usuariospendientes').DataTable().rows('.selected').data();
            var contador=0;
            if(data1 == undefined){
                swal(
                  'Atención',
                  'Debe seleccionar un registro antes de seleccionar el botón Editar.',
                  'warning'
                );
                return;
                  
            }
            cont = 0;
            var miJSON = '[';
            while (cont< data1.length){
                if(cont == (data1.length-1)){
                    var element = '{"idUser":"'+data1[cont].db_users.id+'"}';
                    miJSON = miJSON.concat(element);
                }else{
                    var element = '{"idUser":"'+data1[cont].db_users.id+'"},';
                    miJSON = miJSON.concat(element);
                }
                //data2['idUser'] = data1[cont].db_users.id;
                cont++;
            }
            miJSON = miJSON.concat(']');
            //var dataJSON = '[{"idUser":"756"}, {"idUser":"758"}]';
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
                }
            };
            $http.post(url, miJSON, config)
            .success(function (data, status, headers, config) {
                limpiarUser();
               
                $('#usuariosactivos').DataTable().ajax.reload();
                $('#usuariosinactivos').DataTable().ajax.reload();
                $('#usuariosinvalidos').DataTable().ajax.reload();
                $('#usuariospendientes').DataTable().ajax.reload();
            })
            
            .error(function (data, status, headers, config) {
                    //alert('Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.')
                swal(
                  'Atención',
                  'Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.',
                  'error'
                );
            });
            $('#usuariospendientes').DataTable().$('tr.selected').removeClass('selected');
       };


       $scope.rechazarUser = function() {
            var url='./index.php/rechazarUser';
            var data2=new Object();
            limpiarUser();
            var data1=$('#usuariospendientes').DataTable().rows('.selected').data();
            var contador=0;
            if(data1 == undefined){
                swal(
                  'Atención',
                  'Debe seleccionar un registro antes de seleccionar el botón Editar.',
                  'warning'
                );
                return;
                  
            }
            cont = 0;
            var miJSON = '[';
            while (cont< data1.length){
                if(cont == (data1.length-1)){
                    var element = '{"idUser":"'+data1[cont].db_users.id+'"}';
                    miJSON = miJSON.concat(element);
                }else{
                    var element = '{"idUser":"'+data1[cont].db_users.id+'"},';
                    miJSON = miJSON.concat(element);
                }
                //data2['idUser'] = data1[cont].db_users.id;
                cont++;
            }
            miJSON = miJSON.concat(']');
            //var dataJSON = '[{"idUser":"756"}, {"idUser":"758"}]';
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;'
                }
            };
            $http.post(url, miJSON, config)
            .success(function (data, status, headers, config) {
                limpiarUser();
               
                $('#usuariosactivos').DataTable().ajax.reload();
                $('#usuariosinactivos').DataTable().ajax.reload();
                $('#usuariosinvalidos').DataTable().ajax.reload();
                $('#usuariospendientes').DataTable().ajax.reload();
            })
            
            .error(function (data, status, headers, config) {
                    //alert('Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.')
                swal(
                  'Atención',
                  'Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.',
                  'error'
                );
            });
            $('#usuariospendientes').DataTable().$('tr.selected').removeClass('selected');
       };


});