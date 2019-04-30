<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registroModel
 *
 * @author Enrique de las Cueva
 */
class RegistroModel {

    //put your code here

    private function conectar() {
        $hostname = 'localhost';
        $database = 'pruebaproyecto';
        $username = 'root';
        $password = '';


        try {

            $objetoPDO = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . '', $username, $password);
            $objetoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $objetoPDO;
    }

    /**
     * 
     */
    public function localidadesUsuarios() {
        //VARIABLES
        $con = self::conectar();
        $salida = "";

        //SQL CONTRA LA BBDD
        $sentencia = $con->prepare("SELECT nombre FROM localidad");
        $sentencia->execute();

        //RECOGEMOS LOS RESULTADOS Y CONSTRUIMOS EL HTML
        $resultado = $sentencia->fetch();
        while ($resultado != null) {
            $salida .= "<option value='". $resultado[0] . "'>" . $resultado[0] . "</option>";
            $resultado = $sentencia->fetch();
        }

        return $salida;
    }
    
    public function localidadesCentros() {
        //VARIABLES
        $con = self::conectar();
        $salida = "";

        //SQL CONTRA LA BBDD
        $sentencia = $con->prepare("SELECT nombre FROM localidad where id in ( SELECT localidad from centro )");
        $sentencia->execute();

        //RECOGEMOS LOS RESULTADOS Y CONSTRUIMOS EL HTML
        $resultado = $sentencia->fetch();
        while ($resultado != null) {
            $salida .= "<option value='". $resultado[0] . "'>" . $resultado[0] . "</option>";
            $resultado = $sentencia->fetch();
        }

        return $salida;
    }

}
