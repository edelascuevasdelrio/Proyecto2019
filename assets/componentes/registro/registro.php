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

//Recogemos los datos de las distintas sesiones y los subimos a sesion
$controller->recogeDatos();
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
                        <h3> </h3>
                    </div>
                </div>
            </div>

        </header>


        <section>
            <div class="col-md-4 col-md-offset-4">
                <?php
                //Pedimos al controlador el formulario correspondiente
                echo $controller->recibeDatos($proceso, $argumentos)
                ?>
            </div>


        </section>


        <footer>

        </footer>


        <script src="js/funciones.js" type="text/javascript"></script>
    </body>
</html>

