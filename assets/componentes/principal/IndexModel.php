<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../bbdd/credenciales.php';
class IndexModel {

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
    private function conectar() {
        //Recojemos los datos para la conexión
        $credObject = new Credenciales();
        $credenciales = $credObject ->getCredenciales();
        
        $hostname = $credenciales['hostname'];
        $database = $credenciales['database'];
        $username = $credenciales['username'];
        $password = $credenciales['password'];

        try {
            //Hacemos la conexión con la BBDD
            $objetoPDO = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . '', $username, $password);
            $objetoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //En caso de error, mostramos el mensaje
            echo "ERROR: " . $e->getMessage();
        }

        return $objetoPDO;
    }

    /**
     * FUNCION: login
     * 
     * INPUTS: usuario(string) , contrasena(string)
     * 
     * OUTPUTS: booleano
     * 
     * DESCRIPCION: Comprueba si las credenciales introducidas existen en la BBDD
     * 
     * NOTAS:
     */
    public function login($usuario, $contrasena) {
        //Conectamos con la base de datos
        $con = self::conectar();
        
        //Preparamos la sentencia SQL y la ejecutamos
        $sentencia = $con->prepare("SELECT * FROM usuario WHERE user= :usuario AND pass= MD5(:contrasena)");
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":contrasena", $contrasena);

        $sentencia->execute();
        //Regemos el resultado de la ejecución
        $resultado = $sentencia->fetch();

        //Si el resultado es null, quiere decir que no hay usuario con esos datos, por lo que devuelve false.
        if ($resultado == null) {
            
            return 'false';
        } else {
            if($resultado['activo'] == 0){
                return "noactivo";
            }else {
                return 'true';
            }
            
        }
    }

}
