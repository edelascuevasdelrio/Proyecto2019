<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../miespacioModel.php';

if (isset($_POST['proceso'])) {
    switch ($_POST['proceso']) {
        case 'buscaDatos':

            $salida = buscaDatos($_SESSION['idUsuario']);
            print_r($salida);
            break;
    }
}

function buscaDatos($idUsuario) {
    $con = new MiespacioModel();
    $model = $con->conectar();

    $datos = array();
    $htmlCentros = "";
    //datos usuario
    $stmt_usuario = $model->prepare("SELECT * FROM usuario WHERE id = :id");
    $stmt_usuario->bindParam(":id", $idUsuario);
    $stmt_usuario->execute();

    $usuario = $stmt_usuario->fetch();
    foreach ($usuario as $key => $value) {
        $datos[$key] = $value;
    }

    //datos de persona
    $stmt_persona = $model->prepare("SELECT * FROM persona WHERE id_usuario = :id");
    $stmt_persona->bindParam(":id", $idUsuario);
    $stmt_persona->execute();

    $persona = $stmt_persona->fetch();
    foreach ($persona as $key => $value) {
        $datos[$key] = $value;
    }

    //datos pasajero
    $stmt_pasajero = $model->prepare("SELECT localidad, destino FROM pasajero WHERE id_usuario = :id");
    $stmt_pasajero->bindParam(":id", $idUsuario);
    $stmt_pasajero->execute();

    $pasajero = $stmt_pasajero->fetch();
    
    //optenemos todos los centros de dicha localidad
    $stmt_centro = $model -> prepare("SELECT id, nombre as nombeCentro FROM centro WHERE localidad = :id");
    $stmt_centro ->bindParam(":id", $pasajero['destino']);
    $stmt_centro ->execute();
    $centro = $stmt_centro -> fetch();
    
    while($centro != null){
        if($centro[0] == $pasajero['destino']){
            $datos['nombreCentro'] = $centro[1];
        }
        $htmlCentros .= "<option value='".$centro[0]."'>".$centro[1]."</option>";
        $centro = $stmt_centro -> fetch();
    }  
    $datos['htmlCentro'] = $htmlCentros;
    foreach ($pasajero as $key => $value) {
        $datos[$key] = $value;
    }
    
    
    
    
    $conductor = "";
    $coche = "";

    

    //datos conductor
    if ($_SESSION['idConductor'] != "") {
        //datos conductor
        $stmt_conductor = $model->prepare("SELECT id as idConductor, tipo_permiso FROM conductor WHERE id_usuario = :id");
        $stmt_conductor->bindParam(":id", $idUsuario);
        $stmt_conductor->execute();

        $conductor = $stmt_conductor->fetch();


        //datos coche
        $stmt_coche = $model->prepare("SELECT tipo, matricula, descripción FROM coche WHERE id_propietario = :id");
        $stmt_coche->bindParam(":id", $conductor['idConductor']);
        $stmt_coche->execute();

        $coche = $stmt_coche->fetch();

        foreach ($conductor as $key => $value) {
            $datos[$key] = $value;
        }
        foreach ($coche as $key => $value) {
            $datos[$key] = $value;
        }
    }


    return json_encode($datos);
}
