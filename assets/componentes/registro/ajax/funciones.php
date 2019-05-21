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
        case 'compruebaDNI':
            $respuesta = compruebaDNI($_POST['datos']);
            break;
        case 'buscaMatricula':
            $respuesta = buscaMatricula($_POST['matricula']);
            break;
        case 'buscaUsername':
            $respuesta = buscaUsername($_POST['nombre']);
            break;
    }
}
echo $respuesta;


/**
 * FUNCION: cargaCentros
 * 
 * INPUTS: localidad(string)
 * 
 * OUTPUTS: salida (String)
 * 
 * DESCRIPCION: Hace una consulta a la bbdd para obtener los centro asociados a una localidad
 * 
 * NOTAS: localidad es un "string" porque lo recibimos así desde el POST.
 */
function cargaCentros($localidad) {
    //Preparamos la salida
    $salida = "";

    //Nos conectampos a la base de datos
    $con = new RegistroModel();
    $media = $con->conectar();

    //Preparamos y ejecutamos la sentencia SQL
    $stmt = $media->prepare("SELECT * FROM centro WHERE localidad = :localidad");
    $stmt->bindParam(":localidad", $localidad);
    $stmt->execute();

    //Recogemos los resultados y construimos la SQL
    $resultado = $stmt->fetch();
    while ($resultado != null) {
        $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[1] . "</option>";
       
        $resultado = $stmt->fetch();
    }

    echo $salida;
}

/**
 * FUNCION: anadeLocalidad
 * 
 * INPUTS: localidad(string)
 * 
 * OUTPUTS: salida (String)
 * 
 * DESCRIPCION: Hace una consulta a la bbdd para añadir una nueva localidad
 * 
 * NOTAS: En este caso, localidad si que es un string, porque indica el nombre de la localidad
 */
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
 * FUNCION: actualizarLocalidades
 * INPUTS: -
 * OUTPUTS: salida (string) -> Un string con el HTML preparado. 
 *                             El que lo devuelve construido se encuentra en RegistroModel.php
 * DESCRIPCION: Actualiza el desplegable de localidades desde las que salen los estudiantes
 */
function actualizarLocalidades(){

    $con = new RegistroModel();
    echo $con->localidadesUsuarios();
}

/**
 * FUNCION: comprobarDNI
 * 
 * INPUTS: dni (String)
 * 
 * OUTPUTS: boolean
 * 
 * DESCRIPCION: Compueba contra la base de datos si ya existe algún usuario con el DNI pasado
 * 
 * NOTAS:
 */
function compruebaDNI($dni){
    
    //Preparamos la salida
    $salida = "";

    //Nos conectampos a la base de datos
    $con = new RegistroModel();
    $media = $con->conectar();

    //Preparamos y ejecutamos la sentencia SQL
    $stmt = $media->prepare("SELECT * FROM persona WHERE DNI = :dni");
    $stmt->bindParam(":dni", $dni);
    $stmt->execute();
    
    $resultado = $stmt ->fetch();
    //Si el resultado es null, quiere decir que no hay usuario con esos datos, por lo que devuelve false.
        if ($resultado == null) {
            $salida = "0"; //No hay repetido
        } else {
            $salida = "1"; //Si hay repetido
        }
        
        echo $salida;
}

/**
 * FUNCION: comprobarMatricula
 * 
 * INPUTS: matricula (String)
 * 
 * OUTPUTS: boolean
 * 
 * DESCRIPCION: Compueba contra la base de datos si ya existe algún coche con la matricula indicada
 * 
 * NOTAS:
 */
function buscaMatricula($matricula){
    //Preparamos la salida
    $salida = "";

    //Nos conectampos a la base de datos
    $con = new RegistroModel();
    $media = $con->conectar();

    //Preparamos y ejecutamos la sentencia SQL
    $stmt = $media->prepare("SELECT * FROM coche WHERE matricula = :matricula");
    $stmt->bindParam(":matricula", $matricula);
    $stmt->execute();
    
    $resultado = $stmt ->fetch();
    //Si el resultado es null, quiere decir que no hay un coche con esos datos, por lo que devuelve false.
        if ($resultado == null) {
            $salida = "0"; //No hay repetido
        } else {
            $salida = "1"; //Si hay repetido
        }
        
        echo $salida;
}

function buscaUsername($nombre){
    //Preparamos la salida
    $salida = "";

    //Nos conectampos a la base de datos
    $con = new RegistroModel();
    $media = $con->conectar();

    //Preparamos y ejecutamos la sentencia SQL
    $stmt = $media->prepare("SELECT * FROM usuario WHERE user = :username");
    $stmt->bindParam(":username", $nombre);
    $stmt->execute();
    
    $resultado = $stmt ->fetch();
    //Si el resultado es null, quiere decir que no hay un coche con esos datos, por lo que devuelve false.
        if ($resultado == null) {
            $salida = "0"; //No hay repetido
        } else {
            $salida = "1"; //Si hay repetido
        }
        
        echo $salida;
}