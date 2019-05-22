<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBController
 *
 * @author Enrique de las Cueva
 */
class DBController {

    //put your code here
    public function conectar() {
        $hostname = 'localhost';
        $database = 'pruebaproyecto';
        $username = 'root';
        $password = '';
        
//        $hostname = 'http://aglinformatica.es:6080/phpmyadmin';
//        $database = '2019p_ecuevas';
//        $username = 'ecuevas';
//        $password = 'ec_659';
        
        
        try {   
            $objetoPDO = new PDO('mysql:host='.$hostname.';dbname='.$database.'', $username, $password);
            $objetoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
        
        return $objetoPDO;
    }
    
    public function login($usuario, $contrasena){
        
        $con = self::conectar();
        
        $sentencia = $con -> prepare("SELECT * FROM usuario WHERE user= :usuario AND pass= MD5(:contrasena)");
        $sentencia -> bindParam(":usuario", $usuario);
        $sentencia -> bindParam(":contrasena", $contrasena);
        
        $sentencia ->execute();
        
        $resultado = $sentencia->fetch();
       
        if($resultado == null){
            echo "Usuario y/o contraseña incorrectas";
        }else{
            echo "Usuario y/o contraseña correctas";
        }
       
        
    }
    

    
    
}

$algo = new DBController();

echo $algo->login("asdasd", "ddddddd");
