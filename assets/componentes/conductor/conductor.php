<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './conductorController.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Conductor</title>

        <!-- jQuery -->
        <script src="../../librerias/jquery/jquery.min.js" type="text/javascript"></script>
        <!-- Booststrap -->
        <link href="../../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../librerias/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Propio -->
        <link href="../../css/conductor/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/funciones.js" type="text/javascript"></script>
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
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="../pasajero/pasajero.php">Home</a>
                        </div>
                        <ul class="nav navbar-nav mr-auto">

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Conductor
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../conductor/conductor.php?sec=misanuncios">Mis anuncios</a></li>
                                    <li><a href="../conductor/conductor.php?sec=misdatos">Mis datos</a></li>
                                </ul>
                            </li>
                            <li><a href="../principal/princi.php">LogOUT</a></li>
                            <li id='addAnuncio'><a href='#' data-toggle='modal' data-target='#añadir'>Publicar anuncio simple</a></li>
                        </ul>

                    </div>
                </nav>
            </div>


        </header>
        <section>
            <div class='container' id="cuerpo">
                <?php
                $controller = new ConductorController();
                $argumentos = "";

                if (isset($_GET['sec'])) {
                    if ($_GET['sec'] == 'misanuncios') {
                        echo $controller->recibeDatos('misanuncios', $argumentos);
                    }
                    if ($_GET['sec'] == 'misdatos') {
                        echo $controller->recibeDatos('misdatos', $argumentos);
                    }
                }

                if (isset($_GET['misanuncios'])) {
                    
                }
                ?>
            </div>
        </section>


        <a href="../pasajero/pasajero.php">Volver</a>
    </body>
</html>
