/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(init);

function init() {
    console.log("INIT MIESPACIO");
    cargaDatos();

}

function cargaDatos() {
    console.log("CARGADATOS!");
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: "buscaDatos"
        }
    };

    jQuery.ajax(opciones).done(function (responseText) {

        var respuesta = JSON.parse(responseText);
        console.warn(respuesta); //BORRAR

       jQuery("#destino").html(respuesta['htmlCentro'])

        jQuery('#nombre').val(respuesta['nombre']);
        jQuery('#apellidos').val(respuesta['apellidos']);
        jQuery('#email').val(respuesta['email']);
        jQuery('#telefono').val(respuesta['telefono']);
        jQuery('#saludo').val(respuesta['saludo']);
        jQuery('#matricula').val(respuesta['matricula']);
        jQuery('#descripción').val(respuesta['descripción']);

        //Cogemos todos los "option" que corresponden al desplegable                     
        var opcionesVehiculo = jQuery("#horario option").get();
        //repasamos todos, y si el value de alguno coincide con los datos obtenidos
        //de la BBDD, le ponemos el atributo seleccionado
        for (var item in opcionesVehiculo) {
            if (jQuery(opcionesVehiculo[item]).val() === respuesta['horario']) {
                jQuery(opcionesVehiculo[item]).attr("selected", "selected");
            }
        }
        
        
        //ORIGEN
        //Cogemos todos los "option" que corresponden al desplegable                     
        var opcionesVehiculo = jQuery("#origen option").get();
        //repasamos todos, y si el value de alguno coincide con los datos obtenidos
        //de la BBDD, le ponemos el atributo seleccionado
        for (var item in opcionesVehiculo) {
            
            if (jQuery(opcionesVehiculo[item]).val() === respuesta['localidad']) {
      
                jQuery(opcionesVehiculo[item]).attr("selected", "selected");
            }
        }

        jQuery('#origen').val(respuesta['salida']);//OPTIONs TURBIO
        
        
        
        //DESTINO
        //Cogemos todos los "option" que corresponden al desplegable                     
        var opcionesVehiculo = jQuery("#destino option").get();
        //repasamos todos, y si el value de alguno coincide con los datos obtenidos
        //de la BBDD, le ponemos el atributo seleccionado
        for (var item in opcionesVehiculo) {
            if (jQuery(opcionesVehiculo[item]).val() === respuesta['destino']) {
                jQuery(opcionesVehiculo[item]).attr("selected", "selected");
            }
        }
        jQuery('#destino').val(respuesta['destino']);
        jQuery('#permiso').val(respuesta['tipo_permiso']);









        //Cogemos todos los "option" que corresponden al desplegable                     
        var opcionesVehiculo = jQuery("#tipoVehiculo option").get();
        //repasamos todos, y si el value de alguno coincide con los datos obtenidos
        //de la BBDD, le ponemos el atributo seleccionado
        for (var item in opcionesVehiculo) {
            if (jQuery(opcionesVehiculo[item]).val() === respuesta['tipo']) {
                jQuery(opcionesVehiculo[item]).attr("selected", "selected");
            }
        }




    });
}
