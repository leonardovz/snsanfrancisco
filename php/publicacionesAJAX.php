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
    case 'crearPublicacion':
        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

        $titulo       = isset($_POST['titulo']) && !empty($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : false;
        $descripcion = isset($_POST['descripcion']) && !empty($_POST['descripcion']) ? ($_POST['descripcion']) : false;

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
        $IMAGENTYPE = explode(".", $IMAGENPERFIL['name']);
        $IMAGENTYPE = end($IMAGENTYPE);
        $IMAGENNAME = limpiarEnlaces(eliminar_simbolos($titulo));

        validarImagen($IMAGENPERFIL);

        $idUser = rellenarCero($USERLOGIN['idUsuario']); //idUsuario y su Correspondiente Carpeta

        $directorio = '../galeria/blog_post/';

        $imagen = strtolower($IMAGENNAME) . "_" . time() . '.' . $IMAGENTYPE;    //Nombre de la Imagen al servidor
        $source = $IMAGENPERFIL["tmp_name"];              //Obtenemos el nombre temporal del archivo
        // die(json_encode(array($_POST, $_FILES)));
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777) or die(json_encode(array('respuesta' => 'error', 'Texto' => "No se puede crear el directorio de extracción")));
        }

        $dir = opendir($directorio); //Abrimos el directorio de destino


        //Cambiar el nombre de la imagen en el servidor

        $stmt = $conexion->prepare("INSERT INTO blogposts (iduser, titulo, imagen, descripcion) VALUE (?, ?, ?, ?)");
        $stmt->bind_param('isss', $idUser, $titulo, $imagen, $descripcion);

        $resultado = $stmt->execute();
        if (!$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al crear la publicación")));
        }

        $idPublicacion = $conexion->insert_id;
        //Fin cambio de nombre de la imagen en el servidor

        $movimiento = optimizar_imagen($source, $directorio . $imagen, 92); //Se encarga de comprimir la imagen y guardarla

        closedir($dir); //Cerramos el directorio de destino

        if ($movimiento) {
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => '¡Listo!',
            );
            // $_SESSION['snsanfrancisco']['imagen'] = $imagen;
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No fue posible mover la imagen al sistema',
            );
        }

        die(json_encode($respuesta));
        break;
    case 'traerPostsPerfil':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;
        if ($idUser) {
            $limitUser = "AND B.iduser = " . $idUser;
        }
        $limitPostAc = " AND B.estado = 'AC' ";

        if ($USERLOGIN && $USERLOGIN['tipoUser'] == 1) {
            $limitPostAc = '';
        }
        $BUSQUEDA = isset($_POST['busqueda']) && !empty($_POST['busqueda']) ? htmlspecialchars($_POST['busqueda']) : "";
        //PAGINACION
        $PUBLICACION_PAGINA = 6;
        $PAGINA = isset($_POST['pagina']) && !empty($_POST['pagina']) ? (int) $_POST['pagina'] - 1 : 0;
        $PAGINA = $PAGINA * $PUBLICACION_PAGINA;
        if ($BUSQUEDA != "") {
            $BUSQUEDA = " AND (B.titulo LIKE '%$BUSQUEDA%' OR B.descripcion LIKE '%$BUSQUEDA%' OR concat_ws(' ', U.nombre,U.apellidos) LIKE '%$BUSQUEDA%') ";
        }
        $BUSQUEDA .= $limitPostAc;
        $PUBLICACIONES = new Publicaciones();
        $PUBLICACIONES->CONEXION = $conexion;
        //PAGINACION
        $directorio = 'galeria/blog_post/';

        $sql = "SELECT B.*,U.nombre,U.apellidos, U.img FROM blogposts AS B ,usuarios as U WHERE B.iduser = U.idUsuario  $BUSQUEDA ORDER BY B.fecha DESC LIMIT $PAGINA, $PUBLICACION_PAGINA ";
        $resultado = $conexion->query($sql);
        $resultado = ($resultado  && $resultado->num_rows) ? $resultado : false;
        if ($resultado) {
            $publicaciones = [];
            while ($publicacion = $resultado->fetch_assoc()) {
                $publicaciones[] = $publicacion;
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Aqui te envio algunas de las publicaciones',
                'publicaciones' => $publicaciones,
                'rutaImagen' => $directorio,
                'totalPublicaciones' => $PUBLICACIONES->contarPublicaciones($BUSQUEDA),
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No cuenta con publicaciones',
                'POST' => $_POST,
                'sql' => $sql,
            );
        }

        die(json_encode($respuesta));

        break;
    case 'traerPostsBlog':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;
        $idPublicacion = isset($_POST['idPublicacion']) && !empty($_POST['idPublicacion']) ? (int) $_POST['idPublicacion'] : $idUser;
        $LimitIdPub = "";
        if ($idUser) {
            $limitUser = "AND B.iduser = " . $idUser;
        }
        if ($idPublicacion) {
            $LimitIdPub = "AND B.id = " . $idPublicacion;
        }
        $limitPostAc = " AND B.estado = 'AC' ";

        if ($USERLOGIN && $USERLOGIN['tipoUser'] == 1) {
            $limitPostAc = '';
        }
        $BUSQUEDA = isset($_POST['busqueda']) && !empty($_POST['busqueda']) ? htmlspecialchars($_POST['busqueda']) : "";
        //PAGINACION
        $PUBLICACION_PAGINA = 6;
        $PAGINA = isset($_POST['pagina']) && !empty($_POST['pagina']) ? (int) $_POST['pagina'] - 1 : 0;
        $PAGINA = $PAGINA * $PUBLICACION_PAGINA;
        if ($BUSQUEDA != "") {
            $BUSQUEDA = " AND (B.titulo LIKE '%$BUSQUEDA%' OR B.descripcion LIKE '%$BUSQUEDA%' OR concat_ws(' ', U.nombre,U.apellidos) LIKE '%$BUSQUEDA%') ";
        }
        $BUSQUEDA .= $limitPostAc.$LimitIdPub;
        $PUBLICACIONES = new Publicaciones();
        $PUBLICACIONES->CONEXION = $conexion;
        //PAGINACION
        $directorio = 'galeria/blog_post/';

        $sql = "SELECT B.*,U.nombre,U.apellidos, U.img FROM blogposts AS B ,usuarios as U WHERE B.iduser = U.idUsuario  $BUSQUEDA ORDER BY B.fecha DESC LIMIT $PAGINA, $PUBLICACION_PAGINA ";
        $resultado = $conexion->query($sql);
        $resultado = ($resultado  && $resultado->num_rows) ? $resultado : false;
        if ($resultado) {
            $publicaciones = [];
            while ($publicacion = $resultado->fetch_assoc()) {
                $publicaciones[] = $publicacion;
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Aqui te envio algunas de las publicaciones',
                'publicaciones' => $publicaciones,
                'rutaImagen' => $directorio,
                'totalPublicaciones' => $PUBLICACIONES->contarPublicaciones($BUSQUEDA),
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No cuenta con publicaciones',
                'POST' => $_POST,
                'sql' => $sql,
            );
        }

        die(json_encode($respuesta));

        break;
    case 'eliminarPublicacion':
        $idPublicacion = isset($_POST['idPublicacion']) && !empty($_POST['idPublicacion']) ? (int) $_POST['idPublicacion'] : false;
        $sql = "SELECT * FROM blogposts WHERE id =$idPublicacion AND iduser =  " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        $PUBLICACION = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
        if (!$USERLOGIN ||  !$PUBLICACION) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar", $sql, $_POST)));
        }
        $directorio = '../galeria/blog_post/';

        if ($USERLOGIN['rol'] == 1 && $USERLOGIN['idUsuario'] != $PUBLICACION['iduser']) {
            $sql = "UPDATE blogposts SET estado= 'BAN' WHERE id = $idPublicacion";
            $resultado = $conexion->query($sql);
            $resultado = ($resultado && $conexion->affected_rows) ? true : false;
            if ($resultado) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Pubicación banneada'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No se realizo ninguna modificación'
                );
            }
        } else {
            $sql = "DELETE FROM blogposts WHERE id = $idPublicacion AND iduser = " . $USERLOGIN['idUsuario'];
            $resultado = $conexion->query($sql);
            if ($resultado) {
                $galery = ($directorio . $PUBLICACION['imagen']);
                if (file_exists($galery)) {
                    unlink($galery);
                }

                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Se elimino de forma exitosa'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No fue posible eliminar la publicación'
                );
            }
        }
        die(json_encode($respuesta));
        break;
    case 'editarPublicacion':
        $titulo       = isset($_POST['titulo']) && !empty($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : false;
        $descripcion = isset($_POST['descripcion']) && !empty($_POST['descripcion']) ? ($_POST['descripcion']) : false;
        $idPublicacion       = isset($_POST['idPublicacion']) && !empty($_POST['idPublicacion']) ? htmlspecialchars($_POST['idPublicacion']) : false;

        $sql = "SELECT * FROM blogposts WHERE estado = 'AC' AND id =$idPublicacion AND iduser =  " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        $resultado = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
        if (!$USERLOGIN ||  !$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar", $sql, $_POST)));
        }
        $sql = "UPDATE blogposts SET titulo='$titulo',descripcion='$descripcion' WHERE id=$idPublicacion";
        $resultado = $conexion->query($sql);
        $resultado = ($resultado && $conexion->affected_rows) ? true : false;
        if ($resultado) {
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Actualización realizada con exito'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No se realizo ninguna modificación'
            );
        }

        die(json_encode($respuesta));
        break;
    default:
        die(json_encode($_POST));
        break;
}
