<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './miespacioModel.php';

class MiespacioController{
    
    public function recibeDatos($proceso, $argumentos) {
        $con = new MiespacioModel();
        switch ($proceso) {
            case 'isConductor':
                $valor = $con->isConductor();
                return $valor;
            case 'formDatos':
                $html = self::formDatos();
                return $html;
            case '':
               $html = '';
                return $html;
            default:
        }
    }
    
    
    /**
     * FUNCION: formDatos
     * 
     * INPUTS: -
     * 
     * OUTPUTS: $html (string)
     * 
     * DESCRIPCION: Genera el formulario para la página
     * 
     * NOTAS: Generico
     */
    function formDatos(){
        $con = new MiespacioModel();
        $html = "<div id='cuerpo' class='container'>
            <div class='datos'>
                <h3>Datos personales</h3>
                <div class='form-group'>
                    <label class='form-label'>Nombre</label>
                    <input type='text' id='nombre' class='form-control' value=''>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Apellidos</label>
                    <input type='text' id='apellidos' class='form-control' value=''>
                </div>
                <div class='form-group'>
                    <label class='form-label'>E-mail</label>
                    <input type='text' id='email' class='form-control' value=''>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Telefono</label>
                    <input type='text' id='telefono' class='form-control' value=''>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Horario</label>
                    <select id='horario' class='form-control'>
                        <option value='diurno'>Diurno</option>
                        <option value='nocturno'>Nocturno</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Saludo</label>
                    <input type='text' id='saludo' class='form-control' value='ESTO CAMBIA SEGUN EL USUARIO, PILLALO DE LA BBDD'>
                </div>
            </div>
         
            <div class='datos'>
                <h3>Pasajero</h3>
                <div class='form-group'>
                    <label class='form-label'>Origen</label>
                    <select id='origen' class='form-control'>
                        ".$con->localidadesUsuarios()."
                    </select>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Centro de estudios</label>
                    <select id='destino' class='form-control'>
                        
                    </select>
                </div>
            </div>
            <div class='datos'>
                <h3>Conductor (SOLO se muestra si los es)</h3>
                <div class='form-group'>
                    <label class='form-label'>Tipo de permiso</label>
                    <select id='tipoPermiso' class='form-control'>
                        <option value='B'>B</option>
                        <option value='A1'>A1</option>
                        <option value='A2'>A2</option>
                        <option value='A'>A</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Tipo de vehiculo</label>
                    <select id='tipoVehiculo' class='form-control'>
                        <option value='coche'>Coche</option>
                        <option value='moto'>Moto</option>
                        <option value='ciclomotor'>Ciclomotor</option>
                        <option value='scooter'>Scooter</option>
                        <option value='furgoneta'>Furgoneta</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Matricula</label>
                    <input type='text' id='matricula' class='form-control' value='ESTO CAMBIA SEGUN EL USUARIO, PILLALO DE LA BBDD'>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Descripción</label>
                    <input type='text' id='descripción' class='form-control' value='ESTO CAMBIA SEGUN EL USUARIO, PILLALO DE LA BBDD'>
                </div>
            </div>
            
            <button id='Guardar cambios' class='btn btn-success'>Guardar cambios</button>
            ";
        
        
        return $html;
    }
    
}