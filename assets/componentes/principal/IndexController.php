<?php

/**
 * Description of indexController
 *
 * @author Enrique de las Cuevas
 */
require_once './IndexModel.php';

class IndexController {

   
    /**
     * FUNCION: recibeDatos
     * 
     * INPUTS: $proceso(string)
     * 
     * OUTPUTS: $args (array)
     * 
     * DESCRIPCION: Se encarga de recibir tanto el procso a realizar como los argunmentos para los mismos y de llamar
     * a los metodos correspondientes
     * 
     * NOTAS:Añade una variable de sesion, 'logged' para que en caso de error, muestre una label
     */
    public function recibeDatos($proceso, $args) {
        $model = new IndexModel();
        switch ($proceso) {
            //Si el proceso es login
            case 'login':
                //Hacemos una llamada al metodo login del modelo. Este devuelve true si existe en la BBDD
                //un usuario con esas credenciales.
                $loged = $model->login($args[0], $args[1]);
                if ($loged === 'true') {
                    //En caso de que exista, iniciamos una sesión y pasamos a la siguiente página
                    session_start();
                    $_SESSION['logged'] = "yes";
                    $_SESSION['usuario'] = $args[0];

                    header('Location: ../pasajero/pasajero.php');
                    
                } else {
                    if($loged === "noactivo"){
                        $_SESSION['logged'] = "noactivo";
                    }else{
                        $_SESSION['logged'] = "no";
                    }
                    
                }
                break;
                
            default:
                
                break;
        }
    }

}
