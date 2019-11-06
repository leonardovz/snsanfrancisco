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
        $idServicio = isset($_POST['idServicio']) && !empty($_POST['idServicio']) ? (int) $_POST['idServicio'] : false;
        $SERVICIO = ($idServicio) ? "AND UI.idServicio =  " . $idServicio : "";
        $sql = "SELECT U.idUsuario ,U.nombre,U.apellidos,U.correo,U.fecha,U.img, UI.nombreServicio, UI.celular,UI.telefono,UI.descripcion,UI.domicilio,UI.whatsapp,S.nombre AS servicio,S.color AS colorS, S.icono AS iconoS  FROM usuarios AS U, usersinfo AS UI,servicios AS S  WHERE U.idUsuario = UI.iduser AND S.id=UI.idServicio $SERVICIO ORDER BY U.fecha DESC " . (($idServicio) ? "" : "LIMIT 8");
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

        if ($PAQUETES) {
            $planesArray = [];
            while ($PAQUETE = $PAQUETES->fetch_assoc()) {
                $planesArray[] = array(
                    'plan' => $PAQUETE,
                    'venefocios' => 'llorar'
                );
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Planes encontrados',
                'planes' => $planesArray
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No se encontraron coincidencias',
                'planes' => $planesArray
            );
        }
        die(json_encode($respuesta));


        break;

    case 'traerPostsPerfil':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;
        $limite = isset($_POST['limite']) && !empty($_POST['limite']) ? (int) $_POST['limite'] : false;
        //Verificar el perfil del Usuario
        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

        $sql = "SELECT M.*,R.nombre AS rol,R.imagen,R.tag,R.duracion,R.iconColor,R.icono, R.publicacion FROM membresias AS M,rango AS R WHERE M.idRango = R.id AND M.idUser = $idUser ORDER BY M.fechaFinal DESC LIMIT 1 ";
        $resultado = $conexion->query($sql);
        $MEMBRESIA = '';
        $comparacion = false;
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
            if ($dateHoy < $dateFinal) {
                $comparacion = true;
            } else {
                $comparacion = false;
            }
        }
        $LIMITE = ($comparacion) ? $MEMBRESIA['publicacion'] : 1;
        $LIMITE = ($limite) ? $limite : $LIMITE;

        $directorio = 'galeria/usuario/' . rellenarCero($idUser) . '/';
        if ($idUser) {
            $sql = "SELECT P.*,U.nombre,U.apellidos, U.img FROM publicacion AS P ,usuarios as U WHERE P.iduser = U.idUsuario AND P.iduser = " . $idUser . ' ORDER BY P.fecha DESC LIMIT ' . $LIMITE;
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
    case 'traerPostsTipoServicio':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;
        $limite = isset($_POST['limite']) && !empty($_POST['limite']) ? (int) $_POST['limite'] : false;
        //Verificar el perfil del Usuario
        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

        $sql = "SELECT M.*,R.nombre AS rol,R.imagen,R.tag,R.duracion,R.iconColor,R.icono, R.publicacion FROM membresias AS M,rango AS R WHERE M.idRango = R.id AND M.idUser = $idUser ORDER BY M.fechaFinal DESC LIMIT 1 ";
        $resultado = $conexion->query($sql);
        $MEMBRESIA = '';
        $comparacion = false;
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
            if ($dateHoy < $dateFinal) {
                $comparacion = true;
            } else {
                $comparacion = false;
            }
        }
        $LIMITE = ($comparacion) ? $MEMBRESIA['publicacion'] : 1;
        $LIMITE = ($limite) ? $limite : $LIMITE;

        $directorio = 'galeria/usuario/' . rellenarCero($idUser) . '/';
        if ($idUser) {
            $sql = "SELECT P.*,U.nombre,U.apellidos, U.img FROM publicacion AS P ,usuarios as U WHERE P.iduser = U.idUsuario AND P.iduser = " . $idUser . ' ORDER BY P.fecha DESC LIMIT ' . $LIMITE;
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
    case 'traerPostsInicio':
        $limite = isset($_POST['limite']) && !empty($_POST['limite']) ? (int) $_POST['limite'] : false;

        $sql = "SELECT M.*,R.publicacion FROM membresias AS M ,rango AS R WHERE M.idRango = R.id GROUP BY M.idUser ORDER BY R.publicacion DESC LIMIT 4  ";
        $USUARIOS = $conexion->query($sql);

        if ($USUARIOS && $USUARIOS->num_rows) {
            $publicaciones = [];
            while ($user = $USUARIOS->fetch_assoc()) {
                // var_dump( $USUARIO);
                $idUser = $user['idUser'];

                $directorio = 'galeria/usuario/' . rellenarCero($idUser) . '/';

                $sql = "SELECT P.*,U.nombre,U.apellidos, U.img FROM publicacion AS P ,usuarios as U WHERE P.iduser = U.idUsuario AND P.iduser = " . $idUser . ' ORDER BY P.fecha DESC LIMIT ' . 1;
                $resultado = $conexion->query($sql);
                if ($resultado  && $resultado->num_rows) {
                    while ($publicacion = $resultado->fetch_assoc()) {
                        $publicaciones[] = array(
                            'publicacion' => $publicacion,
                            'rutaImagen' => $directorio
                        );
                    }
                }
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Aqui te envio algunas de las publicaciones',
                'publicaciones' => $publicaciones,
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'Aqui te envio algunas de las publicaciones',
            );
        }


        die(json_encode($respuesta));

        break;
    case 'traerPostsRelacion':
        // $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        // $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;


        // if ($idUser) {
        $sql = "SELECT P.*,U.nombre,U.apellidos, U.img,U.idUsuario,S.nombre,UI.nombreServicio FROM publicacion AS P ,usuarios as U, usersinfo AS UI,servicios AS S WHERE P.iduser = U.idUsuario AND U.idUsuario = UI.iduser AND UI.idServicio = S.id   GROUP BY U.idUsuario ORDER BY P.fecha DESC";
        $resultado = $conexion->query($sql);
        $resultado = ($resultado  && $resultado->num_rows) ? $resultado : false;
        if ($resultado) {
            $publicaciones = [];
            while ($publicacion = $resultado->fetch_assoc()) {
                $directorio = 'galeria/usuario/' . rellenarCero($publicacion['idUsuario']) . '/';
                $publicaciones[] = array(
                    'publicacion' => $publicacion,
                    'directorio' => $directorio
                );
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Aqui te envio algunas de las publicaciones',
                'publicaciones' => $publicaciones,
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

    case 'serviciosInicio':
        $sql = "SELECT S.* FROM usuarios AS U, usersinfo AS UI,servicios AS S WHERE U.idUsuario = UI.iduser AND S.id=UI.idServicio GROUP BY S.id ORDER BY U.fecha DESC LIMIT 6 ";
        $resultado = $conexion->query($sql);
        $servicios = ($resultado  && $resultado->num_rows) ? $resultado : false;
        if ($servicios) {
            $SERVICIOS = [];
            while ($servicio = $servicios->fetch_assoc()) {
                $SERVICIOS[] = $servicio;
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Aqui te envio algunas de las publicaciones',
                'servicios' => $SERVICIOS,
                'rutaImagen' => 'galeria/sistema/servicios/',
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No se encontraron servicios registrados',
            );
        }
        die(json_encode($respuesta));
        break;

    case 'busqueda':
        $buscar = isset($_POST['buscar']) && !empty($_POST['buscar']) ? $_POST['buscar'] : "";


        $sqlPerfil = "SELECT U.idUsuario ,U.nombre,U.apellidos,U.correo,U.fecha,U.img, UI.nombreServicio, UI.celular,UI.telefono,UI.descripcion,UI.domicilio,UI.whatsapp,S.nombre AS servicio,S.color AS colorS, S.icono AS iconoS  FROM usuarios AS U, usersinfo AS UI,servicios AS S  WHERE U.idUsuario = UI.iduser AND S.id=UI.idServicio AND (U.nombre LIKE '%$buscar%' OR U.apellidos LIKE '%$buscar%'  OR UI.nombreServicio LIKE '%$buscar%' OR UI.descripcion LIKE '%$buscar%' OR S.nombre LIKE '%$buscar%' OR S.descripcion LIKE '%$buscar%')";
        $sqlPublicacion = "SELECT P.*,U.nombre,U.apellidos, U.img,U.idUsuario,S.nombre,UI.nombreServicio FROM publicacion AS P ,usuarios as U, usersinfo AS UI,servicios AS S WHERE P.iduser = U.idUsuario AND U.idUsuario = UI.iduser AND UI.idServicio = S.id AND (P.titulo LIKE '%$buscar%' OR P.descripcion LIKE '%$buscar%' OR U.nombre LIKE '%$buscar%' OR U.apellidos LIKE '%$buscar%' OR UI.nombreServicio LIKE '%$buscar%' OR S.nombre LIKE '%$buscar%' OR S.descripcion LIKE '%$buscar%') ";
        $sqlServicio = "SELECT * FROM servicios WHERE nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' ";

        $respuestaPerfil = $conexion->query($sqlPerfil);
        $respuestaServicio = $conexion->query($sqlServicio);
        $respuestaPublicacion = $conexion->query($sqlPublicacion);

        $ARRAYPerfil = false;
        $ARRAYServicio = false;
        $ARRAYPublicacion = false;

        if ($respuestaPerfil && $respuestaPerfil->num_rows) {
            while ($resultPerfil = $respuestaPerfil->fetch_assoc()) {
                $ARRAYPerfil[] = array(
                    'Perfil' => $resultPerfil,
                    'rutaImagen' => 'galeria/usuario/' . rellenarCero($resultPerfil['idUsuario']).'/',
                );
            }
        }
        if ($respuestaPublicacion && $respuestaPublicacion->num_rows) {
            while ($resultPublicacion = $respuestaPublicacion->fetch_assoc()) {
                $ARRAYPublicacion[] = array(
                    'Publicacion' => $resultPublicacion,
                    'rutaImagen' => 'galeria/usuario/' . rellenarCero($resultPublicacion['idUsuario']).'/',

                );
            }
        }

        if ($respuestaServicio && $respuestaServicio->num_rows) {
            while ($resultServicio = $respuestaServicio->fetch_assoc()) {
                $ARRAYServicio[] = array(
                    'Servicio' => $resultServicio,
                    'rutaImagen' => 'galeria/sistema/servicios/',
                );
            }
        }

        if ($respuestaPerfil || $respuestaServicio || $respuestaPublicacion) {
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Alguno de los resultados',
                'Perfil' => $ARRAYPerfil,
                'Servicio' => $ARRAYServicio,
                'Publicacion' => $ARRAYPublicacion,
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No se encontro ninguna coincidencia'
            );
        }
        die(json_encode($respuesta));
        break;
    default:
        break;
}
