<?php

require_once './IndexController.php';
$controller = new IndexController();

if (!isset($_SESSION['sesion'])) {

    $_SESSION['sesion'] = 1;
}

if (isset($_POST['login'])) {
    $controller->recibeDatos('login', [$_POST['usuario'], $_POST['password']]);
}

//if (isset($_POST['sesdes'])) {
//    session_destroy();
//}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido</title>
        
        <!-- jQuery -->
        <script src="../../librerias/jquery/jquery.min.js" type="text/javascript"></script>
        <!-- Booststrap -->
        <link href="../../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../librerias/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Propio -->
        <link href="../../css/paginaPrincipal/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <div id="cabecera" class="container-fluid">
                <div class="row">
                    <div id="titulo" class="col-md-12 col-sm-12">
                        <img id="logo" class="fl-left" src="../../img/logos/LOGO128.png">
                        <h1>Operación esto tiene que reventar</h1>
                        <p>Una frase con gancho irá aqui (un slogan, vaya)</p>
                    </div>
                </div>
            </div>
        </header>

        <section>

            <div class="container-fluid">
   
                <!-- DATOS -->
                <div class="col-md-9 col-sd-9">
                    <div class="cambiar1">
                        <p>
                            <h1>Ubicación del sitio</h1> 
                        </p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2896.6184154187536!2d-3.8532828842272435!3d43.44768487371321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4949bb2a323c29%3A0xcbc1863c74913b6d!2sIES+Augusto+Gonz%C3%A1lez+de+Linares!5e0!3m2!1ses!2ses!4v1555427244122!5m2!1ses!2ses" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                    </div>

                </div>

                <!-- LOGING -->
                <div class="col-md-3 col-sm-3 login">
                        <label><?php
                            if (isset($_SESSION['logged'])) {
                                if ($_SESSION['logged'] == "no") {
                                    echo "Error en las credenciales";
                                }else{
                                    echo "Tu usuario no está activo! Consulta con un administrador";
                                }
                            }
                            ?></label>
                        <form action="#" method="POST">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="usuario" type="text" class="form-control" name="usuario" placeholder="Usuario">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <br>
                            <input type="submit" class="btn btn-success fl-left" value="Iniciar sesión" name="login">
                            <a id="registro" href="../registro/registro.php" class="text-center" >¿No tienes cuenta? Regístrate</a>
                        </form> 
                    </div>

                </div>
            </div> 
                
        </section>
        <br>

        <footer class="jumbotron">                 

        </footer>
    </body>
</html>


<!--


                    






-->