/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(init);


function init(){
    jQuery('#añadir').click(addAnuncio);
}


function addAnuncio(){
    
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'addAnuncio',
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
                    //////////////////////////////////////////////////////////
        });
    
}