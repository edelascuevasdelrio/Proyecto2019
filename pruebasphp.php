<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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



$localidad = 1;
$salida = "";


$stmt2 = $objetoPDO->prepare("SELECT id, nombre FROM centro WHERE localidad = :localidad");
            $stmt2->bindParam(":localidad", $localidad); //ESTO HABRA QUE PONER LA ID DE LA LOCALIDAD QUE SE NOS PASE POR PARAMETRO
            $stmt2->execute();

            $resultado2 = $stmt2->fetch();
            while ($resultado2 != null) {
                $salida .= "<option value='";
                $salida .= $resultado2['id'];
                $salida .= "'>";
                $salida .= $resultado2[1];
                $salida .= "</option>";
                
                $resultado2 = $stmt2->fetch();
            }
            print_r($salida);
            
            
echo "<hr>";


function calculaEdad($fecha) {
        //list($Y, $m, $d) = explode("-", $fecha);
        $Y = intval(substr($fecha, 0, 4));
        $m = intval(substr($fecha, 5, 2));
        $d = intval(substr($fecha, 8, 2));

        echo "<script>alert('LOOOOL');</script>";
        return( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
    }

    
    $stmt_edad = $objetoPDO->prepare("SELECT fecha_nacimiento FROM persona WHERE id_usuario = 3");
            $stmt_edad->execute();
            $resultado = $stmt_edad->fetch();
            echo calculaEdad($resultado[0]);