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
            $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[0] . "</option>";
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
            $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[0] . "</option>";
            $resultado = $sentencia->fetch();
        }

        return $salida;
    }

    /*
     * FUNCIÓN: registrarUsuario
     * INPUTS: Entradas realizadas por variables en $_SESSION
     * OUTPUT: -
     * DESCRIPCIÓN:Inserta en la BBDD un nuevo usuario con todos los datos
     */

    public function registrarUsuario() {
        //Nos conectamos
        try {
            $con = self::conectar();
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Iniciamos la transacción (Ya que incluye varios INSERT y algunos dependen de otros
            $con->beginTransaction();
            
            //INSERT para la tabla 'usuario'
            $stmt = $con->prepare("INSERT INTO `usuario` VALUES (NULL, :username, MD5(:passw), CURRENT_DATE(), :email, 1)");
            $stmt->bindParam(":username", $_SESSION['registro_username']);
            $stmt->bindParam(":passw", $_SESSION['registro_passw']);
            $stmt->bindParam(":email", $_SESSION['registro_email']);
            $stmt->execute();
            
            //INSERT para la tabla 'persona'
            
            $stmt = $con -> prepare("INSERT INTO `persona` VALUES (:dni, :id_usuario, :nombre, :apellidos, :fecha, :edad, :horario, :telefono, :saludo)");
            $stmt ->bindParam(":dni", $_SESSION['registro_dni']);
            $stmt ->bindParam(":nombre", $_SESSION['registro_nombre']);
            $stmt ->bindParam(":apellidos", $_SESSION['registro_apellidos']);
            ///////////////////////////////////////////////////////////////////////////////////
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }

}
