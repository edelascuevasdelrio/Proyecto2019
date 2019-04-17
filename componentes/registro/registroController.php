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
class registroController {
    //put your code here
    
    public function recibeDatos($proceso, $argumentos){
        
        switch($proceso){
            case 'r1':
                $formulario = "<form action='' method='POST'>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <label for='nombre' class='control-label'>Nombre</label>
                                <input type='text' class='form-control' id='nombre' name='nombre' placeholder='Ej. Antonio'>
                            </div>
                            <div class='form-group'>
                                <label for='apellidos' class='control-label'>Apellidos</label>
                                <input type='text' class='form-control' id='apellidos' name='apellidos' placeholder='Ej. Sierra'>
                            </div>
                            <div class='form-group'>
                                <label for='dni' class='control-label'>DNI</label>
                                <input type='text' class='form-control' id='dni' name='dni' placeholder='Ej. 00000000-A'>
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
                                <label for='nombre' class='control-label'>akljsnfhaklnkfjankjfbakjenfkajfkjan.kefna.ekfa</label>
                                <input type='text' class='form-control' id='nombre' name='nombre' placeholder='Ej. Antonio'>
                            </div>
                            <div class='form-group'>
                                <label for='apellidos' class='control-label'>Apellidos</label>
                                <input type='text' class='form-control' id='apellidos' name='apellidos' placeholder='Ej. Sierra'>
                            </div>
                            <div class='form-group'>
                                <label for='dni' class='control-label'>DNI</label>
                                <input type='text' class='form-control' id='dni' name='dni' placeholder='Ej. 00000000-A'>
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
                        <input type='hidden' name='section' value='r3'>


                    </div>
                </form>";
                return $formulario;
            case 'r3':
                $formulario = "<form action='' method='POST'>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='form-group'>
                                <label for='nombre' class='control-label'>==============================</label>
                                <input type='text' class='form-control' id='nombre' name='nombre' placeholder='Ej. Antonio'>
                            </div>
                            <div class='form-group'>
                                <label for='apellidos' class='control-label'>Apellidos</label>
                                <input type='text' class='form-control' id='apellidos' name='apellidos' placeholder='Ej. Sierra'>
                            </div>
                            <div class='form-group'>
                                <label for='dni' class='control-label'>DNI</label>
                                <input type='text' class='form-control' id='dni' name='dni' placeholder='Ej. 00000000-A'>
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

                        <input type='hidden' name='section' value='rfin'>

                    </div>
                </form>";
                return $formulario;
                
            case 'rfin':
                header("Location: ../principal/princi.php");
                break;
            default:
                return "NOOOOOOOOPE, tenemos esto: " . $proceso;
        }
        
    }
    
    
}
