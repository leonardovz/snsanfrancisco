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
    case 'traerPostsPublicos':
        // $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        // $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;
        // if ($idUser) {
        $sql = "SELECT P.*,U.nombre,U.apellidos, U.img FROM publicacion AS P ,usuarios as U WHERE P.iduser = U.idUsuario ORDER BY P.fecha DESC ";
        $resultado = $conexion->query($sql);
        $resultado = ($resultado  && $resultado->num_rows) ? $resultado : false;
        if ($resultado) {
            $directorio = 'galeria/usuario/';
            $publicaciones = [];
            while ($publicacion = $resultado->fetch_assoc()) {
                $publicaciones[] = $publicacion;
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Aquí te envio algunas de las publicaciones',
                'publicaciones' => $publicaciones,
                'rutaImagen' => $directorio,
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No cuenta con publicaciones',
                'POST' => $_POST,
            );
        }
        // } else {
        //     $respuesta = array(
        //         'respuesta' => 'error',
        //         'Texto' => 'El usuario seleccionado o perfil es incorrecto',
        //         'POST' => $_POST,
        //     );
        // }
        die(json_encode($respuesta));

        break;

    case 'enviarCorreoContacto':
        $correo       = isset($_POST['correo']) && !empty($_POST['correo']) ? $_POST['correo'] : "";
        $nombre       = isset($_POST['nombre']) && !empty($_POST['nombre']) ? $_POST['nombre'] : "";
        $subscripcion = isset($_POST['subscripcion']) && !empty($_POST['subscripcion']) ? $_POST['subscripcion'] : 0;
        $tipo         = isset($_POST['tipo']) && !empty($_POST['tipo']) ? $_POST['tipo'] : "";
        $descripcion  = isset($_POST['descripcion']) && !empty($_POST['descripcion']) ? $_POST['descripcion'] : "";

        $sql = "INSERT INTO formularios(nombre, correo, descripcion, tipo, subscripcion) VALUES ('$nombre','$correo','$descripcion','$tipo',$subscripcion)";
        $resultado = $conexion->query($sql);
        if ($resultado) {
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'El formulario ha sido llenado de manera exitosa'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'Error al guardar el formulario'
            );
        }



        die(json_encode($respuesta));
        break;
    case 'traerPerfilPublico':
        $sql = "SELECT U.idUsuario ,U.nombre,U.apellidos,U.correo,U.fecha,U.img, UI.nombreServicio, UI.celular,UI.telefono,UI.descripcion,UI.domicilio,UI.whatsapp,S.nombre AS servicio,S.color AS colorS, S.icono AS iconoS  FROM usuarios AS U, usersinfo AS UI,servicios AS S  WHERE U.idUsuario = UI.iduser AND S.id=UI.idServicio ";
        $resultado = $conexion->query($sql);
        $usuarios = ($resultado  && $resultado->num_rows) ? $resultado : false;
        if ($usuarios) {
            $usersArray = [];
            while ($usuario = $usuarios->fetch_assoc()) {
                $directorio = 'galeria/usuario/' . rellenarCero($usuario['idUsuario']) . '/';

                $usersArray[] = array(
                    'usuario' => $usuario,
                    'directorio' => $directorio
                );
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Aquí te envio algunas de las publicaciones',
                'perfiles' => $usersArray,
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No cuenta con publicaciones',
                'POST' => $_POST,
            );
        }
        die(json_encode($respuesta));

        break;
    case 'traerPlanes':
        $sql = "SELECT * FROM rango WHERE tipo ='mensual' OR tipo= 'anual'";
        $resultado = $conexion->query($sql);
        $PAQUETES = ($resultado && $resultado->num_rows) ? $resultado : false;
        
        if($PAQUETES){
            $planesArray=[];
            while ($PAQUETE = $PAQUETES->fetch_assoc()) {
                $planesArray[] = array(
                    'plan'=>$PAQUETE,
                    'venefocios'=>'llorar'
                );
            }
            $respuesta = array(
                'respuesta'=>'exito',
                'Texto'=>'Planes encontrados',
                'planes'=>$planesArray
            );
        }else{
            $respuesta = array(
                'respuesta'=>'error',
                'Texto'=>'No se encontraron coincidencias',
                'planes'=>$planesArray
            );
        }
        die(json_encode($respuesta));


        break;
    default:
        break;
}
