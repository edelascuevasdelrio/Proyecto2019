<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once './pasajeroController.php';
$controller = new PasajeroController();
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
        <!-- Propio -->
        <link href="../../css/pasajero/styles.css" rel="stylesheet" type="text/css"/>


        <title>Pasajero - Encuentra tu viaje</title>
    </head>
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
                        <a class="navbar-brand" href="#">WebSiteName</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../principal/princi.php">LogOUT</a></li>
                                <li><a href="#">Page 1-2</a></li>
                                <li><a href="#">Page 1-3</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </div>
            </nav>
        </div>


    </header>

    <body>

<?php
    echo $controller->recibeDatos($proceso, $argumentos);

?>
    </body>
</html>
