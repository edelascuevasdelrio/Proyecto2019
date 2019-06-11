<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conductorController
 *
 * @author Enrique de las Cueva
 */
require_once './conductorModel.php';

class ConductorController {

    //put your code here

    public function recibeDatos($proceso, $argumentos) {

        switch ($proceso) {
            case 'misacuerdos':
                $html = self::cargaMisacuerdos();
                return $html;

            case 'misanuncios':

                $html = self::cargaTablaAnuncios();

                return $html;
            case 'editaAnuncio':
                $html = self::editarAnuncio($argumentos);
                return $html;
            default:
        }
    }

    /**
     * FUNCION: cargaMisdatos
     * 
     * INPUTS: -
     * 
     * OUTPUTS: -
     * 
     * DESCRIPCION: Muestra un resumen de los acuerdos (Los anuncios + quienes están apuntados
     * 
     * NOTAS: ESPECIFICO PARA UN UNICO USUARIO
     */
    function cargaMisacuerdos() {
        
        $con = new ConductorModel();
        
        $html =$con->misAcuerdos();
        return $html;
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
     * NOTAS: ESPECIFICO PARA UN UNICO USUARIO
     */
    function cargaTablaAnuncios() {
        $con = new ConductorModel();

        $cabecera = ['Usuario', 'Punto de salida', 'Destino', 'Centro de estudios', 'Horario', 'Periodo', 'ID'];
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
            $salida .= "<th>$value</th>";
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
