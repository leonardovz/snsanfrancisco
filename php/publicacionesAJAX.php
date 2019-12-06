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
    case 'traerServicios':

        $sql = "SELECT * FROM servicios";

        $resultado = $conexion->query($sql);

        $servicios = ($resultado && $resultado->num_rows) ? $resultado : false;
        if ($servicios) {
            $serviciosArray = [];
            while ($servicio = $servicios->fetch_assoc()) {
                $serviciosArray[] = $servicio;
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Se encontraron algunos servicios',
                'servicios' => $serviciosArray,
                'rutaImagen' => 'galeria/sistema/servicios/',
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'Ocurrio un error al realizar la consulta',
            );
        }
        die(json_encode($respuesta));
        break;
    case 'traerPerfiles':

        $sql = "SELECT U.idUsuario ,U.nombre,U.apellidos,U.correo,U.fecha,U.img, UI.nombreServicio, UI.celular,UI.telefono,UI.descripcion,UI.domicilio,UI.social,S.nombre AS servicio,S.color AS colorS, S.icono AS iconoS  FROM usuarios AS U, usersinfo AS UI,servicios AS S  WHERE U.idUsuario = UI.iduser AND S.id=UI.idServicio";

        $resultado = $conexion->query($sql);

        $perfiles = ($resultado && $resultado->num_rows) ? $resultado : false;
        if ($perfiles) {
            $perfilesArray = [];
            while ($servicio = $perfiles->fetch_assoc()) {
                $perfilesArray[] = $servicio;
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Se encontraron algunos perfiles',
                'perfiles' => $perfilesArray,
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'Ocurrio un error al realizar la consulta',
            );
        }
        die(json_encode($respuesta));
        break;
    default:
        break;
}
