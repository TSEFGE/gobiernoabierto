<?php 
require 'vendor/autoload.php';
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
$dao = new FGEServicesDAO();

 $resultado=$dao->getUnidades();
if(count($resultado)>0){

    $contador=count($resultado);
    $contador2=0;
    $combobit="";
    while ($contador2 != $contador) {
        $combobit .=" <option value='".$resultado[$contador2]['id']."'>".$resultado[$contador2]['nombre']."</option>";
        $contador2++;
    }
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Gobierno Abierto - Registro Público de Personas Detenidas</title>
    <link rel="icon" href="img/icon.png" sizes="192x192">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css">
    <link rel="stylesheet" href="css/cssfonts.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/sticky-footer.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-md-2 col-xs-3 logotipo">
                    <img src="./img/logo.png" align="left" border="1" width="100" height="100"/>
                </div>
                <div class="col-md-8 col-xs-9">
                    <h3 align="center"><strong><span class="titulo1">ACCESO</span><br><span class="titulo2">AL SISTEMA</span></strong></h3>
                    <br>
                </div>
            </div>
        <img src="img/barra.png" width="100%"/>
        </header>
    </div>
<br><br>
    <div class="container-fluid">
        <div>
            <div class="col-xs-12  col-sm-2 col-md-2 col-lg-3"></div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6 login-body">
                <div class="col-xs-12  col-md-4 col-lg-4">
                    <img class="img-responsive imagenlogin" src="img/complementlogin.jpg" alt="" height="100%">
                </div>
                <div class="col-xs-12  col-md-8 col-lg-8">

                    <img class="img-responsive imagenlogin2" src="img/complementlogin2.jpg" alt="" >
                    <div class="login">
                        <h2> INICIA SESIÓN</h2>
                        <h5>¡Bienvenido!</h5>
                        <form method="post" action="authentication.php">
                            <div class="form-group">
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" maxlength="100" required>
                            </div>
                            <?php
                            $E1 ="El usuario y/o contraseña son incorrectas, vuelva a intentarlo.";
                            $E2 ="El usuario y la contraseña son correctas, pero su cuenta no esta activada.";
                            if (isset($_GET['error1'])==1) {
                                echo "<div class='errormsg'>".$E1."</div>";
                            }
                            if(isset($_GET['error2'])==2){
                                echo "<div class='errormsg'>".$E2."</div>";
                            }

                            ?>
                            <div class="login-button-row">
                                <input type="submit" name="login-submit" id="login-submit" value="INGRESAR" title="Login now"><br>

                            </div>
                            <div class="col-xs-6">
                                <a class="help-block" href="https://drive.google.com/open?id=0B3WZvqbqPu3pRzJKWEVVXzFzbEk"><i class="fa fa-book" aria-hidden="true" style="color: #919396;"></i><br>Manual de Usuario</a>
                            </div>
                            <div class="col-xs-6">
                                <a class="help-block" href="#" data-toggle="modal" data-target="#modalRecupera"><i class="fa fa-key" aria-hidden="true" style="color: #919396;"></i><br>Recuperar Contraseña</a>
                            </div>
                            <div>
                                <a class="help-block" href="#" data-toggle="modal" data-target="#modalRegistrar"><i class="fa fa-user-plus" aria-hidden="true" style="color: #919396;"></i><br>Crear cuenta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-3"></div>
        </div>
    </div>
    <br><br>


    <div id="modalRecupera" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="frmRestablecer" action="validaremail.php">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center"><strong>Recupera tu contraseña</strong></h4>
                    </div>
                    <div class="modal-body text-center">
                        <div class="form-group form-inline">
                            <label for="email">Ingresa tu correo electrónico</label>
                            <div >
                                <input type="email" class="form-control center-block" id="email" name="email" style="width: 70%" required>
                            </div>
                        </div>
                        <div id="mensaje"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="borrar();" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Recuperar contraseña"  >
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<!--modal de formulario de registro-->
    <div id="modalRegistrar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="frmRegistrar" action="procesoregistro.php">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center"><strong>Crear cuenta</strong></h4>
                    </div>

                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="Rname">Nombre completo</label><br>
                            <input type="text" class="form-control" id="Rname" name="Rname" required>
                        </div>
                        <div class="form-group">
                            <label for="Ruser">Nombre de usuario</label><br>
                            <input type="text" class="form-control" id="Ruser" name="Ruser" required>
                        </div>
                        <div class="form-group">
                            <label for="Remail">correo electrónico</label><br>
                            <input type="email" class="form-control" id="Remail" name="Remail" required>
                        </div>
                        <div class="form-group">
                            <label for="pass1">Contraseña</label><br>
                            <input type="password" class="form-control" id="Rpass1" name="Rpass1" required>
                        </div>
                        <div class="form-group">
                            <label for="pass2">Confirmar contraseña</label><br>
                            <input type="password" class="form-control" id="Rpass2" name="Rpass2" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Unidad</label>
                            <div>
                                <select  id="Runidad" name="Runidad" class="form-control" required>
                                    <option value="">Seleccionar Unidad</option>
                                    <?php echo $combobit; ?>

                                </select>
                            </div>
                        </div>
                        <div id="mensaje2"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" onclick="borrar();" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Crear cuenta">
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--fin modal de formulario de registro-->
            
    <footer class="footer">
        <div class="row footer-area-wrap">
            <div class="container text-center">
                    <img src="./img/logo-footer.png" alt="Fiscalía General del Estado" width="140">
            </div>
        </div>
        <div class="footer-container">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                        <div>Copyright © 2017 Fiscalía General del Estado de Veracruz, DCIIT</div>
                    </div>
                    <div class="col-xs-12 col-md-2 ">
                        <a href="http://facebook.com/fgeveracruz/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="http://twitter.com/FGE_Veracruz"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="https://www.youtube.com/channel/UC464yhyQ9Zc6FYkPyN69cgA"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>        
    </footer>
    
    <script>
        //procesos de registro
        $(document).ready(function(){
            $("#frmRegistrar").submit(function(event){
                event.preventDefault();
                $.ajax({
                    url:'procesoregistro.php',
                    type:'post',
                    dataType:'json',
                    data:$("#frmRegistrar").serializeArray()
                }).done(function(respuesta){
                    
                    if(respuesta.mensaje2 == 'correcto'){
                            $("#modalRegistrar").modal('hide');
                            swal(
                                    'Atención',
                                    'Un correo ha sido enviado a su cuenta de email con las instrucciones para activar su cuenta.',
                                    'success'
                                    );
                            $("#email").val("");
                            $("#Remail").val("");
                            $("#Rname").val("");
                            $("#Ruser").val("");
                            $("#Rpass1").val("");
                            $("#Rpass2").val("");
                            $("#Runidad").val("");
                    }else{
                        if(respuesta.mensaje2=='passdiferente') {
                            swal(
                                    'Atención',
                                    'Las contraseñas no coinciden.',
                                    'warning'
                                    );
                        }else{
                            if(respuesta.mensaje2=='yaexisteuser') {
                                swal(
                                    'Atención',
                                    'El usuario que ha ingresado ya existe.',
                                    'warning'
                                    );
                            }else{
                                if(respuesta.mensaje2=='yaexistecorreo') {
                                    swal(
                                    'Atención',
                                    'El correo que ha ingresado ya existe.',
                                    'warning'
                                    );
                                }
                            }
                        }
                    } 
                    
                });
            });
        });
        //fin proceso de registro





        $(document).ready(function(){
            $("#frmRestablecer").submit(function(event){
                event.preventDefault();
                $.ajax({
                    url:'validaremail.php',
                    type:'post',
                    dataType:'json',
                    data:$("#frmRestablecer").serializeArray()
                }).done(function(respuesta){
                    
                    if(respuesta.mensaje == 'correcto'){
                        $("#modalRecupera").modal('hide');
                        swal(
                            'Atención',
                            'Un correo ha sido enviado a su cuenta de email con las instrucciones para recuperar su contraseña.',
                            'success'
                            );
                    }else{
                        if(respuesta.mensaje=='noexiste') {
                            $("#modalRecupera").modal('hide');
                            swal(
                                'Atención',
                                'Un correo ha ingresado no existe.',
                                'warning'
                                );
                        }
                    } 
                    $("#email").val('');
                });
            });
        });
    
        function borrar() {
            $("#email").val("");
            $("#Remail").val("");
            $("#Rname").val("");
            $("#Ruser").val("");
            $("#Rpass1").val("");
            $("#Rpass2").val("");
            $("#Runidad").val("");
        };
    </script>
</body>
</html>



