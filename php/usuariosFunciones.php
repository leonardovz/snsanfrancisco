<?php
session_start();

require_once '../config/ruta.php';
require_once '../config/config.php';
require_once '../config/funciones.php';
require_once '../recursos/PHPMailer/PHPMailerAutoload.php';


$conexion = conexion($bd_config);

if ($conexion->connect_errno) {
    $respuesta = array(
        'respuesta' => 'error',
        'Texto' => 'Hay un problema al conectar con el servidor'
    );
    die(json_encode($respuesta));
}
// $_POST['opcion']="cargarNotas";
// $tipoUsuario = $_SESSION['tipoUser']; //Verificacion de el tipo de usuario, Solo admin puede crear ADMIN y Vendedor.
// $idUsuario = $_SESSION['idUsuario']; //Verificacion de el tipo de usuario, Solo admin puede crear ADMIN y Vendedor.
$ruta = ruta(); //Usamos la ruta absoluta para no tener conflicto con las direcciones
$respuesta = ''; //almacena la respuesta que arrojara el servidor
if (!isset($_POST['opcion'])) {
    die();
}
$USERLOGIN = ((isset($_SESSION['snsanfrancisco']['validacion'])) ? $_SESSION['snsanfrancisco'] : false); //Validacion de la sesion

switch ($_POST['opcion']) {
    case 'modificarFotoPerfil':
        if (!isset($_FILES['avatar']) || empty($_FILES['avatar'])) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'No se envio ningun archivo')));
        }

        //Validacion para verificar que el usuario exista
        $sql = "SELECT * FROM usuarios WHERE idUsuario = " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        $resultado = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
        if (!$USERLOGIN ||  !$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar")));
        }


        $IMAGENPERFIL = $_FILES['avatar'];

        validarImagen($IMAGENPERFIL);

        $idUser = rellenarCero($USERLOGIN['idUsuario']); //idUsuario y su Correspondiente Carpeta

        $directorio = '../galeria/usuario/' . $idUser . '/';

        $imagen = "perfil_" . time() . "_" . $idUser . '.jpg';    //Nombre de la Imagen al servidor
        $source = $IMAGENPERFIL["tmp_name"];              //Obtenemos el nombre temporal del archivo

        if (!file_exists($directorio)) {
            mkdir($directorio, 0777) or die(json_encode(array('respuesta' => 'error', 'Texto' => "No se puede crear el directorio de extracción")));
        }

        $dir = opendir($directorio); //Abrimos el directorio de destino


        //Cambiar el nombre de la imagen en el servidor

        $sql = "UPDATE usuarios SET img = '$imagen' WHERE idUsuario = " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        if (!$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar")));
        }

        //Fin cambio de nombre de la imagen en el servidor

        $movimiento = optimizar_imagen($source, $directorio . $imagen, 60); //Se encarga de comprimir la imagen y guardarla

        closedir($dir); //Cerramos el directorio de destino

        if ($movimiento) {
            $respuesta = array(
                'respuesta' => 'exito',
                'texto' => 'Imagen modificada',
            );
            $_SESSION['snsanfrancisco']['imagen'] = $imagen;
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'texto' => 'No fue posible mover la imagen al sistema',
            );
        }

        die(json_encode($respuesta));
        break;
    case 'crearPublicacion':
    die(json_encode(array($_POST,$_FILES)));
        if (!isset($_FILES['avatar']) || empty($_FILES['avatar'])) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'No se envio ningun archivo')));
        }

        
        $sql = "SELECT * FROM usuarios WHERE idUsuario = " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        $resultado = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
        if (!$USERLOGIN ||  !$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar")));
        }


        $IMAGENPERFIL = $_FILES['avatar'];

        validarImagen($IMAGENPERFIL);

        $idUser = rellenarCero($USERLOGIN['idUsuario']); //idUsuario y su Correspondiente Carpeta

        $directorio = '../galeria/usuario/' . $idUser . '/';

        $imagen = "post_" . time() . "_" . $idUser . '.jpg';    //Nombre de la Imagen al servidor
        $source = $IMAGENPERFIL["tmp_name"];              //Obtenemos el nombre temporal del archivo

        if (!file_exists($directorio)) {
            mkdir($directorio, 0777) or die(json_encode(array('respuesta' => 'error', 'Texto' => "No se puede crear el directorio de extracción")));
        }

        $dir = opendir($directorio); //Abrimos el directorio de destino


        //Cambiar el nombre de la imagen en el servidor

        // $sql = "UPDATE usuarios SET img = '$imagen' WHERE idUsuario = " . $USERLOGIN['idUsuario'];
        // $resultado = $conexion->query($sql);
        // if (!$resultado) {
        //     die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar")));
        // }

        //Fin cambio de nombre de la imagen en el servidor

        $movimiento = optimizar_imagen($source, $directorio . $imagen, 60); //Se encarga de comprimir la imagen y guardarla

        closedir($dir); //Cerramos el directorio de destino

        if ($movimiento) {
            $respuesta = array(
                'respuesta' => 'exito',
                'texto' => 'Imagen modificada',
            );
            // $_SESSION['snsanfrancisco']['imagen'] = $imagen;
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'texto' => 'No fue posible mover la imagen al sistema',
            );
        }

        die(json_encode($respuesta));
        break;
    default:
        break;
}
