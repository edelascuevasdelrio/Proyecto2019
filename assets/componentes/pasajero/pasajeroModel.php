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
//session_start();

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

    /**
     * FUNCION:usuarioAsession
     * 
     * INPUTS: -
     * 
     * OUTPUTS: $idUsuario (int)
     * 
     * DESCRIPCION: Sube a la sesion los datos que se puedan necesitar del usuario, en funcion de su username.
     * 
     * NOTAS:
     */
    function usuarioAsession(){
        $con = self::conectar();
        //obtenemos el id del usuario segun su username
        $stmt_idUsuario = $con ->prepare("SELECT id FROM usuario WHERE user = '" . $_SESSION['usuario'] . "'");
        $stmt_idUsuario ->execute();
        $idUsuario = $stmt_idUsuario->fetch()[0];
//        echo $idUsuario; //Aquí si se muestra
        
        return $idUsuario;
        
    }
    
    /**
     * FUNCION: buscaAnuncios
     * 
     * INPUTS: -
     * 
     * OUTPUTS: $salida (string)
     * 
     * DESCRIPCION: Recoge los datos de los anuncios de la BBDD
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
        $stmt = $con->prepare("SELECT * FROM anuncio"); //IGUAL AÑADIR UN ORDER BY, O AÑADIRLOS CON UNOS "FILTROS"
        $stmt->execute();

        $resultado = $stmt->fetch();
        while ($resultado != null) {
            //Sacamos el nombre del usuario
            $stmt_usuario = $con->prepare("SELECT user from usuario WHERE ID = :id");
            $stmt_usuario ->bindParam(":id", $resultado['id_usuario']);
            $stmt_usuario ->execute();
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
            $stmt_centro ->bindParam(":id", $resultado['centro']);
            $stmt_centro ->execute();
            $nombre_centro = $stmt_centro ->fetch()[0];
            
            $array_salida = [$username, $salida_l, $destino_l, $nombre_centro, $resultado['horario'], $resultado['periodo']];

            array_push($salida, $array_salida);
            $resultado = $stmt->fetch();
        }

        return $salida;
    }

}
