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
var flagFecha;
var flagDestino;
var flagMatricula;
var flagUsername;
var flagPass;
var flagPassR;
var flagEmail;




/**
 * FUNCION: revisaFlags
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Hace una revisión de las variables en sessionStorage con las que controlamos
 *              las validaciones en los formularios
 * 
 * NOTAS:
 * sessionStorage.get('Nombredelavariable') -> Te devuelve en tipo String el contenido (NULL si no existe)
 sessionStorage.set('Nombredelavariable', 'valor de la variable') -> Añade cosas
 AL SER DE SESSION, SE MANTENDRÁN HASTA QUE CERREMOS EL NAVEGADOR
 */
function revisaFlags() {
    //Hacemos una comprobación para saber si es la primera vez que accedemos,
    //por lo cual no tendriamos que cargar nada
    if (jQuery('#section').val() === 'r2' && sessionStorage.getItem('flagNombre') !== "1") {
        sessionStorage.clear();
        console.log("PRIMERA SECCION");
    } else {

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
        flagFecha = sessionStorage.getItem('flagFecha');
        if (flagFecha === null) {
            flagFecha = false;
        } else {
            if (flagFecha === '1') {
                flagFecha = true;
            } else {
                flagFecha = false;
            }
        }

        flagUsername = sessionStorage.getItem('flagUsername');
        if (flagUsername === null) {
            flagUsername = false;
        } else {
            if (flagUsername === '1') {
                flagUsername = true;
            } else {
                flagUsername = false;
            }
        }

        flagPass = sessionStorage.getItem('flagPassw');
        if (flagPass === null) {
            flagPass = false;
        } else {
            if (flagPass === '1') {
                flagPass = true;
            } else {
                flagPass = false;
            }
        }

        flagPassR = sessionStorage.getItem('flagPassR');
        if (flagPassR === null) {
            flagPassR = false;
        } else {
            if (flagPassR === '1') {
                flagPassR = true;
            } else {
                flagPassR = false;
            }
        }



        //PARA DEBUG
        console.log("Nombre: " + flagNombre);
        console.log("Apellidos: " + flagApellidos);
        console.log("Telefono: " + flagTel);
        console.log("DNI: " + flagDNI);
        console.log("Fecha: " + flagFecha);
        console.log("Listo");
    }
}


//Cuando el documento este cargado, llamamos al init
$(document).ready(init);

/**
 * FUNCION: init
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Se encarga de asignar metodos a distintos elementos e inicializar otros
 * 
 * NOTAS:
 */
function init() {
    //Asignamos los eventos a los distintos componentes
    jQuery('#volver').click(volver);
    jQuery('#dni').blur(validaFormatoDNI);
    jQuery('#telefono').blur(validaTelefono);
    jQuery('#nombre').blur(validarNombre);
    jQuery('#apellidos').blur(validarApellidos);
    jQuery('#fecha_nacimiento').change(validaFecha);

    jQuery('#anadir').click(anadeLocalidad);
    jQuery('#destino').change(cargaCentros);

    jQuery('#matricula').keyup(validaMatricula);
    jQuery('#matricula').blur(validaMatricula);


    jQuery('#username').change(validaUsername);
    jQuery('#passw').blur(validaPassword);
    jQuery('#passwR').blur(passworRepetida);
    jQuery('#email').blur(validaEmail);

    jQuery('#finalizar').click(limpiaSesion);

    //ocultamos los dos mensajes de posibles errores
    jQuery('#telError').hide();
    jQuery('#dniError').hide();
    jQuery('#matriculaError').hide();
    jQuery('#userError').hide();
    jQuery('#passError').hide();
    jQuery('#passwRerror').hide();
    jQuery('#emailError').hide();


    jQuery('#verPass').mousedown(verPass);
    jQuery('#verPass').mouseup(ocultarPass);

    
    revisaFlags();

    todoComprobadoR_uno();
}

/**
 * FUNCION: volver()
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Vuelve a la página principal
 * 
 * NOTAS: 
 */

