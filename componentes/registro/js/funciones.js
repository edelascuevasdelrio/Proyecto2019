/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/////////////////////////////////////////////////////////////////
//                        VARIABLES                            //
/////////////////////////////////////////////////////////////////
var flagDNI;
var flagTel;
var flagNombre;
var flagApellidos;

//sessionStorage.get('Nombredelavariable') -> Te devuelve en tipo String el contenido (NULL si no existe)
//sessionStorage.set('Nombredelavariable', 'valor de la variable') -> Añade cosas
//AL SER DE SESSION, SE MANTENDRÁN HASTA QUE CERREMOS EL NAVEGADOR


//COMPROBAMOS SI EXISTEN LAS VARIABLES VARIABLES (SE HA PASADO POR CADA PARTE DEL PROCESO)

function revisaFlags() {
    console.warn("Compruebo flags...");
    flagDNI = sessionStorage.getItem('flagDNI');
    if (flagDNI === null) {
        flagDNI = false;
    } else {
        if (flagDNI === '1') {
            flagDNI = true;
        } else {
            flagDNI = false;
        }
    }

    flagTel = sessionStorage.getItem('flagTel');
    if (flagTel === null) {
        flagTel = false;
    } else {
        if (flagTel === '1') {
            flagTel = true;
        } else {
            flagTel = false;
        }
    }

    flagNombre = sessionStorage.getItem('flagNombre');
    if (flagNombre === null) {
        flagNombre = false;
    } else {
        if (flagNombre === '1') {
            flagNombre = true;
        } else {
            flagNombre = false;
        }
    }

    flagApellidos = sessionStorage.getItem('flagApellidos');
    if (flagApellidos === null) {
        flagApellidos = false;
    } else {
        if (flagApellidos === '1') {
            flagApellidos = true;
        } else {
            flagApellidos = false;
        }
    }
    
    console.log("Nombre: " + flagNombre);
    console.log("Apellidos: " + flagApellidos);
    console.log("Telefono: " + flagTel);
    console.log("DNI: " + flagDNI);
    console.log("Listo");
}

$(document).ready(init);

function init() {
    //Asignamos los eventos a los distintos componentes
    jQuery('#dni').blur(validaDNI);
    jQuery('#telefono').blur(validaTelefono);
    jQuery('#nombre').blur(validarNombre);
    jQuery('#apellidos').blur(validarApellidos);

    //ocultamos los dos mensajes de posibles errores
    jQuery('#telError').hide();
    jQuery('#dniError').hide();

    revisaFlags();

    todoComprobadoR_uno();
}


function validaDNI() {
    var numero;
    var letr;
    var letra;
    var expReg = /^\d{8}[a-zA-Z]$/;

    var dni = jQuery('#dni').val();
    if (expReg.test(dni) === true) {
        numero = dni.substr(0, dni.length - 1);
        letr = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra !== letr.toUpperCase()) {
            jQuery('#dniError').text('Dni erroneo, la letra del NIF no se corresponde');
            jQuery('#dniError').show();
            sessionStorage.setItem('flagDNI', 0);
            flagDNI = false;
        } else {
            jQuery('#dniError').hide();
            flagDNI = true;
            sessionStorage.setItem('flagDNI', 1);

        }
    } else {
        jQuery('#dniError').text('Dni erroneo, formato no válido');
        jQuery('#dniError').show();
        sessionStorage.setItem('flagDNI', 0);
        flagDNI = false;
    }
    
//    console.log("Nombre: " + flagNombre);
//    console.log("Apellidos: " + flagApellidos);
//    console.log("Telefono: " + flagTel);
//    console.log("DNI: " + flagDNI);


    todoComprobadoR_uno();
}

function validaTelefono() {
    var exp = /^[6,9][0-9]{8}$/;

    if (exp.test(jQuery("#telefono").val())) {
        jQuery('#telError').hide();
        sessionStorage.setItem('flagTel', 1);
        flagTel = true;

    } else {
        jQuery('#telError').show();
        sessionStorage.setItem('flagTel', 0);
        flagTel = false;
    }

    todoComprobadoR_uno();

}

function validarNombre() {
    if ($('#nombre').val() !== "") {
        sessionStorage.setItem('flagNombre', 1);
        flagNombre = true;
    } else {
        sessionStorage.setItem('flagNombre', 0);
        flagNombre = false;
    }
    todoComprobadoR_uno();
}

function validarApellidos() {
    if ($('#apellidos').val() !== "") {
        sessionStorage.setItem('flagApellidos', 1);
        flagApellidos = true;
    } else {
        sessionStorage.setItem('flagApellidos', 0);
        flagApellidos = false;
    }
    todoComprobadoR_uno();
}



function todoComprobadoR_uno() {
    console.warn("Comprobando R1.....");
    if (flagDNI && flagTel && flagNombre && flagApellidos) {
        jQuery('#siguienter1').removeAttr('disabled');
    } else {
        jQuery('#siguienter1').attr('disabled', 'disabled');
    }
    console.log("Listo");
//    console.log("Nombre: " + flagNombre);
//    console.log("Apellidos: " + flagApellidos);
//    console.log("Telefono: " + flagTel);
//    console.log("DNI: " + flagDNI);
}
function todoComprobadoR_dos() {
    if (flagDNI && flagTel && flagNombre && flagApellidos) {
        jQuery('#siguienter1').removeAttr('disabled');
    } else {
        jQuery('#siguienter1').attr('disabled', 'disabled');
    }

//    console.log("Nombre: " + flagNombre);
//    console.log("Apellidos: " + flagApellidos);
//    console.log("Telefono: " + flagTel);
//    console.log("DNI: " + flagDNI);
}

function todoComprobadoR_tres() {
    if (flagDNI && flagTel && flagNombre && flagApellidos) {
        jQuery('#siguienter1').removeAttr('disabled');
    } else {
        jQuery('#siguienter1').attr('disabled', 'disabled');
    }

//    console.log("Nombre: " + flagNombre);
//    console.log("Apellidos: " + flagApellidos);
//    console.log("Telefono: " + flagTel);
//    console.log("DNI: " + flagDNI);
}

function todoComprobadoR_cuatro() {
    if (flagDNI && flagTel && flagNombre && flagApellidos) {
        jQuery('#siguienter1').removeAttr('disabled');
    } else {
        jQuery('#siguienter1').attr('disabled', 'disabled');
    }

//    console.log("Nombre: " + flagNombre);
//    console.log("Apellidos: " + flagApellidos);
//    console.log("Telefono: " + flagTel);
//    console.log("DNI: " + flagDNI);
}

function todoComprobadoR_cinco() {
    
    if (flagDNI && flagTel && flagNombre && flagApellidos) {
        jQuery('#siguienter1').removeAttr('disabled');
    } else {
        jQuery('#siguienter1').attr('disabled', 'disabled');
    }

//    console.log("Nombre: " + flagNombre);
//    console.log("Apellidos: " + flagApellidos);
//    console.log("Telefono: " + flagTel);
//    console.log("DNI: " + flagDNI);
}