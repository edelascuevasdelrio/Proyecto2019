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

//require_once 'C:\xampp\htdocs\Proyecto2019Git\assets\bbdd\credenciales.php';
require_once '.\..\..\bbdd\credenciales.php';

echo $_SERVER['DOCUMENT_ROOT']."";
class RegistroModel {

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
     * FUNCION: calculaEdad
     * 
     * INPUTS: fecha (date)
     * 
     * OUTPUTS: (int)
     * 
     * DESCRIPCION: En función de la fecha que se introduzca, te devuelve la edad comparando con la fecha actual
     * 
     * NOTAS:
     */
    private function calculaEdad($fecha) {
        //list($Y, $m, $d) = explode("-", $fecha);
        $Y = intval(substr($fecha, 0, 4));
        $m = intval(substr($fecha, 5, 2));
        $d = intval(substr($fecha, 8, 2));

        return( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
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
    public function localidadesCentros() {
        //VARIABLES
        $con = self::conectar();
        $salida = "<option></option>";

        
        //SQL CONTRA LA BBDD
        $sentencia = $con->prepare("SELECT * FROM localidad where id in ( SELECT localidad from centro )");
        $sentencia->execute();

        //RECOGEMOS LOS RESULTADOS Y CONSTRUIMOS EL HTML
        $resultado = $sentencia->fetch();
        while ($resultado != null) {
            $salida .= "<option value='" . $resultado[0] . "'>" . $resultado[1] . "</option>";

            $resultado = $sentencia->fetch();
        }

        return $salida;
    }

    /*
     * FUNCIÓN: registrarUsuario
     * 
     * INPUTS: Entradas realizadas por variables en $_SESSION
     * 
     * OUTPUT: -
     * 
     * DESCRIPCIÓN:Inserta en la BBDD un nuevo usuario con todos los datos
     */

    public function registrarUsuario() {
        //Nos conectamos
        $con = self::conectar();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            //Iniciamos la transacción (Ya que incluye varios INSERT y algunos dependen de otros
            $con->beginTransaction();


            //INSERT para la tabla 'usuario'. Por defecto, el estado de 'activo' estará en 1
            $stmt = $con->prepare("INSERT INTO `usuario` VALUES (NULL, :username, MD5(:passw), CURRENT_DATE(), :email, 1)");
            $stmt->bindParam(":username", $_SESSION['registro_username']);
            $stmt->bindParam(":passw", $_SESSION['registro_passw']);
            $stmt->bindParam(":email", $_SESSION['registro_email']);
            $stmt->execute();

            echo "usuario insertado <br>";


            //Guardamos el index, que corresponderá al id del usuario insertado
            $id_usuario = $con->lastInsertId();

            //INSERT para la tabla 'persona'
            $stmt2 = $con->prepare("INSERT INTO `persona` VALUES (:dni, :id_usuario, :nombre, :apellidos, :fecha, :edad, :horario, :telefono, :saludo)");
            $stmt2->bindParam(":dni", $_SESSION['registro_dni']);
            $stmt2->bindParam("id_usuario", $id_usuario);
            $stmt2->bindParam(":nombre", $_SESSION['registro_nombre']);
            $stmt2->bindParam(":apellidos", $_SESSION['registro_apellidos']);
            $stmt2->bindParam(":fecha", $_SESSION['registro_fecha_nacimiento']);

            $stmt_edad = $con->prepare("SELECT fecha_nacimiento FROM persona WHERE id_usuario = $id_usuario");
            $stmt_edad->execute();
            $resultado = $stmt_edad->fetch();

            //Aqui hacemos los calculos que nos devuelve la edad
            $edad = self::CalculaEdad($resultado[0]);

            $stmt2->bindParam(":edad", $edad);
            $stmt2->bindParam(":horario", $_SESSION['registro_horario']);
            $stmt2->bindParam(":telefono", $_SESSION['registro_telefono']);
            $stmt2->bindParam(":saludo", $_SESSION['registro_saludo']);
            $stmt2->execute();

            echo "persona insertado <br>";
            //INSERT para la tabla 'pasajero'
            $stmt3 = $con->prepare("INSERT INTO `pasajero` VALUES (NULL,:id_usuario,:localidad,:destino)");
            $stmt3->bindParam(":id_usuario", $id_usuario);
            $stmt3->bindParam(":localidad", $_SESSION['registro_localidad']);
            $stmt3->bindParam(":destino", $_SESSION['registro_destino']);
            $stmt3->execute();

            echo "pasajero insertado <br>";

            //Ahora entramos en el apartado conductor. Solo se ejecutará si se ha pulsado en 'Siguiente'           
            if (isset($_SESSION['conduce'])) {
                //INSERT para la tabla conductor. 
                $stmt4 = $con->prepare("INSERT INTO `conductor` VALUES (NULL,:id_usuario,:permiso)");
                $stmt4->bindParam(":id_usuario", $id_usuario);
                $stmt4->bindParam(":permiso", $_SESSION['registro_permiso']);
                $stmt4->execute();
                echo "coductor insertado <br>";
                //guardamos el id -> Un coche puede tener varios conductores, y un conductor puede tener varios vehiculos.
                //por eso al insertar vehiculos, se asignan a conductores y no a usuarios

                $id_conductor = $con->lastInsertId();


                //INSERT para la tabla vehiculo
                $stmt5 = $con->prepare("INSERT INTO `coche` VALUES (NULL,:id_conductor, :tipo, :matricula, :descripcion)");
                $stmt5->bindParam(":id_conductor", $id_conductor);
                $stmt5->bindParam(":tipo", $_SESSION['registro_tipovehiculo']);
                $stmt5->bindParam(":matricula", $_SESSION['registro_matricula']);
                $stmt5->bindParam(":descripcion", $_SESSION['registro_descrip']);
                $stmt5->execute();
                echo "vehiculo insertado <br>";
            }



            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }



}
