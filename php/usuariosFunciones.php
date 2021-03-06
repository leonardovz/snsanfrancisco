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
        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

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

        $MEMBRESIA = $ADMINFUNC->paquetePerfilUser($USERLOGIN['idUsuario']);
        $nPub = $ADMINFUNC->contarPublicacionUser($USERLOGIN['idUsuario']); //Permite contar el numero de publicaciones actuales
        if (!$MEMBRESIA) {
        }

        if (!$MEMBRESIA || ($nPub >= $MEMBRESIA['membresia']['publicacion'])) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "El número de publicaciones exede tu paquete actual, si requieres de más publicaciónes puedes eliminar pubicaciónes pasadas, o consultar al administrador para mejorar tu paquete")));
        }
        $IMAGENPERFIL = $_FILES['avatar'];
        $IMAGENTYPE = explode(".", $IMAGENPERFIL['name']);
        $IMAGENTYPE = end($IMAGENTYPE);


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
    case 'editarPublicacion':
        $titulo       = isset($_POST['titulo']) && !empty($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : false;
        $descripcion = isset($_POST['descripcion']) && !empty($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : false;
        $idPublicacion       = isset($_POST['idPublicacion']) && !empty($_POST['idPublicacion']) ? htmlspecialchars($_POST['idPublicacion']) : false;

        $sql = "SELECT * FROM publicacion WHERE estado = 'AC' AND id =$idPublicacion AND iduser =  " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        $resultado = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
        if (!$USERLOGIN ||  !$resultado) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar", $sql, $_POST)));
        }
        $sql = "UPDATE publicacion SET titulo='$titulo',descripcion='$descripcion' WHERE id=$idPublicacion";
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
    case 'eliminarPublicacion':
        $idPublicacion       = isset($_POST['idPublicacion']) && !empty($_POST['idPublicacion']) ? htmlspecialchars($_POST['idPublicacion']) : false;
        $sql = "SELECT * FROM publicacion WHERE id =$idPublicacion AND iduser =  " . $USERLOGIN['idUsuario'];
        $resultado = $conexion->query($sql);
        $PUBLICACION = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
        if (!$USERLOGIN ||  !$PUBLICACION) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => "Ocurrio un error al consultar tu perfil, Cierra sesión y vuelve a ingresar", $sql, $_POST)));
        }

        if ($USERLOGIN['rol'] == 1 && $USERLOGIN['idUsuario'] != $PUBLICACION['iduser']) {
            $sql = "UPDATE publicacion SET estado= 'BAN' WHERE id = $idPublicacion";
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
            $sql = "DELETE FROM publicacion WHERE id = $idPublicacion AND iduser = " . $USERLOGIN['idUsuario'];
            $resultado = $conexion->query($sql);
            if ($resultado) {
                $galery = ('../galeria/usuario/' . rellenarCero($USERLOGIN['idUsuario']) . '/' . $PUBLICACION['imagen']);
                if (is_file($galery)) {
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
    case 'traerPostsPerfil':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;
        $directorio = 'galeria/usuario/' . rellenarCero($idUser) . '/';
        if ($idUser) {
            $sql = "SELECT P.*,U.nombre,U.apellidos, U.img FROM publicacion AS P ,usuarios as U WHERE P.iduser = U.idUsuario AND P.iduser = " . $idUser . ' ORDER BY P.fecha DESC ';
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
        $idUser = (isset($_POST['idPerfil']) && !empty($_POST['idPerfil'])) ? (int) $_POST['idPerfil'] : $idUser;

        if ($idUser) {
            // Siempre te arrojara la membresia con la ultima fecha de finalizacion
            $sql = "SELECT M.*,R.nombre AS rol,R.imagen,R.tag,R.duracion,R.iconColor,R.icono,R.publicacion FROM membresias AS M,rango AS R WHERE M.idRango = R.id AND M.idUser = $idUser ORDER BY M.fechaFinal DESC LIMIT 1  ";
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
                $comparacion = false;

                if ($dateHoy < $dateFinal) {
                    $comparacion = true;
                } else {
                    $comparacion = false;
                }
                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Consulta de membresia exitosa',
                    'ultimaMembresia' => $MEMBRESIA,
                    'planActivo' => $comparacion,
                    'anio' => $anios,
                    'meses' => $meses,
                    'dias' => $dias,
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
            $sql = "SELECT M.*,R.nombre AS rol,R.imagen,R.tag,R.duracion,R.iconColor,R.icono FROM membresias AS M,rango AS R WHERE M.idRango = R.id AND M.idUser = $idUser ORDER BY M.fechaFinal DESC";
            $resultado = $conexion->query($sql);
            if ($resultado && $resultado->num_rows) {
                $MEMBRESIAS = [];
                while ($MEMBRESIA = $resultado->fetch_assoc()) {
                    $MEMBRESIAS[] = $MEMBRESIA;
                }
                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Aquí se encontro el historial de membresias',
                    'membresias' => $MEMBRESIAS
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
    case 'registroServicio':
        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

        $nombreServicio   = isset($_POST['nombreServicio'])  && !empty($_POST['nombreServicio'])  ? $conexion->real_escape_string($_POST['nombreServicio'])  : false;
        $telefonoOficina  = isset($_POST['telefonoOficina']) && !empty($_POST['telefonoOficina']) ? $conexion->real_escape_string($_POST['telefonoOficina']) : false;
        $correoServicio   = isset($_POST['correoServicio'])  && !empty($_POST['correoServicio'])  ? $conexion->real_escape_string($_POST['correoServicio'])  : false;
        $domicilio        = isset($_POST['domicilio'])       && !empty($_POST['domicilio'])       ? $conexion->real_escape_string($_POST['domicilio'])       : false;
        $codigoPostal     = isset($_POST['codigoPostal'])    && !empty($_POST['codigoPostal'])    ? (int) ($_POST['codigoPostal'])    : false;
        $colonia          = isset($_POST['colonia'])         && !empty($_POST['colonia'])         ? $conexion->real_escape_string($_POST['colonia'])         : false;
        $coloniaText      = isset($_POST['coloniaText'])     && !empty($_POST['coloniaText'])     ? $conexion->real_escape_string($_POST['coloniaText'])     : false;
        $servicio         = isset($_POST['servicio'])        && !empty($_POST['servicio'])        ? $conexion->real_escape_string($_POST['servicio'])        : false;

        $activacionCode   = isset($_POST['activacionCode'])  && !empty($_POST['activacionCode'])  ? $conexion->real_escape_string($_POST['activacionCode'])  : false;
        $idRango          = isset($_POST['idPaquete'])       && !empty($_POST['idPaquete'])       ? (int) ($_POST['idPaquete'])       : false;


        $colonia = (($colonia != 0) || !$coloniaText) ? $colonia : $coloniaText; //Obtenemos la colonia que nos dio el usuario


        if (!$USERLOGIN) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'El usuario con el que intentas hacer el registro no puede continuar, reinicia tu sesión',)));
        }

        $idUsuario = $USERLOGIN['idUsuario'];
        $codigoServicio = false;

        //Apartado de validacion de codigo de activación
        if (valTextNum($activacionCode)) {
            $codigo = $ADMINFUNC->verificarCodigo($activacionCode);
            if ($codigo) {
                $codigoServicio = $codigo = $codigo->fetch_assoc();
                if (($codigo['idUsuario'] == 0 || $codigo['idUsuario'] == $idUsuario) && $codigo['estado'] == 'disponible') {
                    if ($codigo['idRango'] != $idRango) {
                        die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código no concuerda con el paquete que quieres comprar')));
                    }
                } else if ($codigo['idUsuario'] != 0 && $codigo['idUsuario'] != $idUsuario) {
                    die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que has ingresado no es válido para tu cuenta')));
                } else {
                    die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que intentas ingresar ya ha sido activado',)));
                }
            } else {
                die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que intentas ingresar no es válido',)));
            }
        } else {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que intentas ingresar no tiene el formato correcto',)));
        } //fin del apardado de codigo de verificación

        if (!$nombreServicio) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'Complete el nombre de su servicio',)));
        }
        if (!$domicilio) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'Complete de forma correctamente el domicilio')));
        }
        if (!$colonia) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'Los datos de la colonia no son correctos')));
        }

        // Calculo para realizar la activación de la membresia
        $idCodigo = (int) $codigoServicio['id'];
        $cantPagos = (int) $codigoServicio['cantidad'];
        $cobro = (int) $codigoServicio['costo'] * (int) $codigoServicio['cantidad'];
        $tipoPago = 'codigo';
        $mesesMembresia = (int) $codigoServicio['cantidad'] * (int) $codigoServicio['duracion'];
        $fechaInicio = date("Y-m-d");
        $fechaFinal =  date("Y-m-d", strtotime($fechaInicio . "+ " . $mesesMembresia . " month"));
        // FIN Calculo para realizar la activación de la membresia

        $sql = "INSERT INTO usersinfo(iduser, nombreServicio, telefono,correoServicio,domicilio, idServicio, CP, colonia) VALUES ($idUsuario,'$nombreServicio','$telefonoOficina','$correoServicio','$domicilio','$servicio',$codigoPostal,'$colonia')";
        $resultado = $conexion->query($sql);
        if ($resultado) {
            $MEMBRESIA = "INSERT INTO membresias(idUser,fechaInicio ,fechaFinal, cantPagos, cobro, tipoPago, idcodigo, idRango) VALUES ($idUsuario,'$fechaInicio','$fechaFinal','$cantPagos','$cobro','$tipoPago',$idCodigo,$idRango)";
            if ($conexion->query($MEMBRESIA)) {
                $conexion->query("UPDATE codigos SET idUsuario = $idUsuario ,estado = 'activo' WHERE id = $idCodigo");
                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'tu servicio ha sido registrado de manera exitosa'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No fue posible registrar su membresia, reinicia la ventana'
                );
            }
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'no fue posible realizar el registro intenta recargar la página'
            );
        }
        // $respuesta = array();

        die(json_encode($respuesta));

        break;

    case 'activarPaquete':

        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

        $activacionCode   = isset($_POST['codigoActivacionPaquete'])  && !empty($_POST['codigoActivacionPaquete'])  ? $conexion->real_escape_string($_POST['codigoActivacionPaquete'])  : false;
        $idRango          = isset($_POST['idPaquete'])       && !empty($_POST['idPaquete'])       ? (int) ($_POST['idPaquete'])       : false;

        if (!$USERLOGIN) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'El usuario con el que intentas hacer el registro no puede continuar, reinicia tu sesión',)));
        }

        $idUsuario = $USERLOGIN['idUsuario'];
        $codigoServicio = false;

        //Apartado de validacion de codigo de activación
        if (valTextNum($activacionCode)) {
            $codigo = $ADMINFUNC->verificarCodigo($activacionCode);
            if ($codigo) {
                $codigoServicio = $codigo = $codigo->fetch_assoc();
                if (($codigo['idUsuario'] == 0 || $codigo['idUsuario'] == $idUsuario) && $codigo['estado'] == 'disponible') {
                    if ($codigo['idRango'] != $idRango) {
                        die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código no concuerda con el paquete que quieres comprar')));
                    }
                } else if ($codigo['idUsuario'] != 0 && $codigo['idUsuario'] != $idUsuario) {
                    die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que has ingresado no es válido para tu cuenta')));
                } else {
                    die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que intentas ingresar ya ha sido activado',)));
                }
            } else {
                die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que intentas ingresar no es válido', $_POST)));
            }
        } else {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'El código que intentas ingresar no tiene el formato correcto',)));
        } //fin del apardado de codigo de verificación


        // Calculo para realizar la activación de la membresia
        $idCodigo = (int) $codigoServicio['id'];
        $cantPagos = (int) $codigoServicio['cantidad'];
        $cobro = (int) $codigoServicio['costo'] * (int) $codigoServicio['cantidad'];
        $tipoPago = 'codigo';
        $mesesMembresia = (int) $codigoServicio['cantidad'] * (int) $codigoServicio['duracion'];
        $fechaInicio = date("Y-m-d");
        $fechaFinal =  date("Y-m-d", strtotime($fechaInicio . "+ $mesesMembresia month"));
        // FIN Calculo para realizar la activación de la membresia

        $MEMBRESIA = "INSERT INTO membresias(idUser,fechaInicio ,fechaFinal, cantPagos, cobro, tipoPago, idcodigo, idRango) VALUES ($idUsuario,'$fechaInicio','$fechaFinal','$cantPagos','$cobro','$tipoPago',$idCodigo,$idRango)";
        if ($conexion->query($MEMBRESIA)) {
            $conexion->query("UPDATE codigos SET idUsuario = $idUsuario ,estado = 'activo' WHERE id = $idCodigo");
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Tu paquete ha sido registrado de manera exitosa'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No fue posible registrar su código', $MEMBRESIA
            );
        }

        // $respuesta = array();

        die(json_encode($respuesta));

        break;



    case 'modificarPerfil':
        if ($USERLOGIN) {
            $idUsuario = $USERLOGIN['idUsuario'];
            $nombre = isset($_POST['nombre']) && !empty($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) && !empty($_POST['apellidos']) ? $_POST['apellidos'] : false;

            $resultado = $conexion->query("UPDATE usuarios SET nombre='$nombre',apellidos='$apellidos' WHERE idUsuario = $idUsuario ");
            if ($resultado && $conexion->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Perfil actualizado'
                );
                $_SESSION['snsanfrancisco']['nombre'] =  $nombre;
                $_SESSION['snsanfrancisco']['apellidos'] =  $apellidos;
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No fue posible cambiar los datos de su perfil'
                );
            }
        }
        die(json_encode($respuesta));
        break;
    case 'misDatos':
        if ($USERLOGIN) {
            $idUsuario = $USERLOGIN['idUsuario'];
            $nombre = isset($_POST['nombre']) && !empty($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) && !empty($_POST['apellidos']) ? $_POST['apellidos'] : false;

            $resultado = $conexion->query("SELECT * FROM usersinfo WHERE iduser = $idUsuario ");
            if ($resultado && $resultado->num_rows) {
                $info = $resultado->fetch_assoc();
                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Toma tu perfil',
                    'perfil' => $info
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'Datos erroneos'
                );
            }
        }
        die(json_encode($respuesta));
        break;
    case 'editarPerfilInfo':
        $ADMINFUNC = new AdminFunciones();
        $ADMINFUNC->CONEXION = $conexion;

        $nombreServicio   = isset($_POST['nombreServicio'])  && !empty($_POST['nombreServicio'])  ? $conexion->real_escape_string($_POST['nombreServicio'])  : false;
        $telefonoOficina  = isset($_POST['telefonoOficina']) && !empty($_POST['telefonoOficina']) ? $conexion->real_escape_string($_POST['telefonoOficina']) : false;
        $telefonoCelular  = isset($_POST['telefonoCelular']) && !empty($_POST['telefonoCelular']) ? $conexion->real_escape_string($_POST['telefonoCelular']) : false;
        $correoServicio   = isset($_POST['correoServicio'])  && !empty($_POST['correoServicio'])  ? $conexion->real_escape_string($_POST['correoServicio'])  : false;
        $domicilio        = isset($_POST['domicilio'])       && !empty($_POST['domicilio'])       ? $conexion->real_escape_string($_POST['domicilio'])       : false;
        $codigoPostal     = isset($_POST['codigoPostal'])    && !empty($_POST['codigoPostal'])    ? (int) ($_POST['codigoPostal'])    : false;
        $colonia          = isset($_POST['colonia'])         && !empty($_POST['colonia'])         ? $conexion->real_escape_string($_POST['colonia'])         : false;
        $coloniaText      = isset($_POST['coloniaText'])     && !empty($_POST['coloniaText'])     ? $conexion->real_escape_string($_POST['coloniaText'])     : false;
        $servicio         = isset($_POST['servicio'])        && !empty($_POST['servicio'])        ? $conexion->real_escape_string($_POST['servicio'])        : false;
        $descripcion      = isset($_POST['descripcion'])     && !empty($_POST['descripcion'])     ? $conexion->real_escape_string($_POST['descripcion'])     : false;

        $colonia = (($colonia != 0) || !$coloniaText) ? $colonia : $coloniaText; //Obtenemos la colonia que nos dio el usuario

        if (!$USERLOGIN) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'El usuario con el que intentas hacer el registro no puede continuar, reinicia tu sesión',)));
        }

        $idUsuario = $USERLOGIN['idUsuario'];


        if (!$nombreServicio) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'Complete el nombre de su servicio', $_POST)));
        }
        if (!$domicilio) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'Complete de forma correctamente el domicilio')));
        }
        if (!$colonia) {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'Los datos de la colonia no son correctos')));
        }

        $sql = "UPDATE usersinfo SET nombreServicio='$nombreServicio',telefono='$telefonoOficina',celular='$telefonoCelular',correoServicio='$correoServicio',descripcion='$descripcion',domicilio='$domicilio',idServicio=$servicio,CP=$codigoPostal,colonia='$colonia' WHERE iduser = $idUsuario";
        $resultado = $conexion->query($sql);
        if ($resultado) {
            $respuesta = array(
                'respuesta' => 'exito',
                'Texto' => 'Tu servicio ha sido actualizado de manera exitosa', $_POST, $sql
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'Texto' => 'No fue posible realizar el registro'
            );
        }

        die(json_encode($respuesta));


        break;

    case 'traerPaquetes':
        if ($USERLOGIN) {

            $idUsuario = ($USERLOGIN['rol'] == 1) ? false : $USERLOGIN['idUsuario'];
            $USUARIO = ($idUsuario) ? " AND idUsuario = " . $idUsuario : "";
            $codigos = $conexion->query("SELECT codigos.*,rango.nombre AS nombreR FROM codigos,rango WHERE rango.id = codigos.idRango $USUARIO");
            if ($codigos && $codigos->num_rows) {
                $codigosArray = [];
                while ($codigo = $codigos->fetch_assoc()) {
                    $codigosArray[] = $codigo;
                }

                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Te envio los códigos generados',
                    'codigos' => $codigosArray,
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No te puedo mostrar códigos'
                );
            }
        }
        die(json_encode($respuesta));

        break;
    case 'changePassword':
        $passwordAC =   isset($_POST['passwordAC'])  && !empty($_POST['passwordAC']) ? $conexion->real_escape_string($_POST['passwordAC']) : false;
        $password =     isset($_POST['password'])    && !empty($_POST['password'])   ? $conexion->real_escape_string($_POST['password'])   : false;
        $passwordR =    isset($_POST['passwordR'])   && !empty($_POST['passwordR'])  ? $conexion->real_escape_string($_POST['passwordR'])  : false;
        if ($password && $passwordAC && $passwordR) {
            $email = $USERLOGIN['correo'];

            if (correoExiste($conexion, $email)) {
                $passwordAC = md5($passwordAC);
                $sql = "SELECT * FROM usuarios WHERE correo = '$email' AND password ='$passwordAC' ";
                $resultado = $conexion->query($sql);
                $resultado = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
                if ($resultado) {
                    if ($resultado['validar'] == 0) {
                        die(json_encode(array('respuesta' => 'error', 'Texto' => 'Es necesario que verifiques tu cuenta',)));
                    }

                    if ($password != $passwordR) {
                        die(json_encode(array('respuesta' => 'error', 'Texto' => 'Tu nueva contraseña no coincide',)));
                    }
                    $newPass = md5($password);
                    $sql = "UPDATE usuarios SET password = '$newPass' WHERE idUsuario = " . $USERLOGIN['idUsuario'];
                    $resultado = $conexion->query($sql);
                    if ($resultado && $conexion->affected_rows) {
                        $respuesta = array('respuesta' => 'exito', 'Texto' => 'Cambios aplicados correctamente',);
                    } else {
                        $respuesta = array('respuesta' => 'error', 'Texto' => 'No se pudo realizar ningun cambio en la contraseña', $sql);
                    }
                } else {
                    $respuesta = array('respuesta' => 'error', 'Texto' => 'No puedes cambiar tu contraseña por una ya activa',);
                }
            } else {
                $respuesta = array('respuesta' => 'error', 'Texto' => 'No se encontro tu correo electronico',);
            }
        } else {
            $respuesta = array('respuesta' => 'error', 'Texto' => 'No llegaron los datos de forma correcta', 'post' => $_POST);
        }
        die(json_encode($respuesta));

        break;
    case 'codigos':
        $ADMINISTRADOR = new AdminFunciones();
        $ADMINISTRADOR->CONEXION = $conexion;
        if ($USERLOGIN) {

            $idUsuario =  $USERLOGIN['idUsuario'];

            $codigos = $ADMINISTRADOR->codigosUser($idUsuario);

            if ($codigos && $codigos->num_rows) {
                $codigosArray = [];
                while ($codigo = $codigos->fetch_assoc()) {
                    $codigosArray[] = $codigo;
                }

                $respuesta = array(
                    'respuesta' => 'exito',
                    'Texto' => 'Te envio los códigos generados',
                    'codigos' => $codigosArray,
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No te puedo mostrar códigos'
                );
            }
        }
        die(json_encode($respuesta));
        break;
    case 'redesSociales':
        $ADMINISTRADOR = new AdminFunciones();
        $ADMINISTRADOR->CONEXION = $conexion;
        if ($USERLOGIN) {
            $facebook     = isset($_POST['facebookVal'])   && !empty($_POST['facebookVal'])   ? htmlspecialchars($_POST['facebookVal']) : false;
            $instagram    = isset($_POST['instagramVal'])  && !empty($_POST['instagramVal'])  ? htmlspecialchars($_POST['instagramVal']) : false;
            $messenger    = isset($_POST['messengerVal'])  && !empty($_POST['messengerVal'])  ? htmlspecialchars($_POST['messengerVal']) : false;
            $whatsapp     = isset($_POST['whatsappVal'])   && !empty($_POST['whatsappVal'])   ? htmlspecialchars($_POST['whatsappVal']) : false;
            $web          = isset($_POST['webVal'])        && !empty($_POST['webVal'])        ? htmlspecialchars($_POST['webVal']) : false;

            $idUsuario =  $USERLOGIN['idUsuario'];
            $SOCIALES = [];
            if ($facebook) {
                $SOCIALES['facebook'] = $facebook;
            }
            if ($instagram) {
                $SOCIALES['instagram'] = $instagram;
            }
            if ($messenger) {
                $SOCIALES['messenger'] = $messenger;
            }
            if ($whatsapp) {
                $SOCIALES['whatsapp'] = $whatsapp;
            }
            if ($web) {
                $SOCIALES['personalWeb'] = $web;
            }
            $SOCIALES = json_encode($SOCIALES);


            $PERFIL = $ADMINISTRADOR->verificarPerfil($USERLOGIN['idUsuario']); //configuraci[on del perfil]
            if ($PERFIL) {
                $resultado = $conexion->query("UPDATE usersinfo SET social ='" . $SOCIALES . "' WHERE iduser = " . $USERLOGIN['idUsuario']);
                if ($resultado) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'Texto' => 'Perfil actualizado de manera exitosa',
                        'DATOS' => json_decode($SOCIALES),
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'Texto' => 'No fue posible actualizar el perfil',
                        'DATOS' => json_decode($SOCIALES),
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'Texto' => 'No te puedo mostrar códigos',
                    'DATOS' => json_decode($SOCIALES),
                );
            }
        }
        die(json_encode($respuesta));
        break;
    default:
        break;
}
