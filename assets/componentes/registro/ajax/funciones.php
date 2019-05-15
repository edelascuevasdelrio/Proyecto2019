<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../RegistroModel.php';


/**
 * Recibiremos como minimo el proceso a realizar y de manera adicional, parametros necesarios
 */
if (isset($_POST['proceso'])) {
    
    switch ($_POST['proceso']) {
        
        case 'cargaCentros':
            $respuesta = cargaCentros($_POST['localidad']);
            break;
        
        case 'anadeLocalidad':
            $respuesta = anadeLocalidad($_POST['localidad']);
            break;
        
        case 'actualizaLocalidades':
            $respuesta = actualizarLocalidades();
            
            break;
    }
}
echo $respuesta;



function cargaCentros($localidad) {

  
    $salida = "";

    $con = new RegistroModel();
    $media = $con->conectar();

    $stmt = $media->prepare("SELECT * FROM centro WHERE localidad = :localidad");
    $stmt->bindParam(":localidad", $localidad);
    $stmt->execute();

    $resultado = $stmt->fetch();
    while ($resultado != null) {
        $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[1] . "</option>";
       
        $resultado = $stmt->fetch();
    }

    echo $salida;
}

function anadeLocalidad($localidad) {
    $con = new RegistroModel();
    $media = $con->conectar();

    try {
        $stmt = $media->prepare("INSERT INTO localidad VALUES (NULL, :localidad)");
        $stmt->bindParam(":localidad", $localidad);
        $stmt->execute();
        echo ("OK");
    } catch (Exception $ex) {
        echo ("Ha ocurrido el siguiente error: " . $ex->getMessage());
    }
}

/**
 * FUNCION:
 * INPUTS: -
 * OUTPUTS: salida (string) -> Un string con el HTML preparado. 
 *                             El que lo devuelve construido se encuentra en RegistroModel.php
 * DESCRIPCION: Actualiza el desplegable de localidades desde las que salen los estudiantes
 */
function actualizarLocalidades(){
    ///////////////////////////////////////////VARAIBLES
    $salida = "";
    $con = new RegistroModel();
    $media = $con->conectar();
    
    ///////////////////////////////////////////CODIGO
    echo $con->localidadesUsuarios();
}