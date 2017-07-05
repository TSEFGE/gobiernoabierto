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
    $('#unidad').val([]);
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
               $scope.message="Debe capturar todos los datos para registrar la detención";
               $("#resultsDiv").css("display", "block");
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
               $scope.message="El registro fue agregado exitosamente";
               $("#resultsDiv").css("display", "block");
               $('#detenidos').DataTable().ajax.reload();
	           })
            .error(function (data, status, headers, config) {
               limpiar();
               $scope.message="Hubo un error al intentar agregar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238";
               $("#resultsDiv").css("display", "block");
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
               $scope.message2="El registro fue eliminado exitosamente";
               $('#detenidos').DataTable().ajax.reload();
             })
            
            .error(function (data, status, headers, config) {
               limpiar();
               $scope.message="Hubo un error al intentar agregar el registro favor de reintentar,  en caso de que el error persista comunicarse al 228-841-61-70 ext. 3238";
               $("#resultsDiv").css("display", "block");
            });
      };
       
      $scope.editDetenido = function() {
            limpiar();
            var data=$('#detenidos').DataTable().row('.selected').data();
            $('#detenidos').DataTable().$('tr.selected').removeClass('selected');
            if(data == undefined){
                alert('Debe seleccionar un registro antes de seleccionar el boton Editar');
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
               $scope.message="Debe capturar todos los datos para registrar la detención";
               $("#resultsDiv").css("display", "block");
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
                alert('Hubo un error al actualizar el registro, por favor intentar nuevamente o comunicar al administrador.')
            });
      };

      $scope.updatePassword = function() {
          var url='./index.php/updatePassword';
          var data=new Object();
          if($('#idUsuario').val()=="" || $('#current_password').val()=="" ||$('#new_password').val()==""  ||$('#confirm_password').val()==""){
               $scope.messagePassword="Especificar todos los datos solicitados";
               return;
          }
        if($('#new_password').val()!=$('#confirm_password').val()){
               $scope.messagePassword="No coincide la contraseña nueva y su confirmación";
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
                      $scope.messagePassword="La contraseña anterior no coincide o existió un error al intentar actualizarla";        
                   }
                   else{
                       $scope.messagePassword="La contraseña ha sido actualizada"; 
                   }
             })
            .error(function (data, status, headers, config) {
                $scope.messagePassword="La contraseña anterior no coincide o existió un error al intentar actualizarla";
            });
      };
      
      $scope.limpiarUpdatePassword = function() {
        limpiarPassword();
        $scope.messagePassword="";
      }

      

       $scope.getDetencion = function() {
            if($('#nombre').val()== "" || $('#paterno').val()=="" || $('#materno').val()=="" || $('#sexo').val()=="" || $('#fechaNacimiento').val()==""){
              $("#resultsDiv").css("display", "none");
              $("#faltanDatos").modal();
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
                $("#noHayRegistro").modal();
              }
              else{
                limpiarResultados();
                $("#resultsDiv").show();
                 var pos = new google.maps.LatLng(data[0].latitud,data[0].longitud);
                 marker.setPosition(pos);
                 map.setCenter(marker.getPosition());
                 map.setZoom(15);
                 
                 map.setCenter(marker.getPosition());
                 google.maps.event.trigger(map, 'resize');

                 $scope.itemnombre=data[0].nombre;
                 $scope.itempaterno=data[0].paterno;
                 $scope.itemmaterno=data[0].materno;
                 $scope.itemunidad=data[0].unidad;
                 $scope.itemfiscal=data[0].fiscal;
                 $scope.itemtelefono=data[0].telefono;
                 $scope.itemfechaInicio=data[0].fechaInicio;
                 $scope.itemfechaFin=data[0].fechaFin;
                 $scope.itemdireccion=data[0].direccion;
              }
            });
        };
    });