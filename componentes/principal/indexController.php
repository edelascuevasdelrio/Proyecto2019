<?php

/**
 * Description of indexController
 *
 * @author Enrique de las Cuevas
 */
require_once './indexModel.php';

class indexController {

    //put your code here

    public function recibeDatos($proceso, $args) {
        $model = new indexModel();
        switch ($proceso) {
            case 'login':
                if ($model->login($args[0], $args[1])) {
                    session_start();
                    $_SESSION['logged'] = "yes";
                    header('Location: ../registro/registro.php');
                } else {
                    $_SESSION['logged'] = "no";
                }
                break;
                
            default:
                
                break;
        }
    }

}