function volver(){
    jQuery(location).attr("href", "../principal/princi.php");
}
/**
 * FUNCION: validaDNI
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida tanto que el DNI tenga el formato adecuado como que la letra sea la correcta.
 *              De manera adicional, comprueba que no exista un registro en la BBDD con ese DNI
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -El algoritmo:
 *          1º Separas la letra y el numero
 *          2º Divides el numero entre 23 y nos quedamos con el resto
 *          3º Comparamos si la letra que introducimos es igual a la que se encuentra dentro de un string,
 *             determinada por el resultado del paso 2
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */
function validaFormatoDNI() {
    var numero;
    var letr;
    var letra;
    var expReg = /^\d{8}[a-zA-Z]$/;

    var dni = jQuery('#dni').val();


    if (expReg.test(dni) === true) {
        //En caso de que COINCIDA con el formato
        console.log("BUEN FORMATO");
        numero = dni.substr(0, dni.length - 1);
        letr = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);

        if (letra !== letr.toUpperCase()) {
            //En caso de que NO COINCIDA con la letra que toca
            flagDNI = false;
            sessionStorage.setItem('flagDNI', 0);
            jQuery('#dniError').text('Dni erroneo, la letra del NIF no se corresponde');
            jQuery('#dniError').show();

        } else {
            console.error("BUENA LETRA");
            //Comprobamos que no esté en la BBDD
            isDNIinBBDD(dni);

        }
    } else {
        flagDNI = false;
        sessionStorage.setItem('flagDNI', 0);
        jQuery('#dniError').text('Dni erroneo, formato no válido');
        jQuery('#dniError').show();

        console.error("PONEMOS EL FALSE PORQUE MAL FORMATO");
    }
    todoComprobadoR_uno();

}

function isDNIinBBDD(dni) {
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: "compruebaDNI",
            datos: dni
        }
    };

    jQuery.ajax(opciones).done(function (responseText) {

        console.error("RESPONSETEXT: " + responseText);
        if (responseText === "0") {
            jQuery('#dniError').hide();
            sessionStorage.setItem('flagDNI', 1);
            flagDNI = true;

        } else {
            flagDNI = false;
            sessionStorage.setItem('flagDNI', 0);
            jQuery('#dniError').text('Ya existe un usuario en ese DNI');
            jQuery('#dniError').show();

        }
        todoComprobadoR_uno();
    });



}


///////////////////R1///////////////////

/**
 * FUNCION: validaTelefono
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que el teléfono tenga el formato correcto
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Comprueba que el numero comience por 6 o 9, y que su longitud total sean unicamente 9 números
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */
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

/**
 * FUNCION: validaNombre
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que el nombre no esté vacío
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos  
 */
function validarNombre() {
    var nombre = jQuery('#nombre').val();
    if (nombre !== "" && /[A-Z a-z]+/.test(nombre)) {
        sessionStorage.setItem('flagNombre', 1);
        flagNombre = true;
    } else {
        sessionStorage.setItem('flagNombre', 0);
        flagNombre = false;
    }
    todoComprobadoR_uno();
}

/**
 * FUNCION: validarApellidos
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que los apellidos no estén vacíos
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos  
 */
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

/**
 * FUNCION: validaFecha
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que la fecha no esté vacía
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos  
 */
function validaFecha() {
    if ($('#fecha_nacimiento').val() !== "") {
        sessionStorage.setItem('flagFecha', 1);
        flagFecha = true;
    } else {
        sessionStorage.setItem('flagFecha', 0);
        flagFecha = false;
    }
    todoComprobadoR_uno();
}

/**
 * FUNCION: validaDestino
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que se ha escogido una de las opciones con value del selector
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos  
 */
function validaDestino() {
//    console.log("validaDestino ==> validando");

    if (jQuery('#destino').val() !== "") {
        sessionStorage.setItem('flagDestino', 1);
        flagDestino = true;
    } else {
        sessionStorage.setItem('flagDestino', 0);
        flagDestino = false;
    }

    console.log(flagDestino);
    todoComprobadoR_tres();
}

/**
 * FUNCION: anadeLocalidad
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Hace una peticion ajax para añadir una nueva localidad a la BBDD
 * y acutaliza el desplegable
 * 
 */
function anadeLocalidad() {
    //Mandamos como parametros el proceso que queremos ejecutar, y el texto del input "nombre_localidad"
    jQuery.post("ajax/funciones.php", {proceso: 'anadeLocalidad', localidad: jQuery('#nombre_localidad').val()}, function (respuesta) {
        //SUCCESS: Modificamos el HTML del select para actualizarlo
        jQuery('#localidad').html();

        jQuery.post("ajax/funciones.php", {proceso: 'actualizaLocalidades'}, function (respuesta2) {
            jQuery('#localidad').html(respuesta2);
        });

        //Cerramos la ventana modal
        jQuery('#añadir').modal('toggle');
    });
}

/**
 * FUNCION: cargaCentros
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Hace una peticion ajax para cargar un desplegable en función de la licalidad seleccionada
 */
function cargaCentros() {
    //Hacemos una petición ajax para recibir un listado de los centros asociados a una localidad
    jQuery.post("ajax/funciones.php", {proceso: 'cargaCentros', localidad: jQuery('#destino').val()}, function (respuesta) {
        //Cargamos el selector con los datos
        jQuery('#destinoCentro').html(respuesta);

    });

    //Comprobamos que el destino es correcto
    validaDestino();
    //Hacemos la comprobación final para poder siguir con el formulario
    todoComprobadoR_tres();
}

