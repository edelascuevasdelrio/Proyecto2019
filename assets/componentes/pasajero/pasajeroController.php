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

        switch ($proceso) {
            case 'inicio':
                echo 'jajajaja';
                $html = self::cargaTablaAnuncios();
                return $html;
               
        }
    }

    function cargaTablaAnuncios() {
        $con = new PasajeroModel();
        echo 'jejejeje';
        $cabecera = ['Usuario', 'Punto de salida', 'Destino', 'Centro de estudios', 'Horario', 'Periodo'];
        $contenido = $con ->buscaAnuncios();

        return self::generaTabla($cabecera, $contenido);  
    }

    function generaTabla($cabecera, $contenido) {
        print_r($contenido);
        
            $salida="<table class='table table-hover'>
            <thead>
                <tr>";
                    foreach ($cabecera as $value) {
                        $salida.= "<th>$value</th>";
                    }
                $salida.="</tr>
            </thead>
            <tbody>";
                foreach ($contenido as $value) {
                    $salida .="<tr>";
                    foreach ($value as $value2){
                        $salida.= "<td>$value2</td>";
                    }
                    
                    $salida .="</tr>";
                        
                    }
                
                
                
                $salida .="
            </tbody>
        </table>";
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
//        $salida = "<table class='table table-hover>"
//                ."<thead>"
//                . "<tr>";
//        foreach ($cabecera as $value) {
//            echo $value;
////            $salida .= "<td>$value</td>";
//        }
//
//
//        $salida .= "</tr>"
//                . "</thead>";
//
//
//
//
//
//
//        $salida.= "</table>";
        
        return $salida;
    }

}
