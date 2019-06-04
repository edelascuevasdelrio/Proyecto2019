/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(init);


function init(){
    jQuery('#btnanadir').click(addAnuncio);
    jQuery('tr').click(clickFila);

}

    /**
     * FUNCION: addAnuncio
     * 
     * INPUTS: -
     * 
     * OUTPUTS: -
     * 
     * DESCRIPCION: Hace una peticion AJAX para insertar un nuevo anuncio.
     * 
     * NOTAS: SOLO incluye los datos básicos, los insert completos, estan en el componente de Conductor
     */
function addAnuncio(){
    

    
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'addAnuncio',
            idUsuario: jQuery('#idUsuario').val(),
            localidadSalida: jQuery('#localidadSalida').val(),
            localidadDestino: jQuery('#localidadDestino').val(),
            horario: jQuery('#horario').val(),
            periodo: jQuery('#periodo').val(),
            plazas: jQuery('#plazas').val(),
            precio: jQuery('#precio').val()
        }
        };
        
        jQuery.ajax(opciones)
                .done(function (responseText){
                   //alert(responseText);
                   location.reload(true);
        });
    
}

    /**
     * FUNCION: clickFila
     * 
     * INPUTS: -
     * 
     * OUTPUTS: -
     * 
     * DESCRIPCION: Recoge la fila y hace una petición de los datos relacionados
     * 
     * NOTAS: 
     */
function clickFila(){
    //console.log("CLICK FILA");
    //location.href = "../conductor/conductor.php?id=" + jQuery(this).attr('id');
    //alert(jQuery(this).attr('id'));

    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'cargaDetalle',
            idAnuncio: jQuery(this).attr('id')
        }
        };
        
        jQuery.ajax(opciones)
                .done(function (responseText){
                   
                    jQuery('#cuerpo').html(responseText);
        });
    

}