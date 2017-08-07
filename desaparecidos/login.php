<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Gobierno Abierto - Registro Público de Personas Desaparecidas</title>
    <link rel="icon" href="img/icon.png" sizes="192x192">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                            if (isset($_GET['error'])) {
                                echo "<div class='errormsg'>".$E1."</div>";
                            }
                            ?>
                            <div class="login-button-row">
                                <input type="submit" name="login-submit" id="login-submit" value="INGRESAR" title="Login now"><br><br>

                            </div>
                            <div class="col-xs-6">
                                <a class="help-block" href="https://drive.google.com/open?id=0B3WZvqbqPu3pRzJKWEVVXzFzbEk"><i class="fa fa-book" aria-hidden="true" style="color: #919396;"></i><br>Manual de Usuario</a>
                            </div>
                            <div class="col-xs-6">
                                <a class="help-block" href="#" data-toggle="modal" data-target="#modalRecupera"><i class="fa fa-key" aria-hidden="true" style="color: #919396;"></i><br>Recuperar Contraseña</a>
                            </div>
                            <br><br><br><br><br>
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
                                <input type="email" class="form-control" id="email" name="email" style="width: 70%" required>
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

    <div id="modalenviado" class="modal fade" role="dialog"> 
        <div class="modal-dialog modal-lg" role="document"> 
            <div class="modal-content"> 
                <div class="modal-header alert-info"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> 
                    </button> 
                    <h4 class="modal-title" id="myModalLabel"><strong>Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña.</h4> 
                </div> 
            </div> 
        </div>
    </div>

    <div id="modaldesconocido" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document"> 
            <div class="modal-content"> 
                <div class="modal-header alert-warning"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> 
                    </button> 
                    <h4 class="modal-title" id="myModalLabel">No existe una cuenta asociada a ese correo.</h4> 
                </div> 
            </div> 
        </div> 
    </div>
    
            
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
                        $("#modalenviado").modal();
                    }else{
                        if(respuesta.mensaje=='noexiste') {
                            $("#modalRecupera").modal('hide');
                            $("#modaldesconocido").modal();
                        }
                    } 
                    $("#email").val('');
                });
            });
        });
    
        function borrar() {
            $("#email").val("");
        };
    </script>
</body>
</html>



