<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once $_SERVER['DOCUMENT_ROOT']."/Proyecto2019Git/assets/bbdd/credenciales.php";
//require_once 'C:\xampp\htdocs\Proyecto2019Git\assets\bbdd\credenciales.php';
//require_once '/hosting/ecuevas/www/assets/bbdd/credenciales.php';
session_start();

class MiespacioModel{
    
    /**
     * FUNCION: conectar
     * 
     * INPUTS: -
     * 
     * OUTPUTS: objetoPDO (PDO)
     * 
     * DESCRIPCION: Realiza la conexión con la BBDD
     * 
     * NOTAS:
     */
    public function conectar() {
        //Recojemos los datos para la conexión
        $credObject = new Credenciales();
        $credenciales = $credObject->getCredenciales();

        $hostname = $credenciales['hostname'];
        $database = $credenciales['database'];
        $username = $credenciales['username'];
        $password = $credenciales['password'];

        try {
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            //Hacemos la conexión con la BBDD
            $objetoPDO = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . '', $username, $password, $opciones);
            $objetoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //En caso de error, mostramos el mensaje
            echo "ERROR: " . $e->getMessage();
        }

        return $objetoPDO;
    }
    
    /**
     * FUNCION:isConductor
     * 
     * INPUTS: -
     * 
     * OUTPUTS: $salida (boolean)
     * 
     * DESCRIPCION: Comprueba si tiene rol de conductor
     * 
     * NOTAS:
     */
    
    function isConductor(){
        $con = self::conectar();
        $stmt_rol = $con->prepare("SELECT conductor FROM rol WHERE id_usuario = :id");
        $stmt_rol->bindParam(":id", $_SESSION['idUsuario']);
        $stmt_rol->execute();
        
        $valor = $stmt_rol->fetch()[0];
        
        return $valor;
    }
}