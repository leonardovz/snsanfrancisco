<?php
session_start();

require_once '../config/ruta.php';
require_once '../config/config.php';
require_once '../config/funciones.php';
require_once '../recursos/PHPMailer/src/PHPMailer.php';
require_once '../recursos/PHPMailer/src/SMTP.php';

$conexion = conexion($bd_config);

if ($conexion->connect_errno) {
    $respuesta = array(
        'respuesta' => 'error',
        'Texto' => 'Hay un problema al conectar con el servidor'
    );
    die(json_encode($respuesta));
}
$ruta = ruta(); //Usamos la ruta absoluta para no tener conflicto con las direcciones
$respuesta = ''; //almacena la respuesta que arrojara el servidor
if (!isset($_POST['opcion'])) {
    die();
}
$USERLOGIN = ((isset($_SESSION['snsanfrancisco']['validacion'])) ? $_SESSION['snsanfrancisco'] : false); //Validacion de la sesion
if (!$USERLOGIN ||  $USERLOGIN['rol'] != 1) {
    die(json_encode(array('respuesta' => 'error', 'Texto' => 'No puedes acceder al archivo',)));
}
switch ($_POST['opcion']) {
    case 'generarCodigo':
        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

        $idRango = isset($_POST['rango']) && !empty($_POST['rango']) ? $_POST['rango'] : false;
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false; //Obtener el id de el usuario de la Sesión activa

        if ($idUser && $USERLOGIN['rol'] == 1) {
            if ($idRango && $ADMINFUNC->verificarPaquete($idRango)) {
                $codigo = $ADMINFUNC->codigoUnico();
                $sql = "INSERT INTO codigos(codigo, idRango, idUser_Creador) VALUES ('$codigo',$idRango,$idUser)";

                if ($conexion->query($sql)) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'Texto' => 'Peticion Exito',
                        'codigo' => $codigo
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'Texto' => 'No fue posible el registro del código',
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'El paquete que has seleccionado no es correcto'
                );
            }
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'La peticion no esta realizada de manera correcta'
            );
        }
        die(json_encode($respuesta));
        break;
    case 'crearServicio':
        $nombre      = isset($_POST['nombre']) && !empty($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : false;
        $color       = isset($_POST['color']) && !empty($_POST['color']) ? htmlspecialchars($_POST['color']) : false;
        $icono       = isset($_POST['icono']) && !empty($_POST['icono']) ? htmlspecialchars($_POST['icono']) : false;
        $descripcion = isset($_POST['descripcion']) && !empty($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : false;
        if (!isset($_FILES['avatar']) || empty($_FILES['avatar'])) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'No se envio ningun archivo')));
        }


        $sql = "SELECT * FROM usuarios WHERE idUsuario = " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        $resultado = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
        if (!$USERLOGIN ||  !$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar")));
        } else if ($USERLOGIN['rol'] != 1) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "No tienes permisos para realizar la publicacion")));
        }


        $IMAGENPERFIL = $_FILES['avatar'];

        validarImagen($IMAGENPERFIL);
        $extFILE = explode("/", $_FILES['avatar']['type'])[1]; // PNJ JPJ lo lee del archivo tipo file que llega por post
        $idUser = rellenarCero($USERLOGIN['idUsuario']); //idUsuario y su Correspondiente Carpeta

        $directorio = '../galeria/sistema/servicios/';
        $imagen = limpiarEspacios(eliminar_simbolos($nombre)); //cacha el nombre y se lo asigna
        $imagen = str_replace(" ", "_", $nombre); //cacha el nombre y se lo asigna
        $imagen = $imagen . '.' . $extFILE;    //Nombre de la Imagen al servidor
        $source = $IMAGENPERFIL["tmp_name"];              //Obtenemos el nombre temporal del archivo
        // die(json_encode(array($_POST, $_FILES)));
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777) or die(json_encode(array('respuesta' => 'error', 'Texto' => "No se puede crear el directorio de extracción")));
        }

        $dir = opendir($directorio); //Abrimos el directorio de destino


        //Cambiar el nombre de la imagen en el servidor
        $sql = "INSERT INTO servicios(nombre, descripcion, imagen, color, icono) VALUES ('$nombre','$descripcion','$imagen','$color','$icono')";
        // $sql = "INSERT INTO publicacion (iduser, titulo, imagen, descripcion) VALUE ($idUser,'$titulo','$imagen','$descripcion')";
        $resultado = $conexion->query($sql);
        if (!$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al crear la publicación")));
        }

        $idPublicacion = $conexion->insert_id;
        //Fin cambio de nombre de la imagen en el servidor

        $movimiento = optimizar_imagen($source, $directorio . $imagen, 50); //Se encarga de comprimir la imagen y guardarla
        closedir($dir); //Cerramos el directorio de destino

        if ($movimiento) {
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => '¡Listo!',
                $source, $directorio . $imagen, 50, $IMAGENPERFIL
            );
            // $_SESSION['snsanfrancisco']['imagen'] = $imagen;
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No fue posible mover la imagen al sistema',
                $source, $directorio . $imagen, 50
            );
        }

        die(json_encode($respuesta));
        break;
    case 'eliminarCuenta':
        break;
}
