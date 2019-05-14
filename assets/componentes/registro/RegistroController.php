<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registroController
 *
 * @author Enrique de las Cueva
 */
require_once './RegistroModel.php';

class RegistroController {

    public function recogeDatos() {
        //Primera sección
        if (isset($_POST['nombre'])) {
            $_SESSION['registro_nombre'] = $_POST['nombre'];
        }
        if (isset($_POST['apellidos'])) {
            $_SESSION['registro_apellidos'] = $_POST['apellidos'];
        }
        if (isset($_POST['dni'])) {
            $_SESSION['registro_dni'] = $_POST['dni'];
        }
        if (isset($_POST['telefono'])) {
            $_SESSION['registro_telefono'] = $_POST['telefono'];
        }
        if (isset($_POST['fecha_nacimiento'])) {
            $_SESSION['registro_fecha_nacimiento'] = $_POST['fecha_nacimiento'];
        }

        //Segunda sección
        if (isset($_POST['horario'])) {
            $_SESSION['registro_horario'] = $_POST['horario'];
        }
        if (isset($_POST['saludo'])) {
            $_SESSION['registro_saludo'] = $_POST['saludo'];
        }

        //Tercera sección
        if (isset($_POST['localidad'])) {
            $_SESSION['registro_localidad'] = $_POST['localidad'];
        }
        if (isset($_POST['destino'])) {
            $_SESSION['registro_destino'] = $_POST['destino'];
        }

        //Cuarta sección
        if(isset($_POST['conduce'])){
            $_SESSION['conduce'] = $_POST['conduce'];
        }
        if (isset($_POST['permiso'])) {
            $_SESSION['registro_permiso'] = $_POST['permiso'];
        }
        if (isset($_POST['tipovehiculo'])) {
            $_SESSION['registro_tipovehiculo'] = $_POST['tipovehiculo'];
        }
        if (isset($_POST['matricula'])) {
            $_SESSION['registro_matricula'] = $_POST['matricula'];
        }
        if (isset($_POST['descrip'])) {
            $_SESSION['registro_descrip'] = $_POST['descrip'];
        }

        //Quinta sección
        if (isset($_POST['username'])) {
            $_SESSION['registro_username'] = $_POST['username'];
        }
        if (isset($_POST['passw'])) {
            $_SESSION['registro_passw'] = $_POST['passw'];
        }
        if (isset($_POST['email'])) {
            $_SESSION['registro_email'] = $_POST['email'];
        }
    }

