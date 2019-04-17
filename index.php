<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './bbdd/DBController.php';

function compruebaLogin() {
    if (isset($_POST['login'])) {

        print_r(DBController::login($_POST['usuario'], $_POST['password']));
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Nombre de la página</title>
        <!-- jQuery -->
        <script src="librerias/jquery/jquery.min.js" type="text/javascript"></script>
        <!-- Booststrap -->
        <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="librerias/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/paginaPrincipal/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <div id="header" class="jumbotron ">
                <div class="row">
                    <div style="margin-left: 10px;" class="col-md-9 col-sm-9">
                        <h1>Operación esto tiene que reventar</h1>
                        <p>Una frase con gancho irá aqui (un slogan, vaya)</p>
                    </div>
                    <br>
                    <!-- Login -->
                    <div class="col-md-2 col-sm-2">
                        <form action="#" method="POST">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="usuario" type="text" class="form-control" name="usuario" placeholder="Email">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <br>
                            <input type="submit" class="input-group" value="Iniciar sesión" name="login">
                            <a href="./componentes/registro/registro.php" class="text-center" >¿No tienes cuenta? Regístrate</a>
                        </form> 
                    </div>
                    
                    <?php
                    compruebaLogin();
                    
                    ?>
                </div>
            </div>     
        </header>

        <section>

            <div class="container-fluid">
                <!-- DATOS 1 -->
                <div class="col-md-4 col-sd-4">
                    <div class="cambiar1">
                        Lore Ipsum
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>


                    </div>

                </div>

                <!-- DATOS 2 -->
                <div class="col-md-4 col-sd-4">
                    <div class="cambiar1">
                        Lore Ipsum
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p><p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                    </div>
                </div>

                <!-- DATOS 3 -->
                <div class="col-md-4 col-sd-4">
                    <div class="cambiar1">
                        Lore Ipsum
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p><p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p><p>.</p>
                        <p>.</p>
                        <p>.</p>
                        <p>.</p>

                    </div>
                </div>

            </div>
        </section>
        <br>

        <footer class="jumbotron">

        </footer>
    </body>
</html>
