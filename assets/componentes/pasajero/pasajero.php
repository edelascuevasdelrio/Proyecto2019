<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
require_once './pasajeroController.php';
$controller = new PasajeroController();
$proceso = 'inicio';
$argumentos = "";


if (isset($_SESSION['usuario'])) {
    
    $_SESSION['idUsuario'] = $controller->recibeDatos('idUsuario', $_SESSION['usuario']);
    echo "<input type='hidden' id='idUsuario' value='" . $_SESSION['idUsuario'] . "'>";
}
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
        <script src="js/funciones.js" type="text/javascript"></script>

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
                        <a class="navbar-brand" href="./pasajero.php">Home</a>
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

    <body>
        <div class="container" id="cuerpo">
            
            <h2 class="text-center">Encuentra tu viaje</h2>
            
            <?php
            echo $controller->recibeDatos($proceso, $argumentos);
            ?>
        </div>

        <div class='modal fade' id='añadir' tabindex='-1' role='dialog' aria-labelledby='Añadir localidad' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2 class='modal-title' >Añadir localidad</h2>

                    </div>
                    <div class='modal-body'>

                        <div class="form-group">
                            <label for='localidadSalida' class='form-label'>Desde... </label>
                            <select id='localidadSalida' name='localidadSalida' class='form-control'>
                                <?php
                                    echo "<option></option>";
                                    echo $controller ->recibeDatos('cargaDesde', "");
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for='localidadDestino' class='form-label'>Hasta... </label>
                            <select id='localidadDestino' name='localidadDestino' class='form-control'>
                                <?php
                                    echo "<option></option>";
                                    echo $controller ->recibeDatos('cargaHasta', "");
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for='horario' class='form-label'>Horario </label>
                            <select id='horario' name='horario' class='form-control'>
                                <option value='diurno'>Diurno</option>
                                <option value='nocturno'>Nocturno</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for='precio' class='form-label'>Periodo </label>
                            <select id='periodo' name='periodo' class='form-control'>
                                <option value='semanal'>Semanal</option>
                                <option value='mensual'>Mensual</option>
                                <option value='trimestral'>Trimestral</option>
                                <option value='cuatrimestral'>Cuatrimestral</option>
                            </select>
                        </div>
<!--                        <div class="form-group">
                            <label for='plazas' class='form-label'>Plazas </label>
                            <select id='plazas' name='plazas' class='form-control'>
                                //<?php
//                                    for ($index = 1; $index < 10; $index++) {
//                                        echo "<option value='$index'>$index</option>";
//                                    }
//                                ?>
                            </select>
                        </div>-->
<!--                        <div class="form-group">
                            <label for='precio' class='form-label'>Precio / persona </label>
                            <input type="text" id='presona' name='periodo' class='form-control'>
                                
                        </div>-->

                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        <button id='btnanadir' type='button' class='btn btn-primary'>Añadir</button>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
