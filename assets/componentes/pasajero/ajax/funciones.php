<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../pasajeroModel.php';
session_start();


if (isset($_POST['proceso'])) {
    switch ($_POST['proceso']) {
        case 'addAnuncio':
            $salida = addAnuncio();
            echo $salida;
            break;
        case 'cargaDetalle':
            $html = cargaDetalle($_POST['idAnuncio']);
            echo $html;
            break;
        case 'reservaPlaza':
            $salida = reservaPlaza($_POST['idAnuncio']);
            echo $salida;
            break;
    }
}

/**
 * FUNCION: addAnuncio
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Realiza la insercion del nuevo anuncio en la BBDD
 * 
 * NOTAS: SOLO incluye los datos básicos, los insert completos, estan en el componente de Conductor
 */
function addAnuncio() {
    //conectamos con la base de datos
    $con = new PasajeroModel();
    $model = $con->conectar();

    //preparamos la sentencia de 
    $stmt = $model->prepare("INSERT INTO anuncio values (NULL, :id_usuario, :salida, :destino, NULL, :horario, :periodo, NULL, NULL)");
    $stmt->bindParam(":id_usuario", $_POST['idUsuario']);
    $stmt->bindParam(":salida", $_POST['localidadSalida']);
    $stmt->bindParam(":destino", $_POST['localidadDestino']);
    $stmt->bindParam(":horario", $_POST['horario']);
    $stmt->bindParam(":periodo", $_POST['periodo']);

    //lanzamos la consulta
    try {
        $stmt->execute();
        echo "OK";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

/**
 * FUNCION: cargaDetalle
 * 
 * INPUTS: $idAnuncio (int)
 * 
 * OUTPUTS: $html (string)
 * 
 * DESCRIPCION: Construye un html para la página de detalle de un anuncio
 * 
 * NOTAS: NO permite editar
 */
function cargaDetalle($idAnuncio) {
    //conectamos con la bbdd
    $con = new PasajeroModel();
    $model = $con->conectar();

    //obtenemos lo datos necesarios de las distintas tablas:
    ///Tabla anuncio 
    $stmt_anuncio = $model->prepare("SELECT * FROM anuncio WHERE id = $idAnuncio");
    $stmt_anuncio->execute();
    $resultado_anuncio = $stmt_anuncio->fetch();

    //tabla persona
    $stmt_persona = $model->prepare("SELECT * FROM persona WHERE id_usuario = :idUsuario");
    $stmt_persona->bindParam(":idUsuario", $resultado_anuncio['id_usuario']);
    $stmt_persona->execute();
    $resultado_persona = $stmt_persona->fetch();

    //tabla localidad
    $stmt_localidad = $model->prepare("SELECT * FROM localidad WHERE id = :id");
    $stmt_localidad->bindParam(":id", $resultado_anuncio['salida']);
    $stmt_localidad->execute();
    $localidadSalida = $stmt_localidad->fetch();

    $stmt_localidad->bindParam(":id", $resultado_anuncio['destino']);
    $stmt_localidad->execute();
    $localidadDestino = $stmt_localidad->fetch();

    //tabla cerntro
    $stmt_centro = $model->prepare("SELECT * FROM centro WHERE id = :id");
    $stmt_centro->bindParam(":id", $resultado_anuncio['centro']);
    $stmt_centro->execute();

    $centro = $stmt_centro->fetch();

    //tabla coche
    $stmt_coche = $model->prepare("SELECT * FROM coche ch, conductor c WHERE ch.id_propietario = c.id AND c.id_usuario = :idUsuario");
    $stmt_coche->bindParam(":idUsuario", $resultado_anuncio['id_usuario']);
    $stmt_coche->execute();

    $coche = $stmt_coche->fetch();

    $html = "<div class='container'>
            <div class='col-md-5 col-sm-5'>

                <div class='panel panel-info'>
                    <div class='panel-heading'>
                        <h2>Detalles</h2>
                    </div>
                    <div class='panel-body'>
                        <div>
                            <label>- Origen:</label>" .
            $localidadSalida[1]
            . "</div>
                        <div>
                            <label>- Destino:</label>" .
            $localidadDestino[1]
            . "
                        </div>
                        <div>
                            <label>- Centro:</label>" .
            $centro['nombre']
            . "
                        </div>
                        <div>
                            <label>- Horario:</label>" .
            ucfirst($resultado_anuncio['horario'])
            . "
                        </div>
                        <div>
                            <label>- Periodo:</label>" .
            ucfirst($resultado_anuncio['periodo'])
            . "
                            
                        </div>
                        <div>
                            <label>- Plazas:</label>" .
            $resultado_anuncio['plazas']
            . "
                          
                        </div>
                        <div>
                            <label>- Precio por pasajero:</label>" .
            $resultado_anuncio['precio']
            . " €
                            
                        </div>
                    </div>
                </div>

                <button id='btnApuntar' class='btn btn-success'>Reservar plaza</button>

            </div>

            <div class='col-md-5 col-sm-5 col-md-offset-2 col-sm-offset-2'>
                <div class='panel panel-info'>
                    <div class='panel-heading'>
                        <h2>Conductor</h2>
                    </div>
                    <div class='panel-body'>
                        <div>
                            <label>- Nombre:</label>" .
            $resultado_persona['nombre'] . " " . $resultado_persona['apellidos']
            . "
                            
                        </div>
                        <div>
                            <label>- Edad:</label>" .
            $resultado_persona['edad']
            . "
                        </div>
                        <div>
                            <label>- Telefono:</label>" .
            $resultado_persona['telefono']
            . "
                        </div>
                        <div>
                            <label>- Vehiculo:</label>" .
            ucfirst($coche['tipo'])
            . "
                        </div>
                        <div>
                            <label>- Descripción:</label>" .
            $coche['descripción']
            . "</div>
                        <div>
                            <label>- Media valoraciones:</label>
                            *
                        </div>
                    </div>

                </div>


            </div>
        </div>";

    return $html;
}

/**
 * FUNCION: reservaPlaza
 * 
 * INPUTS: $idAnuncio (int)
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Inserta una nueva acuerdo y actualizalas plazas
 * 
 * NOTAS: NO permite editar
 */
function reservaPlaza($idAnuncio) {

    //conectamos con la base de datos
    $con = new PasajeroModel();
    $model = $con->conectar();

    //obtenemos datos del anuncio
    $stmt_anuncio = $model->prepare("SELECT * FROM anuncio WHERE id = $idAnuncio");
    $stmt_anuncio->execute();
    $anuncio = $stmt_anuncio->fetch();

    //obtenemos datos que necesitamos para la insecion
    $stmt_conductor = $model->prepare("SELECT id FROM conductor WHERE id_usuario = :idUsuario");
    $stmt_conductor ->bindParam(":idUsuario", $anuncio['id_usuario']);
    $stmt_conductor->execute();
    $idConductor = $stmt_conductor->fetch();
    
    
//    $stmt_pasajero = $model->prepare("SELECT id FROM pasajero WHERE id_usuario = " . $_SESSION['idPasajero']);
//    $stmt_pasajero->execute();
//    $idPasajero =  $stmt_pasajero->fetch();

    $model->beginTransaction();
    try {
        $stmt_insert = $model->prepare("INSERT INTO acuerdo VALUES (NULL, :id_conductor, :id_pasajero, :id_anuncio, CURRENT_DATE(), :periodo, :precio)");
        $stmt_insert->bindParam(":id_conductor", $idConductor[0]);
        $stmt_insert->bindParam(":id_pasajero", $_SESSION['idPasajero']);
        $stmt_insert->bindParam(":id_anuncio", $idAnuncio);
        $stmt_insert->bindParam(":periodo", $anuncio['periodo']);
        $stmt_insert->bindParam(":precio", $anuncio['precio']);

        $stmt_insert->execute();

        $stmt_update = $model->prepare("UPDATE anuncio SET plazas = :plazas WHERE id = $idAnuncio");
        $plazas = $anuncio['plazas'];
        $plazas--;
        $stmt_update->bindParam(":plazas", $plazas);

        $stmt_update->execute();
        $model->commit();
        
        return "Plaza reservada correctamente";
        
    } catch (Exception $ex) {
        $model->rollBack();
        return $ex->getMessage();
    }
}
