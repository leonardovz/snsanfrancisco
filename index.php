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
$ANALYTICS = true;
$ADSENSE = false;
$RECAPTCHA = true;
$PIXEL_FACEBOOK = true;

$rutas = (isset($_GET['ruta']) && !empty($_GET['ruta'])) ? explode("/", strtolower($_GET['ruta'])) : false; //validacion de la segmentacion
$RUTAS0 = (isset($rutas[0]) && !empty($rutas[0])) ? $rutas[0] : false; //validacion de la RUTA CERO
$RUTAS1 = (isset($rutas[1]) && !empty($rutas[1])) ? $rutas[1] : false; //validacion de la RUTA UNO
$RUTAS2 = (isset($rutas[2]) && !empty($rutas[2])) ? $rutas[2] : false; //validacion de la RUTA DOS
$RUTAS3 = (isset($rutas[3]) && !empty($rutas[3])) ? $rutas[3] : false; //validacion de la RUTA TRES

$UserLogin = ((isset($_SESSION['snsanfrancisco']['validacion'])) ? $_SESSION['snsanfrancisco'] : false); //Validacion de la sesion
if ($rutas) { //Ruta Vacia
    if ($RUTAS0 == 'error') {
        if ($RUTAS1) {
            if ($RUTAS1 == '400' || $RUTAS1 == '401' || $RUTAS1 == '403' || $RUTAS1 == '404' || $RUTAS1 == '500' || $RUTAS1 == '503') {
                require_once 'views/error.php';
            } else {
                header('Location: ' . $ruta . 'error/404');
            }
        } else {
            header('Location: ' . $ruta . 'error/404');
        }
    } elseif ($RUTAS0 == 'login') {
        if ($UserLogin) {
            header('Location: ' . $ruta . 'perfil');
        } else {
            require_once 'views/login.view.php';
        }
    } elseif ($RUTAS0 == 'recuperarcuenta') {
        if ($UserLogin) {
            header('Location: ' . $ruta . 'perfil');
        } else {
            require_once 'views/recuperacion.view.php';
        }
    } elseif ($RUTAS0 == 'desarrollador') {
        require_once 'views/master.view.php';
    } elseif ($RUTAS0 == 'registro') {
        if ($UserLogin) {
            header('Location: ' . $ruta . 'perfil');
        } else {
            if ($RUTAS1 && (int) $RUTAS1 > 0) {
                $ADMIN = new AdminFunciones();
                $ADMIN->CONEXION = $conexion;
                $USUARIO = $ADMIN->encontrarUsuario((int) $RUTAS1);
                // var_dump($USUARIO);
                if ($USUARIO && $USUARIO['validar'] == 0) {
                    require_once 'views/registroAfter.view.php';
                } else {
                    header('Location: ' . $ruta . 'registro');
                }
            } else {
                require_once 'views/registro.view.php';
            }
        }
    } elseif ($RUTAS0 == 'verificar' && !$UserLogin) {
        require_once 'views/verificacionMail.view.php';
    } elseif ($RUTAS0 == 'blog') {
        if ($RUTAS1) {
            if ($RUTAS1 == 'publicacion' && $RUTAS2) {
                require_once 'views/vistaPublicacion.view.php';
            } else if ($RUTAS1 == 'busqueda' && $RUTAS2) {
                require_once 'views/blog.view.php';
            } else if ($RUTAS1 == 'post' && $RUTAS2) {
                require_once 'views/vistaPublicacion.view.php';
            } else {
                header('Location: ' . $ruta . 'error/404');
            }
        } else {
            require_once 'views/blog.view.php';
        }
    } elseif ($RUTAS0 == 'servicios') {
        if ($RUTAS1) {
            if ((int) $RUTAS1) {
                require_once 'views/serviciosBuscar.view.php';
            } else {
                header('Location: ' . $ruta . 'error/404');
            }
        } else {
            require_once 'views/servicios.view.php';
        }
    } elseif ($RUTAS0 == 'buscar') {
        if ($RUTAS1) {
            if ($RUTAS1) {
                require_once 'views/busqueda.view.php';
            } else {
                header('Location: ' . $ruta . 'error/404');
            }
        } else {
            header('Location: ' . $ruta . 'servicios');
        }
    } elseif ($RUTAS0 == 'planes') {
        if ($RUTAS1) {
            require_once 'views/planesRegistro.view.php';
        } else {
            require_once 'views/planes.view.php';
        }
    } elseif ($RUTAS0 == 'perfil') {
        $idUsuario = 0;
        if ($UserLogin) { //Por si acaso hay algun usuario Logueado
            $PIXEL_FACEBOOK = false;
            $idUsuario = $UserLogin['idUsuario'];
            if ($UserLogin['rol'] == 1) {
                // >> < Apartado para el administrador > << 
                $ANALYTICS = false;

                if ($RUTAS1) {
                    if ($RUTAS1 == 'config') {
                        require_once 'account/perfilEdit.view.php';
                    } elseif (is_numeric($RUTAS1)) {
                        $idUsuario = (int) $RUTAS1;
                        $PIXEL_FACEBOOK = true;
                        require_once 'views/perfilPublico.view.php';
                    } elseif ($RUTAS1 == 'servicios') {
                        require_once 'account/admin/servicios/servicios.php';
                    } elseif ($RUTAS1 == 'codigos') {
                        require_once 'account/admin/codigos/codigos.php';
                    } elseif ($RUTAS1 == 'publicaciones') {
                        require_once 'account/admin/publicaciones/publicacion.view.php';
                    } else {
                        header('Location: ' . $ruta . 'error/404');
                    }
                } else {
                    require_once 'account/perfil.view.php';
                }
                // >> < Apartado para el administrador > << 
            } elseif ($RUTAS1) {
                if ($RUTAS1 == 'config') {
                    require_once 'account/perfilEdit.view.php';
                } elseif (is_numeric($RUTAS1)) {
                    $idUsuario = (int) $RUTAS1;
                    require_once 'views/perfilPublico.view.php';
                } else {
                    header('Location: ' . $ruta . 'error/404');
                }
            } else {
                require_once 'account/perfil.view.php';
            }
        } else if ($RUTAS1) {
            if (is_numeric($RUTAS1)) {
                $idUsuario = (int) $RUTAS1;
                require_once 'views/perfilPublico.view.php';
            } else {
                header('Location: ' . $ruta . 'login');
            }
        } else {
            header('Location: ' . $ruta . 'login');
        }
    } elseif ($RUTAS0 == 'acercade') {
        require_once 'views/acercade.view.php';
    } elseif ($RUTAS0 == 'ayuda') {
        require_once 'views/ayuda.view.php';
    } elseif ($RUTAS0 == 'vercorreos') {
        require_once 'vercorreos.php';
    } else {
        header('Location: ' . $ruta . 'error/404');
    }
} else {
    require_once 'views/index.view.php';
}
