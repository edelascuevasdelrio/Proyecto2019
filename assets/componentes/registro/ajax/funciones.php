<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../RegistroModel.php';
$respuesta = "";
if(isset($_POST['proceso'])){
    if($_POST['proceso'] == 'cargaCentros'){
        
         $respuesta .= cargaCentros($_POST['localidad']);
    }
        
    
   
//    echo cargaCentros($_POST['localidad']);
}
echo $respuesta;

function cargaCentros($localidad){
    $con = new RegistroModel();
    $media = $con -> conectar();
    $index = 0;
     $salida = "";
    
    $stmt = $media -> prepare("SELECT * FROM centro WHERE localidad = :localidad");
    $stmt -> bindParam(":localidad",$localidad);
    $stmt -> execute();
    
     $resultado = $stmt->fetch();
            while ($resultado != null) {
                $salida .= "<option value='" . $index . "'>" . $resultado[1] . "</option>";
                $index++;
                $resultado = $stmt->fetch();
            }

            echo $salida;
//            echo $localidad;
//            return "Cago en dios";
    
    
}