///////////////////R4///////////////////

/**
 * FUNCION: validaMatricula
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que la matricula tenga el formato correcto
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Comprueba que comience por 4 numero y siga de 3 letras, excluyendo las vocales, la Ñ y la Q
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */
function validaMatricula() {
    var expFormato = /^[0-9]{4}[A-Z]{3}$/;
    var expLetras = /^[^AEIOUQÑ]{3}$/;

    var matricula = jQuery('#matricula').val();

    //Primero comprobamos el formato
    if (expFormato.test(matricula)) {
        //SI coincide el formato, comprobamos las letras
        console.log("FORMATO MATRICULA OK");
        if (expLetras.test(matricula.substr(-3))) {
            //SI coinciden, miramos que no esté ya incluida en la BBDD
            console.log("LETRAS MATRICULA OK");
            isMatriculainBBDD(matricula);

        } else {
            //si las letras NO son correctas
            jQuery('#matriculaError').html("No se admiten vocales, Ñ o Q en las letras");
            jQuery('#matriculaError').show();
        }
    } else {
        //si NO cumple el formato
        jQuery('#matriculaError').html("No cumple con el formato (0000BBB)");
        jQuery('#matriculaError').show();

        flagMatricula = false;
        sessionStorage.setItem('flagMatricula', 0);
    }

    todoComprobadoR_cuatro();

}

function isMatriculainBBDD(matricula) {
    var opciones = {
        url: 'ajax/funciones.php',
        type: "POST",
        data: {
            proceso: 'buscaMatricula',
            matricula: matricula
        }

    };

    jQuery.ajax(opciones)
            .done(function (responseText) {

                if (responseText === "0") {
                    //NO hay repetidos
                    jQuery('#matriculaError').hide();
                    flagMatricula = true;
                    sessionStorage.setItem('flagMatricula', 1);
                    todoComprobadoR_cuatro();
                } else {
                    //HAY repetidos
                    jQuery('#matriculaError').html("La matricula ya está registrada");
                    jQuery('#matriculaError').show();
                    flagMatricula = false;
                    sessionStorage.setItem('flagMatricula', 0);
                }
            });

}

///////////////////R5///////////////////

/**
 * FUNCION: validaUsername
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que el username NO esté ya registrado
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */

function validaUsername() {
    var username = jQuery("#username").val();

    isUsernameInBBDD(username);

    todoComprobadoR_cinco();
}

function isUsernameInBBDD(username) {
    var opciones = {
        url: "ajax/funciones.php",
        type: "POST",
        data: {
            proceso: 'buscaUsername',
            nombre: username
        }
    };

    jQuery.ajax(opciones)
            .done(function (responseText) {
                if (responseText !== "0") {
                    jQuery('#userError').html("Nombre de usuario en uso");
                    jQuery('#userError').show();

                    flagUsername = false;
                    sessionStorage.setItem("flagUsername", "0");
                } else {
                    jQuery('#userError').hide();

                    flagUsername = true;
                    sessionStorage.setItem("flagUsername", "1");
                }
                todoComprobadoR_cinco();
            });
    
            

}

/**
 * FUNCION: validaPassword
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que la contraseña cumpla unos mínimos
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Comprobaremos que incluye:
 *              -Una mayuscula
 *              -Una minúscula
 *              -Un número
 *              -Un caracter especial entre * . y _
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */
function validaPassword() {
    var expMayusc = /[A-Z]+/;
    var expMinus = /[a-z]+/;
    var expNums = /[0-9]+/;
    var expEsp = /[.*_]+/;

    var contra = jQuery('#passw').val();

    if (!expMayusc.test(contra)) {
        jQuery('#passError').html("La contraseña debe incluir al menos una mayuscula, una minúscula, un número y un '.', '_' o '*'");
        jQuery('#passError').show();
        flagPass = false;
        sessionStorage.setItem("flagPass", "0");
    } else {
        if (!expMinus.test(contra)) {
            jQuery('#passError').html("La contraseña debe incluir al menos una mayuscula, una minúscula, un número y uno de los siguientes: '.', '_' '*'");
            jQuery('#passError').show();
            flagPass = false;
            sessionStorage.setItem("flagPass", "0");
        } else {
            if (!expNums.test(contra)) {
                jQuery('#passError').html("La contraseña debe incluir al menos una mayuscula, una minúscula, un número y un '.', '_' o '*'");
                jQuery('#passError').show();
                flagPass = false;
                sessionStorage.setItem("flagPass", "0");
            } else {
                if (!expEsp.test(contra)) {
                    jQuery('#passError').html("La contraseña debe incluir al menos una mayuscula, una minúscula, un número y un '.', '_' o '*'");
                    jQuery('#passError').show();
                    flagPass = false;
                    sessionStorage.setItem("flagPass", "0");
                } else {
                    flagPass = true;
                    sessionStorage.setItem("flagPass", "1");
                    jQuery('#passError').hide();
                }
            }
        }
    }

    todoComprobadoR_cinco();
}

