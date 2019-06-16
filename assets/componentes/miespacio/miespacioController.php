<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './miespacioModel.php';

class MiespacioController{
    
    public function recibeDatos($proceso, $argumentos) {
        $con = new MiespacioModel();
        switch ($proceso) {
            case 'isConductor':
                $valor = $con->isConductor();
                return $valor;
            case '':
                $html = '';
                return $html;
            case '':
               $html = '';
                return $html;
            default:
        }
    }
    
    
    
    
}