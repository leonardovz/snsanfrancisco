<?php
session_start();
require_once 'config/config.php';
require_once 'config/funciones.php';
require_once 'config/ruta.php';
$conexion = conexion($bd_config);
$ruta = ruta();
if (!isset($conexion)) {
    // echo "error al conectar a la base de datos" .json_encode($bd_config);
    echo "Por el momento no se puede acceder a la plataforma";
    exit;
}



$rutas = (isset($_GET['ruta']) && !empty($_GET['ruta'])) ? explode("/", strtolower($_GET['ruta'])) : false; //validacion de la segmentacion

$UserLogin = ((isset($_SESSION['snsanfrancisco']['validacion'])) ? $_SESSION['snsanfrancisco'] : false); //Validacion de la sesion
if ($rutas) { //Ruta Vacia
    if ($rutas[0] == 'error') {
        if ((isset($rutas[1]) && !empty($rutas[1]))) {
            if ($rutas[1] == '400' || $rutas[1] == '401' || $rutas[1] == '403' || $rutas[1] == '404' || $rutas[1] == '500' || $rutas[1] == '503') {
                require_once 'views/error.php';
            } else {
                header('Location: ' . $ruta . 'error/404');
            }
        } else {
            header('Location: ' . $ruta . 'error/404');
        }
    }
    elseif ($rutas[0] == 'login') {
        if($UserLogin){
            header('Location: ' . $ruta . 'perfil');
        }else{
            require_once 'views/login.view.php';
        }
    }
    elseif ($rutas[0] == 'desarrollador') {
        require_once 'account/master.view.php';
    }
    elseif ($rutas[0] == 'registro') {
        require_once 'views/registro.view.php';
    }
    elseif ($rutas[0] == 'verificar' && !$UserLogin) {
        require_once 'views/verificacionMail.view.php';
    }
    elseif ($rutas[0] == 'blog') {
        if (isset($rutas[1]) && !empty($rutas[1])) {
            if ($rutas[1] == 'publicacion') {
                require_once 'views/vistaPublicacion.view.php';
            }
        } else {
            require_once 'views/blog.view.php';
        }
    }
    elseif ($rutas[0] == 'servicios') {
        require_once 'views/servicios.view.php';
    }
    elseif ($rutas[0] == 'planes') {
        if ((isset($rutas[1]) && !empty($rutas[1]))) {
            require_once 'views/planesRegistro.view.php';
        } else {
            require_once 'views/planes.view.php';
        }
    }
    elseif ($rutas[0] == 'perfil') {
        if($UserLogin){
            if((isset($rutas[1]) && !empty($rutas[1]))){
                if($rutas[1]=='config'){
                    require_once 'account/perfilEdit.view.php';
                }else{
                    header('Location: ' . $ruta . 'error/404');
                }
            }else{
                require_once 'account/perfil.view.php';
            }
        }else{
            header('Location: ' . $ruta . 'login');
        }
    }
    elseif ($rutas[0] == 'acercade') {
        require_once 'account/perfil.view.php';
    }
    else {
        header('Location: ' . $ruta . 'error/404');
    }
} else {
    require_once 'views/index.view.php';
}
