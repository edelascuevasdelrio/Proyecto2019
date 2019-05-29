<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conductorModel
 *
 * @author Enrique de las Cueva
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/Proyecto2019Git/assets/bbdd/credenciales.php";
//require_once 'C:\xampp\htdocs\Proyecto2019Git\assets\bbdd\credenciales.php';
//require_once '/hosting/ecuevas/www/assets/bbdd/credenciales.php';
session_start();

class conductorModel {

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
     * FUNCION: buscaAnuncios
     * 
     * INPUTS: -
     * 
     * OUTPUTS: $salida (array)
     * 
     * DESCRIPCION: Busca y devuelve un array con los datos de los anuncios referidos a un conductor
     * 
     * NOTAS:
     */
    function buscaAnuncios() {
        //Conectamos con la base de datos
        $con = self::conectar();
        $salida = array();
        //Debido a que necesitamo dos resultados de destino, que no tienen por qué ser el mismo,
        //tendremos que hacer dos consultas para obetener los nombres de las localidades
        //1º Obtenemos los datos de los distintos anuncios
        $stmt = $con->prepare("SELECT * FROM anuncio WHERE id_usuario = '" . $_SESSION['idUsuario'] . "'");
        $stmt->execute();

        $resultado = $stmt->fetch();
        while ($resultado != null) {
            //Sacamos el nombre del usuario
            $stmt_usuario = $con->prepare("SELECT user from usuario WHERE ID = :id");
            $stmt_usuario->bindParam(":id", $resultado['id_usuario']);
            $stmt_usuario->execute();
            $username = $stmt_usuario->fetch()[0];

            //Sacamos el nombre de la localidad de salida
            $stmt_localidad = $con->prepare("SELECT nombre FROM localidad WHERE id = :id");
            $stmt_localidad->bindParam(":id", $resultado['salida']);
            $stmt_localidad->execute();
            $resultado2 = $stmt_localidad->fetch();
            $salida_l = $resultado2[0];

            //Sacamos el nombre de la localidad de destino
            $stmt_localidad->bindParam(":id", $resultado['destino']);
            $stmt_localidad->execute();
            $resultado3 = $stmt_localidad->fetch();
            $destino_l = $resultado3[0];

            //Sacamos el nombre del centro de estudios
            $stmt_centro = $con->prepare("SELECT nombre FROM centro WHERE id = :id");
            $stmt_centro->bindParam(":id", $resultado['centro']);
            $stmt_centro->execute();
            $nombre_centro = $stmt_centro->fetch()[0];

            $array_salida = [$username, $salida_l, $destino_l, $nombre_centro, $resultado['horario'], $resultado['periodo'], $resultado['id']];

            array_push($salida, $array_salida);
            $resultado = $stmt->fetch();
        }

        return $salida;
    }

    /**
     * FUNCION: localidadesUsuarios
     * 
     * INPUTS: -
     * 
     * OUTPUTS: salida (string)
     * 
     * DESCRIPCION: Pide a la BBDD una lista de las localidades y las añade al desplegable
     * 
     * NOTAS:
     */
    public function localidadesUsuarios($idSeleccionado) {
        //VARIABLES
        $con = self::conectar();
        $salida = "";

        //SQL CONTRA LA BBDD
        $sentencia = $con->prepare("SELECT * FROM localidad ORDER BY nombre");
        $sentencia->execute();

        //RECOGEMOS LOS RESULTADOS Y CONSTRUIMOS EL HTML
        $resultado = $sentencia->fetch();
        while ($resultado != null) {
            if ($resultado[0] == $idSeleccionado) {

                $salida .= "<option value='" . $resultado[0] . "' selected>" . $resultado[1] . "</option>";
            } else {
                $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[1] . "</option>";
            }

            $resultado = $sentencia->fetch();
        }

        return $salida;
    }

    /**
     * FUNCION: localidadesCentros
     * 
     * INPUTS: -
     * 
     * OUTPUTS: salida (string)
     * 
     * DESCRIPCION: Pide a la BBDD una lista de las localidades que tienen centros asociados y
     *              las añade al desplegable
     * 
     * NOTAS:
     */
    public function localidadesCentros($idSeleccionado) {
        //VARIABLES
        $con = self::conectar();
        $salida = "";

        //SQL CONTRA LA BBDD
        $sentencia = $con->prepare("SELECT * FROM localidad where id in ( SELECT localidad from centro) ORDER BY nombre");
        $sentencia->execute();

        //RECOGEMOS LOS RESULTADOS Y CONSTRUIMOS EL HTML
        $resultado = $sentencia->fetch();
        while ($resultado != null) {
            if ($resultado[0] == $idSeleccionado) {
                $salida .= "<option value='" . $resultado[0] . "' selected>" . $resultado[1] . "</option>";
            } else {
                $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[1] . "</option>";
            }



            $resultado = $sentencia->fetch();
        }

        return $salida;
    }

    /**
     * FUNCION: cargaCentros
     * 
     * INPUTS: localidad(string)
     * 
     * OUTPUTS: salida (String)
     * 
     * DESCRIPCION: Hace una consulta a la bbdd para obtener los centro asociados a una localidad
     * 
     * NOTAS: localidad es un "string" porque lo recibimos así desde el POST.
     */
    function cargaCentros($localidad) {
        //Preparamos la salida
        $salida = "";

        //Nos conectampos a la base de datos
        $con = new ConductorModel();
        $media = $con->conectar();

        //Preparamos y ejecutamos la sentencia SQL.
        $stmt = $media->prepare("SELECT * FROM centro WHERE localidad = :localidad ORDER BY nombre");
        $stmt->bindParam(":localidad", $localidad);
        $stmt->execute();

        //Recogemos los resultados y construimos la SQL
        $resultado = $stmt->fetch();
        while ($resultado != null) {
            $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[1] . "</option>";

            $resultado = $stmt->fetch();
        }

        echo $salida;
    }

}
