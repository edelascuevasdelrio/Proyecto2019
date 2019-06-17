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
        <!-- Fuentes -->
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">
        <!-- Propio -->
        <link href="../../css/conductor/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/funciones.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <div id="cabecera" class="container-fluid">
                <div class="row salto">
                    <div id="titulo" class="col-md-12 col-sm-12">
                       <a href="../pasajero/pasajero.php"><img id="logo" class="fl-left" src="../../img/logos/LOGO128.png"></a>
                        <h1>Lift 2 school</h1>
                        <p>Más rápido. Más comodo. Más cercano.</p>
                    </div>
                </div>
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="../pasajero/pasajero.php">Home</a>
                        </div>
                        <ul id="menuSuperior" class="nav navbar-nav mr-auto">

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Conductor
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="conductor.php?sec=misanuncios">Mis anuncios</a></li>
                                    <li><a href="conductor.php?sec=misacuerdos">Acuerdos</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="../miespacio/miespacio.php">Mi espacio</a></li>
                            <li><a href="../principal/princi.php">LogOUT</a></li>
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
                        echo '<h2 class="text-center">Mis viajes publicados</h2>
                        <h4 class="text-center">Aquí podrás editar los viajes que hayas publicado anteriormente</h4>';
                        echo $controller->recibeDatos('misanuncios', $argumentos);
                    }
                    if ($_GET['sec'] == 'misacuerdos') {
                        echo '<h2 class="text-center">Acuerdos</h2>
                        <h4 class="text-center">Aquí podrás ver quienes se han apuntado a tus anuncios</h4>';
                        echo $controller->recibeDatos('misacuerdos', $argumentos);
                        //$alert = $controller->recibeDatos('misacuerdos', $argumentos);
                        //echo "<script>alert('$alert');</script>";
                    }
                }
                ?>
            </div>
        </section>




    </body>
</html>
