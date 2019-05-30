/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(init);


function init() {
    console.log("INIT DESDE CONDUCTOR");
    jQuery('tr').click(clickFila);
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
function clickFila() {
    console.log("click en la fila");
    //location.href = "../conductor/conductor.php?id=" + jQuery(this).attr('id');
    //alert(jQuery(this).attr('id'));

    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'editaAnuncio',
            idAnuncio: jQuery(this).attr('id')
        }
    };
    
//    alert(opciones['data']['idAnuncio']);
    jQuery.ajax(opciones)
            .done(function (responseText) {
                console.log(responseText);
                jQuery('#cuerpo').html(responseText);
            }).fail(function () {
        alert("ERRRROOOOOR");
    });


}

/**
 * FUNCION: editarAnuncio
 * 
 * INPUTS: $idAnuncio)
 * 
 * OUTPUTS: $salida (string)
 * 
 * DESCRIPCION: Hace una peticion para recibir un HTML con los datos
 * 
 * NOTAS:
 */
function editarAnuncio() {
    console.log("EDITAR ANUNCIO");
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'editaAnuncio',
            idAnuncio: jQuery(this).attr('id')
        }
    };

    jQuery.ajax(opciones)
            .done(function (responseText) {
                
                jQuery('#cuerpo').html(responseText);
            }).fail(function () {
        alert("ERRRROOOOOR");
    });


}
    