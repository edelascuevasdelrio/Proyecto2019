<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once './miespacioController.php';
$controller = new MiespacioController();
$proceso = 'inicio';
$argumentos = "";
?>
<html>
    <head>
        <meta charset="UTF-8">
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
        <link href="../../css/miespacio/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/funciones.js" type="text/javascript"></script>

        <title>Mi espacio</title>
    </head>
    <body>
        <header>
            <div id="cabecera" class="container-fluid">
                <div class="row salto">
                    <div id="titulo" class="col-md-12 col-sm-12">
                        <img id="logo" class="fl-left" src="../../img/logos/LOGO128.png">
                        <h1>Lift 2 school</h1>
                        <p>Más rápido. Más comodo. Más cercano.</p>
                    </div>
                </div>
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="../pasajero/pasajero.php">Home</a>
                        </div>
                        <ul class="nav navbar-nav mr-auto">

<?php
                            if ($controller->recibeDatos("isConductor", $argumentos) == '1') {
                                echo "<li class='dropdown'>
                            <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Conductor
                                <span class='caret'></span></a>
                            <ul class='dropdown-menu'>
                                <li><a href='../conductor/conductor.php?sec=misanuncios'>Mis anuncios</a></li>
                                <li><a href='../conductor/conductor.php?sec=misacuerdos'>Acuerdos</a></li>
                            </ul>
                        </li>
                        <li><a href='../miespacio/miespacio.php'>Mi espacio</a></li>

                            <li><a href='../principal/princi.php?logout=1'>LogOUT</a></li>
                       
                        ";
                            }
                            ?>

                            

                            

                        </ul>

                    </div>
                </nav>
            </div>


        </header>

        <section>
            <div class="container">
                <div class="row">
                    <h2 class="text-center">Mi espacio</h2>
                    <h4 class="text-center">Aquí podrás editar tus datos personales</h4>
                </div>

                <?php
                echo $controller->recibeDatos('formDatos', $argumentos);
                ?>
            </div>
        </section>

    </body>
</html>
