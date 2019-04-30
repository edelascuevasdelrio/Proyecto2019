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
    
    //Recibe el proceso que se desea controlar
    
    public function recibeDatos($proceso, $argumentos){
        
        $model = new RegistroModel();
        switch($proceso){
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
                                <input type='text' class='form-control' id='dni' name='dni' placeholder='Ej. 00000000-A' required>
                            </div>
                            <div class='form-group'>
                                <label for='telefono' class='control-label'>Teléfono</label>
                                <input type='text' class='form-control' id='telefono' name='telefono' placeholder='Ej. 999666222'>
                            </div>
                            <div class='form-group'>
                                <label for='fecha_nacimiento' class='control-label'>Fecha de nacimiento</label>
                                <input type='date' class='form-control' id='fecha_nacimiento' name='fecha_nacimiento'>
                            </div>
                            <div class='form-group'>
                                <input type='submit' id='siguiente' value='Siguiente'>
                            </div>
                        </div>    
                        <input type='hidden' name='section' value='r2'>


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
                                <input type='submit' id='siguiente' value='Siguiente'>
                            </div>
                        </div>    
                        <input type='hidden' name='section' value='r3'>


                    </div>
                </form>";
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
                                <select class='form-control' name='localidad'>
                                ".
                                    $model->localidadesUsuarios()
                    
                                .
                    
                                "</select>
                                   ¿No aparece tu localidad? <a data-toggle='modal' data-target='#añadir' >Añadela desde aquí </a>
                            </div>
                            <div class='form-group'>
                                <label for='destino' class='control-label'>¿Dónde estudias?</label>
                                <select class='form-control' name='localidad'>
                                ".
                                    $model->localidadesCentros()
                    
                                .               
                                "</select>
                            </div>
                            
                            <div class='form-group'>
                                <input type='submit' id='siguiente' value='Siguiente'>
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
                          <button type='button' class='btn btn-primary'>Añadir</button>
                        </div>
                      </div>
                    </div>
                  </div>";
                return $formulario;
            case 'r4':
                $formulario = "<form action='' method='POST'>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <h3><label class='control-label'>Datos como conductor</label></h3>                      
                            </div>
                            <div class='form-group'>
                                <label for='permiso' class='control-label'>Permiso de conducir</label>
                                <select class='form-control' name='permiso'>
                                    <option value='B'>B</option>
                                    <option value='B'>A1</option>
                                    <option value='B'>A2</option>
                                    <option value='B'>A</option>
                                </select>
                                   ¿No aparece tu localidad? <a data-toggle='modal' data-target='#añadir' >Añadela desde aquí </a>
                            </div>
                            <div class='form-group'>
                                <label for='destino' class='control-label'>¿Tienes vehículo propio?</label>
                                <checkbox id='vpropio' name='vpropio'></checkbox>
                            </div>
                            
                            <div class='form-group'>
                                <input type='submit' id='siguiente' value='Siguiente'>
                            </div>
                        </div>    

                        <input type='hidden' name='section' value='rfin'>

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
                          <button type='button' class='btn btn-primary'>Añadir</button>
                        </div>
                      </div>
                    </div>
                  </div>




";
                return $formulario;
                
            case 'rfin':
                header("Location: ../principal/princi.php");
                break;
            default:
                return "NOOOOOOOOPE, tenemos esto: " . $proceso;
        }
        
    }
    
    
}
