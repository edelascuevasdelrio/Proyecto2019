<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pasajeroModel
 *
 * @author Enrique de las Cueva
 */
require_once 'C:\xampp\htdocs\Proyecto2019Git\assets\bbdd\credenciales.php';

//require_once '/hosting/ecuevas/www/assets/bbdd/credenciales.php';


class PasajeroModel {
    //put your code here

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

    function buscaAnuncios() {
        $con = self::conectar();
        $salida = array();

        $stmt = $con->prepare("SELECT * FROM anuncio"); //IGUAL AÑADIR UN ORDER BY, O AÑADIRLOS CON UNOS "FILTROS"
        $stmt->execute();

        $resultado = $stmt->fetch();

        while ($resultado != null) {
            array_push($salida, $resultado);
            $resultado = $stmt->fetch();
        }
        
        return $salida;
    }

}