    //Recibe el proceso que se desea controlar
    public function recibeDatos($proceso, $argumentos) {

        self::recogeDatos();
        //el proceso indica en que parte del registro estamos, devolviendo en cada caso un HTML diferente
        $model = new RegistroModel();
        switch ($proceso) {
            //r1: Primera sección del registro
            case 'r1':
                $formulario = "<form action='' method='POST'>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <label for='nombre' class='control-label'>Nombre</label>
                                <input type='text' class='form-control' id='nombre' name='nombre' placeholder='Ej. Antonio' required>
                            </div>
                            <div class='form-group'>
                                <label for='apellidos' class='control-label'>Apellidos</label>
                                <input type='text' class='form-control' id='apellidos' name='apellidos' placeholder='Ej. Sierra' required>
                            </div>
                            <div class='form-group'>
                                <label for='dni' class='control-label'>DNI</label>
                                <input type='text' class='form-control' id='dni' name='dni' placeholder='Ej. 00000000A' required>
                                <label class='control-label' id='dniError'></label>
                            </div>
                            <div class='form-group'>
                                <label for='telefono' class='control-label'>Teléfono</label>
                                <input id='telefono' type='text' class='form-control' id='telefono' name='telefono' placeholder='Ej. 999666222' required>
                                <label class='control-label' id='telError' >Formato del telefono no es valido</label>
                            </div>
                            <div class='form-group'>
                                <label for='fecha_nacimiento' class='control-label'>Fecha de nacimiento</label>
                                <input type='date' class='form-control' id='fecha_nacimiento' name='fecha_nacimiento'>
                            </div>
                            <div class='form-group'>
                                <input type='submit' class='btn btn-primary' id='siguienter1' value='Siguiente' disabled>
                            </div>
                        </div>    
                        <input type='hidden' id='section' name='section' value='r2'>


                    </div>
                </form>";

                return $formulario;
            case 'r2':
                $formulario = "<form action='' method='POST'>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <label for='horario' class='control-label'>Horario</label>
                                
                                <select name='horario' class='form-control'>
                                    <option value='diurno'>Diurno</option>
                                    <option value='nocturno'>Nocturno</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='saludo' class='control-label'>Saludo</label>
                                <textarea class='form-control' id='saludo' name='saludo' placeholder='Hola!'></textarea>
                            </div>                           
                            <div class='form-group'>
                                <input type='submit' class='btn btn-primary' id='siguienter2' value='Siguiente'>
                            </div>
                        </div>    
                        <input type='hidden'  name='section' value='r3'>


                    </div>
                </form>";

//                echo $_SESSION['registro_nombre'];
//                echo $_SESSION['registro_apellidos'];
//                echo $_SESSION['registro_dni'];
//                echo $_SESSION['registro_telefono'];
//                echo $_SESSION['registro_fecha_nacimiento'];

                return $formulario;
            case 'r3':
                $formulario = "<form action='' method='POST'>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <h3><label class='control-label'>Datos como pasajero</label></h3>                 
                            </div>
                            <div class='form-group'>
                                <label for='localidad' class='control-label'>¿Desde donde sales?</label>
                                <select id='localidad' class='form-control' name='localidad'>
                                
                                " .
                                    $model->localidadesUsuarios().
                                "</select>
                                   ¿No aparece tu localidad? <a data-toggle='modal' data-target='#añadir' >Añadela desde aquí </a>
                            </div>
                            <div class='form-group'>
                                <label for='destino' class='control-label'>¿Dónde estudias?</label>
                                <select id='destino' class='form-control' name='localDestino'>
                                
                                " .
                                    $model->localidadesCentros().
                                "</select>
                            </div> 
                            
                            <div class='form-group'>
                                <select id='destinoCentro' class='form-control' name='destino'>
                                <option></option>
                                ".
                                    $model->cargaCentros(). //ESTE HAY QUE CAMBIARLO
                                "</select>
                            </div>
                            
                            <div class='form-group'>
                                <input type='submit' class='btn btn-primary' id='siguienter3' value='Siguiente' disabled>
                            </div>
                        </div>    

                        <input type='hidden' name='section' value='r4'>

                    </div>
                </form>
                
                
                <div class='modal fade' id='añadir' tabindex='-1' role='dialog' aria-labelledby='Añadir localidad' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h2 class='modal-title' >Añadir localidad</h2>
                          
                        </div>
                        <div class='modal-body'>
                          <label for='nombre_localidad' class='form-label'>Nombre: </label>
                          <input type='text' id='nombre_localidad' name='nombre_localidad' class='form-control' placeholder='Ej. Santander'>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                          <button id='anadir' type='button' class='btn btn-primary'>Añadir</button>
                        </div>
                      </div>
                    </div>
                  </div>";

//                echo $_SESSION['registro_horario'];
//                echo $_SESSION['registro_saludo'];
                return $formulario;
            case 'r4':
                $formulario = "

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <h3><label class='control-label'>Datos como conductor</label></h3>         
                                
                            </div>
                            <form action='' method='POST'>
                                <div class='form-check'>
                                    <label for='conducesi' class='control-label'>¿Vas a ejercer como conductor?</label>
                                    <input type='checkbox' class='form-check' name='conduce' id='conducesi' data-toggle='collapse' data-target='#datoscoche'>Si
                                </div>
                            
                                <div id='datoscoche' class='collapse'>

                                        <div class='form-group'>
                                            <label for='permiso' class='control-label'>Permiso de conducir</label>
                                            <select class='form-control' name='permiso'>
                                                <option value='B'>B</option>
                                                <option value='B'>A1</option>
                                                <option value='B'>A2</option>
                                                <option value='B'>A</option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label'>Seleccione tipo de vehiculo</label>
                                            <select class='form-control' name='tipovehiculo'>
                                                <option value='coche'>Coche</option>
                                                <option value='moto'>Moto</option>
                                                <option value='ciclomotor'>Ciclomotor</option>
                                                <option value='scooter'>Scooter</option>
                                                <option value='furgoneta'>Furgoneta</option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label'>Introduce la matricula</label>
                                            <input type='text' class='form-control' id='matricula' name='matricula' placeholder='0000AAA' required>
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label'>Una breve descripción del vehiculo</label>
                                            <textarea id='descrip'class='form-control' name='descrip'></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <input type='submit' class='btn btn-success' id='siguiente' name'siguienter4' value='Siguiente' disabled>
                                        </div> 
                                        <input type='hidden' name='section' value='r5'>
                                    
                                </div>
                            </form>
                            
                            <form action='' method='POST'>
                                <div class='form-group'>         
                                    <input type='submit' class='btn btn-success' id='saltar' name'saltar' value='Omitir este paso'>
                                </div>
                                <input type='hidden' name='section' value='r5'>
                            </form>   
                        </div>    

                        

                    </div>
                
";

                return $formulario;
            case 'r5':

                $formulario = "<form action='' method='POST'>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <h3><label class='control-label'>Para finalizar...</label></h3>         
                                
                            </div>
                            
                            <div class='form-group'>
                                <label for='username' class='control-label'>Nombre de usuario</label>
                                <input type='input' class='form-control' name='username' id='username'>
                            </div>
                            
                            <div class='form-group'>
                                <label for='passw' class='control-label'>Contraseña</label>
                                <input type='input' class='form-control' name='passw' id='passw'>
                            </div>
                            
                            <div class='form-group'>
                                <label for='passwR' class='control-label'>Repita la contraseña</label>
                                <input type='input' class='form-control' name='passwR' id='passwR'>
                            </div>
                            
                            <div class='form-group'>
                                <label for='email' class='control-label'>Email</label>
                                <input type='email' class='form-control' name='email' id='email'>
                            </div>

                            <div class='form-group'>         
                                <input type='submit' class='btn btn-success' id='siguienter5' name'saltar' value='Registrar' disabled>
                            </div>
                        </div>    

                        <input type='hidden' name='section' value='rfin'>

                    </div>
                </form>
                
";


//                echo "Conduce: " . $_POST['conduce'];
//                echo $_SESSION['registro_permiso'];
//                echo $_SESSION['registro_tipovehiculo'];
//                echo $_SESSION['registro_matricula'];
//                echo $_SESSION['registro_descrip'];

                return $formulario;
            case 'rfin':
                $model->registrarUsuario();
                session_destroy();
                //header("Location: ../principal/princi.php");
                break;
            default:
                return "NOOOOOOOOPE, tenemos esto: " . $proceso;
        }
    }

}
