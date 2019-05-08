/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//RESVISA COMO SE HACIA LO DE AJAX!!!!!!!!!!!

var flagDNI = false;
var flagTel = false;

$(document).ready(init);

function init(){
    jQuery('#dni').blur(validaDNI); 
    jQuery('#telefono').blur(validaTelefono); 
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
            alert('Dni erroneo, la letra del NIF no se corresponde'); //Esto igual lo puedes cambiar por un texto o asi, mejor un alert
        } else{
            flagDNI = true;
            
        }
    } else {
        alert('Dni erroneo, formato no válido');
        flagDNI = false;
    }
    todoComprobado();
}

function validaTelefono(){
    var exp = /^[6,9][0-9]{8}$/;
    
    if(exp.test(jQuery("#telefono").val())){
        flagTel = true;
        
    }else{
        alert('Formato del telefono no es valido');
        flagTel = false;
    }
    
    todoComprobado();
    
}

function todoComprobado(){
    if(flagDNI && flagTel){
        jQuery('#siguiente').removeAttr('disabled');
    }else{
        jQuery('#siguiente').attr('disabled', 'disabled');
    }
}