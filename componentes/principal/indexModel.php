<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of indexModel
 *
 * @author Enrique de las Cueva
 */
class indexModel {

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

    public function login($usuario, $contrasena) {

        $con = self::conectar();

        $sentencia = $con->prepare("SELECT * FROM usuario WHERE user= :usuario AND pass= MD5(:contrasena)");
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":contrasena", $contrasena);

        $sentencia->execute();

        $resultado = $sentencia->fetch();

        if ($resultado == null) {
            return false;
        } else {
            return true;
        }
    }

}
