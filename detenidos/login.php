<!DOCTYPE html>
<html>
<head>
    <title>Gobierno Abierto - Registro Público de Personas Detenidas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>

    <link rel="stylesheet" href="css/cssfonts.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">

    
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
        </header>
    </div>

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
                            <h2> INICIA SESI&Oacute;N</h2>

                            <h5>¡Bienvenido!</h5>
                            <!--<form method="post" action="login2.php">-->
                            
                            <form method="post" action="authentication.php">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" maxlength="100">
                                </div>
                                <?php
                                $E1 ="El usuario y/o clave son incorrectas, vuelva a intentarlo";
                                if (isset($_GET['error'])) {
                                    echo "<div class='errormsg'>".$E1."</div>";
                                }
                                ?>
                                <div class="login-button-row">
                                    <input type="submit" name="login-submit" id="login-submit" value="INGRESAR" title="Login now"><br><br>

                                </div>
                                <div class="col-xs-6">
                                    <a class="manual" href="https://drive.google.com/open?id=0B3WZvqbqPu3pRzJKWEVVXzFzbEk"><i class="fa fa-book" aria-hidden="true"></i><br>Manual de Usuario</a>
                                </div>
                                <div class="col-xs-6">
                                    <a class="manual" href="https://drive.google.com/open?id=0B3WZvqbqPu3pRzJKWEVVXzFzbEk"><i class="fa fa-key" aria-hidden="true"></i><br>Recuperar Contraseña</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-3"></div>
            </div>
        </div>
        <br><br><br><br><br>



</body>
<footer>
    <img src="img/footerlogin.jpg" width="100%"/>        
</footer>
</html>



