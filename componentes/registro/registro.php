<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once './RegistroController.php';

session_start();
$controller = new registroController();
$proceso = '';
$argumentos = 0;

/*
 * Comprobamos en que parte del proceso del registro nos encontramos.
 * Si es la primera vez, nos coloca por defecto en la primera sección.
 */
if (!isset($_POST['section'])) {
    $proceso = 'r1';
    $argumentos = 0;
} else {
    switch ($_POST['section']) {
        case 'r1':
            $proceso = 'r1';
            break;
        case 'r2':
            $proceso = 'r2';
            break;
        case 'r3':
            $proceso = 'r3';
            break;
        case 'r4':
            $proceso = 'r4';
            break;
        case 'r5':
            $proceso = 'r5';
            break;
        case 'rfin':
            $proceso = 'rfin';
            break;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- jQuery -->
        <script src="../../librerias/jquery/jquery.min.js" type="text/javascript"></script>
        <!-- Booststrap -->
        <link href="../../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../librerias/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Propio -->
        <link href="../../css/registro/styles.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        <header>
            <div id="cabecera" class="container-fluid">
                <div class="row">
                    <div id="titulo" class="col-md-12 col-sm-12">
                        <img id="logo" class="fl-left" src="../../img/logos/LOGO64.png">
                        <h1>Operación esto tiene que reventar</h1>
                        <h3> INES, EL COLOR DE FONDO ES TEMPORAL, PARA VER LOS LIMITES!!!!!</h3>
                    </div>
                </div>
            </div>

        </header>


        <section>
            <div class="col-md-4 col-md-offset-4">
                <?php
                
                    echo $controller->recibeDatos($proceso, $argumentos)

                ?>
            </div>


        </section>


        <footer>

        </footer>



    </body>
</html>


<!--

<div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Antonio">
                            </div>
                            <div class="form-group">
                                <label for="apellidos" class="control-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ej. Sierra">
                            </div>
                            <div class="form-group">
                                <label for="dni" class="control-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" placeholder="Ej. 00000000-A">
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej. 999666222">
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento" class="control-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                            </div>
                        </div>    



                    </div>




-->