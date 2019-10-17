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
                'Texto' => '¡Listo!',
            );
            $_SESSION['snsanfrancisco']['imagen'] = $imagen;
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No fue posible mover la imagen al sistema',
            );
        }

        die(json_encode($respuesta));
        break;
    case 'crearPublicacion':
        $titulo       = isset($_POST['titulo']) && !empty($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : false;
        $descripcion = isset($_POST['descripcion']) && !empty($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : false;

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
        // die(json_encode(array($_POST, $_FILES)));
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777) or die(json_encode(array('respuesta' => 'error', 'Texto' => "No se puede crear el directorio de extracción")));
        }

        $dir = opendir($directorio); //Abrimos el directorio de destino


        //Cambiar el nombre de la imagen en el servidor

        $sql = "INSERT INTO publicacion (iduser, titulo, imagen, descripcion) VALUE ($idUser,'$titulo','$imagen','$descripcion')";
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
        $directorio = 'galeria/usuario/' . rellenarCero($idUser) . '/';
        if ($idUser) {
            $sql = "SELECT P.*,U.nombre,U.apellidos, U.img FROM publicacion AS P ,usuarios as U WHERE P.iduser = U.idUsuario AND P.iduser = " . $idUser.' ORDER BY P.fecha DESC ';
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
                    'rutaImagen' => $directorio
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No cuenta con publicaciones',
                    'POST' => $_POST,
                );
            }
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'El usuario seleccionado o perfil es incorrecto',
                'POST' => $_POST,
            );
        }
        die(json_encode($respuesta));

        break;
    case 'traerPerfil':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;

        break;
    case 'traerUltimasPublicaciones':

        break;
    case 'miMembresia':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        if ($idUser) {
            // Siempre te arrojara la membresia con la ultima fecha de finalizacion
            $sql = "SELECT M.*,R.nombre AS rol,R.imagen,R.tag,R.duracion FROM membresias AS M,rango AS R WHERE M.idRango = R.id AND M.idUser = $idUser ORDER BY M.fechaFinal DESC LIMIT 1 ";
            $resultado = $conexion->query($sql);
            if ($resultado && $resultado->num_rows) {
                $MEMBRESIA = $resultado->fetch_assoc();

                $hoy = getdate();

                $fHoy = $hoy['year'] . '-' . (($hoy['mon'] > 9) ? $hoy['mon'] : '0' . $hoy['mon']) . '-' . $hoy['mday'];

                $fechaInicio = $MEMBRESIA['fechaInicio'];
                $fechaFinal  = $MEMBRESIA['fechaFinal'];

                $dateHoy = new DateTime($fHoy);
                $dateInicio = new DateTime($fechaInicio);
                $dateFinal = new DateTime($fechaFinal);

                //Diferencia
                $diff = $dateHoy->diff($dateFinal);
                $anios = $diff->y;
                $meses = $diff->m;
                $dias = $diff->d;
                //Diferencia
                $comparacion =false;

                if ($dateHoy < $dateFinal) {
                    $comparacion =true;
                } else {
                    $comparacion = false;
                }
                $respuesta = array(
                    'respuesta'=>'exito',
                    'Texto'=>'Consulta de membresia exitosa',
                    'ultimaMembresia'=>$MEMBRESIA,
                    'planActivo'=>$comparacion,
                    'anio'=>$anios,
                    'meses'=>$meses,
                    'dias'=>$dias,
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No cuentas con ningun plan registrado Aún'
                );
            }
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'Para consultar tu plan actual es necesario iniciar Sesión de nuevo'
            );
        }
        die(json_encode($respuesta));
        break;
    case 'membresias':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        if ($idUser) {
            // Siempre te arrojara la membresia con la ultima fecha de finalizacion
            $sql = "SELECT M.*,R.nombre AS rol,R.imagen,R.tag,R.duracion FROM membresias AS M,rango AS R WHERE M.idRango = R.id AND M.idUser = $idUser ORDER BY M.fechaFinal DESC";
            $resultado = $conexion->query($sql);
            if ($resultado && $resultado->num_rows) {
                $MEMBRESIAS = [];
                while($MEMBRESIA = $resultado->fetch_assoc()){
                    $MEMBRESIAS[]=$MEMBRESIA;
                }
                $respuesta = array(
                    'respuesta'=>'exito',
                    'Texto'=>'Aquí se encontro el historial de membresias',
                    'membresias'=>$MEMBRESIAS
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No cuentas con ningun plan registrado Aún'
                );
            }
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'Para consultar tu plan actual es necesario iniciar Sesión de nuevo'
            );
        }
        die(json_encode($respuesta));
        break;
    case 'consultar':

        break;
    default:
        break;
}
