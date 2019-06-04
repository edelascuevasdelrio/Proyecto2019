/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(init);


function init() {
    jQuery('#menuSuperior').append("<li><a id='nuevoAnuncio' href='#'>Publicar anuncio completo</a></li>");
     jQuery('#nuevoAnuncio').click(nuevoAnuncio);
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
                jQuery('#btnCancelar').click(cancelarEdicion);
                jQuery('#destino').change(recargarDestinos);
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

    jQuery.ajax(opciones).done(function (responseText) {

        $(location).attr('href', "conductor.php?sec=misanuncios&stat=success");
        alert("Anuncio editado");
//        alert(responseText);
    }).fail(function (responseText) {

        $(location).attr('href', "conductor.php?sec=misanuncios&stat=fail");
        alert(responseText);
    });

}


function recargarDestinos() {
    console.log("RECARGAR DESTINOS");
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'recargarCentros',
            idLocalidad: jQuery('#destino').val()

        }
    };

    jQuery.ajax(opciones).done(function (responseText) {
        jQuery('#centro').html(responseText);

    });
}

function cancelarEdicion() {

    $(location).attr('href', "conductor.php?sec=misanuncios");

}

function insentarAnuncio(){
    console.log("INSENTAR ANUNCIO");
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'insentarAnuncio',
            
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

    jQuery.ajax(opciones).done(function (responseText) {

        $(location).attr('href', "conductor.php?sec=misanuncios&stat=success");
        alert("Anuncio insertado");
        alert(responseText);
    }).fail(function (responseText) {

        $(location).attr('href', "conductor.php?sec=misanuncios&stat=fail");
        alert(responseText);
    });
}


function nuevoAnuncio(){
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'nuevoAnuncio'
        }
    };

    jQuery.ajax(opciones).done(function (responseText) {
        jQuery('#cuerpo').html(responseText);
        jQuery('#btnEditar').click(insentarAnuncio);
        jQuery('#btnCancelar').click(cancelarEdicion);
        jQuery('#destino').change(recargarDestinos);
    });
}

