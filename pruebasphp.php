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
        
        $stmt = $objetoPDO->prepare("SELECT fecha_nacimiento FROM persona WHERE id_usuario = 2");
        $stmt->execute();
        $resultado = $stmt -> fetch();
        
        $anno = substr($resultado[0], 0,4);
        $date = getdate()['year'];
        

        echo "Si naciste en $anno, tienes; " . ($date - $anno);
        
        
