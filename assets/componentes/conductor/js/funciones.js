/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(init);


function init(){
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
function clickFila(){

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
