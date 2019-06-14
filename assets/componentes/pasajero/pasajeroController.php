<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pasajeroController
 *
 * @author Enrique de las Cueva
 */
require_once './pasajeroModel.php';

class PasajeroController {

    //put your code here

    public function recibeDatos($proceso, $argumentos) {
        $con = new PasajeroModel();

        switch ($proceso) {
            case 'inicio':
                $html = self::cargaTablaAnuncios();
                return $html;
            case 'idUsuario':
                $id = $con->usuarioAsession($argumentos);
                return $id;
            case 'idConductor':
                $id = $con->conductorAsession($argumentos);
                return $id;
            case 'idPasajero':
                $id = $con->pasajeroAsession($argumentos);
                return $id;

            case 'cargaDesde':
                $options = $con->localidadesUsuarios();
                return $options;

            case 'cargaHasta':
                $options = $con->localidadesCentros();
                return $options;
            case 'isConductor':
                $valor = $con->isConductor();
                return $valor;
        }
    }

    /**
     * FUNCION: cargaTablaAnuncio
     * 
     * INPUTS: -
     * 
     * OUTPUTS: string
     * 
     * DESCRIPCION: Se encarga de cargar la tabla inicial con los datos de la BBDD.
     *              Hace una llamada a buscaAnuncios para obtener sus datos, y despues a
     *              generaTabla para que la construya con los datos y el estilo
     * 
     * NOTAS:
     */
    function cargaTablaAnuncios() {
        $con = new PasajeroModel();

        $cabecera = ['Usuario', 'Punto de salida', 'Destino', 'Centro de estudios', 'Horario', 'Periodo', 'Plazas disponibles'];
        $contenido = $con->buscaAnuncios();

        return self::generaTabla($cabecera, $contenido);
    }

    /**
     * FUNCION: generaTabla
     * 
     * INPUTS: $cabecera (array) | $contenido (array)
     * 
     * OUTPUTS: $salida (string)
     * 
     * DESCRIPCION: Construye una tabla y la completa con los datos de la cabecera y el contenido
     * 
     * NOTAS:
     */
    function generaTabla($cabecera, $contenido) {
        $salida = "<table class='table table-hover'>
            <thead>
                <tr>";
        foreach ($cabecera as $value) {
            $salida .= "<th id='cabecera" . $value . "'>$value</th>";
        }
        $salida .= "</tr>
            </thead>
            <tbody>";
        foreach ($contenido as $value) {
            $salida .= "<tr id='" . $value[count($value) - 1] . "'>";
            foreach ($value as $key => $value2) {
                $salida .= "<td id='" . $value[count($value) - 1] . "_" . $key . "'>" . ucfirst($value2) . "</td>";
            }

            $salida .= "</tr>";
        }

        $salida .= "
            </tbody>
        </table>";


        return $salida;
    }

}
