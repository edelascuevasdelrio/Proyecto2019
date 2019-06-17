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
    public function localidadesUsuarios() {
        //VARIABLES
        $con = self::conectar();
        $salida = "";

        //SQL CONTRA LA BBDD
        $sentencia = $con->prepare("SELECT nombre FROM localidad ORDER BY nombre");
        $sentencia->execute();

        //RECOGEMOS LOS RESULTADOS Y CONSTRUIMOS EL HTML
        $resultado = $sentencia->fetch();
        while ($resultado != null) {
            $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[0] . "</option>";
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
    $con = new RegistroModel();
    $media = $con->conectar();

    //Preparamos y ejecutamos la sentencia SQL
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