/**
 * FUNCION: passwordRepetida
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que las contraseñas sean identicas
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */
function passworRepetida() {
    var pass = jQuery('#passw').val();
    var passR = jQuery('#passwR').val();

    if (pass === passR) {
        flagPassR = true;
        sessionStorage.setItem("flagPassR", "1");
        jQuery('#passwRerror').hide();
    } else {
        flagPassR = false;
        sessionStorage.setItem("flagPassR", "0");

        jQuery('#passwRerror').html("Las contraseñas no coinciden!");
        jQuery('#passwRerror').show();
    }
    todoComprobadoR_cinco();
}

/**
 * FUNCION: validaEmail
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Valida que el email con una expresión rgular
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */
function validaEmail() {
    var expReg = /^[-._º\w]+@[a-z]+\.[a-z]{2,3}$/;
    if (expReg.test(jQuery('#email').val())) {
        flagEmail = true;
        sessionStorage.setItem("flagEmail", "1");
        jQuery('#emailError').hide();
    } else {
        flagEmail = false;
        sessionStorage.setItem("flagEmail", "0");
        jQuery('#emailError').html("El email no es valido");
        jQuery('#emailError').show();
    }
    todoComprobadoR_cinco();
}

/**
 * FUNCION: verPass / ocultarPass
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Hace visible el campo de contraseña, o lo devuelve a puntos
 * 
 * NOTAS: -Los valores los recogemos mediante jQuery
 *        -Tras cada comprobación, se llama al metodo correspondiente para verificar si están todos los datos correctos
 */
function verPass() {
    jQuery('#passw').attr('type', 'text');
}
function ocultarPass() {
    jQuery('#passw').attr('type', 'password');
}

///////////////////COMPROBACIONES FINALES///////////////////
/**
 * FUNCION: todoComprobadoR_uno
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Comprueba los flags que corresponden con cada sección.
 *              Si están todos a true, activa el botón para pasar a la siguente sección. Si no, lo bloquea.
 */
function todoComprobadoR_uno() {
    console.warn("Comprobando R1.....");
    if (flagDNI && flagTel && flagNombre && flagApellidos && flagFecha) {
        jQuery('#siguienter1').removeAttr('disabled');
    } else {
        jQuery('#siguienter1').attr('disabled', 'disabled');
    }

//
//    console.warn("=====================================");
//    console.log(flagNombre);
//    console.log(flagApellidos);
//    console.log(flagDNI);
//    console.log(flagTel);
//    console.log(flagFecha);
//    console.warn("=====================================");


    console.warn("Listo");
}

/**
 * FUNCION: todoComprobadoR_uno
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Comprueba los flags que corresponden con cada sección.
 *              Si están todos a true, activa el botón para pasar a la siguente sección. Si no, lo bloquea.
 */
function todoComprobadoR_tres() {
    console.warn("Comprobando R3.....");

    if (jQuery('#destino').val() !== "") {
        jQuery('#siguienter3').removeAttr('disabled');

    } else {
        jQuery('#siguienter3').attr('disabled', 'disabled');
    }

    console.warn("Listo");
}


/**
 * FUNCION: todoComprobadoR_cuatro
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Comprueba los flags que corresponden con cada sección.
 *              Si están todos a true, activa el botón para pasar a la siguente sección. Si no, lo bloquea.
 */
function todoComprobadoR_cuatro() {
    console.warn("Comprobando R4.....");
    if (flagMatricula) {
        jQuery('#siguienter4').removeAttr('disabled');
    } else {
        jQuery('#siguienter4').attr('disabled', 'disabled');
    }

}

/**
 * FUNCION: todoComprobadoR_cinco
 * 
 * INPUTS: -
 * 
 * OUTPUTS: -
 * 
 * DESCRIPCION: Comprueba los flags que corresponden con cada sección.
 *              Si están todos a true, activa el botón para pasar a la siguente sección. Si no, lo bloquea.
 */
function todoComprobadoR_cinco() {
    console.log("Comprobando R5.....");
    if (flagUsername && flagPass && flagPassR && flagEmail) {
        jQuery('#finalizar').removeAttr('disabled');
    } else {
        jQuery('#finalizar').attr('disabled', 'disabled');
    }




}

function limpiaSesion() {
    sessionStorage.clear();
}