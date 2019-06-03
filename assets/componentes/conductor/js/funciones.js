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
    sessionStorage.setItem("idAnuncio", jQuery(this).attr('id'));
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'formEditarAnuncio',
            idAnuncio: jQuery(this).attr('id')
        }
    };

//    alert(opciones['data']['idAnuncio']);
    jQuery.ajax(opciones)
            .done(function (responseText) {
                jQuery('#cuerpo').html(responseText);
                jQuery('#btnEditar').click(editarAnuncio);
//                jQuery('#destino').change(recargarDestinos);
            }).fail(function () {
        alert("ERRRROOOOOR");
    });


}


/**
 * FUNCION: editarAnuncio
 * 
 * INPUTS: $idAnuncio
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Coge los nuevos datos del formulario y actualiza el registro correspondiente en la bbdd
 * 
 * NOTAS:
 */
function editarAnuncio() {
    console.log("EDITAR ANUNCIO");
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'editarAnuncio',
            idAnuncio: sessionStorage.getItem("idAnuncio"),
            datos: {
                
                salida: jQuery('#salida').val(),
                destino: jQuery('#destino').val(),
                centro: jQuery('#centro').val(),
                horario: jQuery('#horario').val(),
                periodo: jQuery('#periodo').val(),
                plazas: jQuery('#plazas').val(),
                precio: jQuery('#precio').val()
            }
        }
    };
    
    jQuery.ajax(opciones).done(function(responseText){
       // header("Location: conductor.php?sec=misanuncios&stat=success");
       $(location).attr('href', "conductor.php?sec=misanuncios&stat=success");
       alert(responseText);
    }).fail(function(){
        //header("Location: conductor.php?sec=misanuncios&stat=fail");
        $(location).attr('href', "conductor.php?sec=misanuncios&stat=fail");
        alert(responseText);
    });
    
}


function recargarDestinos(){
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'recargarCentros',
            idLocalidad: jQuery('#destino').val()
            
        }
    };
    
     jQuery.ajax(opciones).done(function(responseText){
        jQuery('#destino').html(responseText);
       alert(responseText);
    });
}