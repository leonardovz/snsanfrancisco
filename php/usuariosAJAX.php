<?php
session_start();

require_once '../config/ruta.php';
require_once '../config/config.php';
require_once '../config/funciones.php';
require_once '../php/emailTemplates.php';
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

switch ($_POST['opcion']) {
    case 'registro':
        $response_recapcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : false;
        if (isset($response_recapcha) && $response_recapcha) {
            $secret = "6LfTXMQUAAAAAJYmMvBxne034MJMwQu6ze8X2-5V";
            $ip = $_SERVER['REMOTE_ADDR'];
            $validar_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recapcha&remoteip=$ip");
        } else {
            die(json_encode(array(
                'respuesta' => 'error',
                'Texto' => 'Debes de completar el capcha'
            )));
        }
        $email     = (isset($_POST['email'])    && !empty($_POST['email']))    ? strtolower($_POST['email']) : false;
        $emailR    = (isset($_POST['emailR'])   && !empty($_POST['emailR']))   ? strtolower($_POST['emailR']) : false;
        $nombre    = (isset($_POST['nombre'])   && !empty($_POST['nombre']))   ? strtolower($_POST['nombre']) : false;
        $apellidos = (isset($_POST['apellido']) && !empty($_POST['apellido'])) ? strtolower($_POST['apellido']) : false;
        $password  = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : false;
        $passwordR = (isset($_POST['passwordR']) && !empty($_POST['passwordR'])) ? $_POST['passwordR'] : false;
        $terminos = (isset($_POST['terminos-condiciones']) && !empty($_POST['terminos-condiciones'])) ? $_POST['terminos-condiciones'] : false;
        if ($terminos != 'on') {
            die(json_encode(array('respuesta' => 'error', 'Texto' => 'Debes de aaceptar los terminos y condiciones para continuar')));
        }
        $tipoUser = 3;
        $mailEncrypt = md5($email);
        $validar = 0;
        $modo = 'dir';
        $PLANTILLAS = new PlantillasEmail();

        if ($email && $emailR && $nombre && $apellidos && $password && $passwordR) {
            if ($email == $emailR) {
                if ($password == $passwordR) {
                    if (!correoExiste($conexion, $email)) {
                        $password = md5($password);

                        $sql = "INSERT INTO usuarios(nombre, apellidos, correo, password, tipoUser, validar, encriptado,modo) VALUES ('$nombre','$apellidos','$email','$password',$tipoUser,$validar,'$mailEncrypt','$modo')";
                        $resultado = $conexion->query($sql);
                        if ($resultado) {
                            $datos = array(
                                'correo' => $email,
                                'nombre' => $nombre . " " . $apellidos,
                                'verificacion' => md5($email),
                                'Subject' => 'Verificación de correo cuenta',
                            );
                            $CORREO = $PLANTILLAS->templateRegistro($datos, $ruta);

                            $respuesta = enviarCorreo($CORREO, $datos);

                            $respuesta = array('respuesta' => 'exito', 'Texto' => 'Registro realizado con exito', 'correo' => $respuesta);
                        } else {
                            $respuesta = array('respuesta' => 'error', 'Texto' => 'No fue posible realizar el registro');
                        }
                    } else {
                        $respuesta = array('respuesta' => 'error', 'Texto' => 'El correo electronico, ya ha sido registrado',);
                    }
                } else {
                    $respuesta = array('respuesta' => 'error', 'Texto' => 'Las contraseñas no coinciden',);
                }
            } else {
                $respuesta = array('respuesta' => 'error', 'Texto' => 'Los correos electronicos no coinciden',);
            }
        } else {
            $respuesta = array('respuesta' => 'error', 'Texto' => 'Estas mal en alguna cosa',);
        }
        die(json_encode($respuesta));
        break;
    case 'login':
        $response_recapcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : false;
        if (isset($response_recapcha) && $response_recapcha) {
            $secret = "6LfTXMQUAAAAAJYmMvBxne034MJMwQu6ze8X2-5V";
            $ip = $_SERVER['REMOTE_ADDR'];
            $validar_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recapcha&remoteip=$ip");
        } else {
            die(json_encode(array(
                'respuesta' => 'error',
                'Texto' => 'Debes de completar el capcha'
            )));
        }
        $email     = (isset($_POST['correo'])    && !empty($_POST['correo']))    ? strtolower($_POST['correo']) : false;
        $password  = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : false;

        if ($email && $password) {
            if (correoExiste($conexion, $email)) {
                $password = md5($password);
                $sql = "SELECT * FROM usuarios WHERE correo = '$email' AND password ='$password' ";
                $resultado = $conexion->query($sql);
                $resultado = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;
                if ($resultado) {
                    if ($resultado['validar'] == 0) {
                        die(json_encode(array('respuesta' => 'error', 'Texto' => 'Es necesario que verifiques tu cuenta',)));
                    }
                    $respuesta = array('respuesta' => 'exito', 'Texto' => 'Redireccionando a tu perfil',);
                    $_SESSION['snsanfrancisco']['validacion'] = 'EXITO';
                    $_SESSION['snsanfrancisco']['idUsuario'] =  $resultado['idUsuario'];
                    $_SESSION['snsanfrancisco']['nombre'] =  $resultado['nombre'];
                    $_SESSION['snsanfrancisco']['apellidos'] =  $resultado['apellidos'];
                    $_SESSION['snsanfrancisco']['correo'] =  $resultado['correo'];
                    $_SESSION['snsanfrancisco']['fecha'] =  $resultado['fecha'];
                    $_SESSION['snsanfrancisco']['modo'] =  $resultado['modo'];
                    $_SESSION['snsanfrancisco']['rol'] =  $resultado['tipoUser'];
                    $_SESSION['snsanfrancisco']['imagen'] =  $resultado['img'];
                    $_SESSION['snsanfrancisco']['membresia'] = false;

                    $respuesta = array('respuesta' => 'exito', 'Texto' => 'Iniciando Sesion',);
                } else {
                    $respuesta = array('respuesta' => 'error', 'Texto' => 'Correo electronico o contraseña Incorrectos',);
                }
            } else {
                $respuesta = array('respuesta' => 'error', 'Texto' => 'Correo electronico o contraseña Incorrectos',);
            }
        } else {
            $respuesta = array('respuesta' => 'error', 'Texto' => 'No llegaron los datos de forma correcta', 'post' => $_POST);
        }
        die(json_encode($respuesta));
        break;
    case 'verificacion':
        $email          = (isset($_POST['email'])    && !empty($_POST['email']))    ? strtolower(htmlspecialchars($_POST['email'])) : false;
        $verificacion = (isset($_POST['codVerificacion'])    && !empty($_POST['codVerificacion']))    ? strtolower(htmlspecialchars($_POST['codVerificacion'])) : false;
        $sql = "SELECT idUsuario,nombre,apellidos,encriptado,correo,validar FROM usuarios WHERE correo ='$email' AND encriptado='$verificacion'";
        $resultado = $conexion->query($sql);
        if ($resultado && $resultado->num_rows) {
            $usuario = $resultado->fetch_assoc();
            if ($usuario['validar'] != 1) {
                $sql = "UPDATE usuarios SET validar=1 WHERE idUsuario = " . $usuario['idUsuario'];
                $resultado = $conexion->query($sql);
                if ($resultado && $conexion->affected_rows) {

                    $ADMINISTRADOR = new AdminFunciones();
                    $ADMINISTRADOR->CONEXION = $conexion;
                    $idUsuario =  $usuario['idUsuario'];
                    $codigos = $ADMINISTRADOR->codigosUser($idUsuario);
                    if (!$codigos) {
                        $codigo = $ADMINISTRADOR->codigoUnico();
                        $sql = "INSERT INTO codigos(codigo, idRango,idUsuario, idUser_Creador) VALUES ('$codigo',2,$idUsuario,1)";
                        $conexion->query($sql);
                    }

                    $respuesta = array('respuesta' => 'exito', 'Texto' => 'Tu cuenta fue validada de manera exitosa!, Inicia Sesión y continua con la tu configuración');
                } else {
                    $respuesta = array('respuesta' => 'error', 'Texto' => 'Por el momento no es posible verificar tu cuenta');
                }
            } else {
                $respuesta = array('respuesta' => 'error', 'Texto' => 'El correo ha sido validado con anterioridad, ya puedes ingresar a tu cuenta y continuar con su configuración');
            }
        } else {
            $respuesta = array('respuesta' => 'error', 'Texto' => 'No se encontraron coincidencias, no fue posible realizar la activación de tu cuenta');
        }

        die(json_encode($respuesta));
        break;
    case 'subscribirCuenta':
        // $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        // $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;
        die(json_encode($respuesta = array('respuesta' => 'exito', 'Texto' => 'Por el momento no es posible generar más subscripciones',)));
        break;
    case 'recuperacion':
        $correo     = (isset($_POST['correo'])    && !empty($_POST['correo']))    ? strtolower($_POST['correo']) : false;
        $password  = (isset($_POST['pass']) && !empty($_POST['pass'])) ? $_POST['pass'] : false;
        $passwordR = (isset($_POST['passR']) && !empty($_POST['passR'])) ? $_POST['passR'] : false;
        $codigo = (isset($_POST['codigo']) && !empty($_POST['codigo'])) ? $_POST['codigo'] : false;
        $paso = (isset($_POST['paso']) && !empty($_POST['paso'])) ? (int) $_POST['paso'] : false;
        if ($correo) {
            $ADMINFUNC = new AdminFunciones();
            $PLANTILLAS = new PlantillasEmail();
            $ADMINFUNC->CONEXION = $conexion;
            $USUARIO = $ADMINFUNC->revicionCorreo($correo);
            if ($USUARIO && $USUARIO['validar'] == 1) {
                if (!$codigo) {

                    /////////////////////////////////////////

                    $codigoVer = $ADMINFUNC->generarCodigo(16); //Genera un codigo de recuperación de la cuenta IMPORTANTE PARA ENVIAR POR CORREO!!!!

                    /////////////////////////////////////////

                    $arregloVer = "true|$codigoVer";
                    $userDatos = array(
                        'correo' => $USUARIO['correo'],
                        'nombre' => $USUARIO['nombre'] . $USUARIO['apellidos'],
                        'apellidos' => $USUARIO['apellidos'],
                        'verificacion' => '654654654',
                        'codigo' => $codigoVer,
                        'Subject' => 'Recuperación de contraseña',

                    );

                    $TEMPLATE = $PLANTILLAS->templateRecuperarPass($userDatos, $ruta); //Trae la plantilla de correo

                    $sql = "UPDATE usuarios SET recuperacion ='$arregloVer' WHERE idUsuario = " . $USUARIO['iduser'];
                    $conexion->query($sql);
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'Texto' => 'Se ha enviado un código a tu correo electronico, ve a tu bandeja de entrada, ahí encontraras los pasos para contunuar con tu recuperación', getdate()
                    );
                    if ($_SERVER['HTTP_HOST'] != "localhost") {
                        enviarCorreo($TEMPLATE, $userDatos);
                    }
                } else {
                    $compararCodigo = explode("|", $USUARIO['recuperacion']);
                    if (isset($compararCodigo[1]) && $compararCodigo[1] == $codigo) {
                        if ($paso == 2) {
                            if (($password && $passwordR) && $password === $passwordR) {
                                if (strlen($password) > 6) {
                                    $newPass = md5($password);
                                    $sql = "UPDATE usuarios SET password ='$newPass',recuperacion='' WHERE idUsuario = " . $USUARIO['iduser'];
                                    if ($conexion->query($sql)) {
                                        $respuesta = array('respuesta' => 'exito', 'Texto' => 'Contraseña cambiada de manera exitosa', 'change' => 'si');
                                    } else {
                                        $respuesta = array('respuesta' => 'error', 'Texto' => 'No fue posible cambiar la contraseña',);
                                    }
                                } else {
                                    $respuesta = array('respuesta' => 'error', 'Texto' => 'La nueva contraseña es muy corta',);
                                }
                            } else {
                                $respuesta = array('respuesta' => 'error', 'Texto' => 'Las contraseñas no son correctas');
                            }
                        } else {
                            $respuesta = array('respuesta' => 'verificado', 'Texto' => 'El código esta verificado');
                        }
                    } else {
                        $respuesta = array('respuesta' => 'error', 'Texto' => 'El código de verificación no concuerda',);
                    }
                }
            } else {
                $respuesta = array('respuesta' => 'error', 'Texto' => 'El Usuario no existe o aún no ha sido verificado',);
            }
        } else {
            $respuesta = array('respuesta' => 'error', 'Texto' => 'Es necesario completar el correo',);
        }
        die(json_encode($respuesta));
        break;
    default:
        break;
}

function enviarCorreo($plantilla, $datos)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    //  $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail

    $mail->CharSet = 'UTF-8';
    $mail->Debugoutput = 'html';

    $mail->Host = "mx72.hostgator.mx";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "webmaster@snsanfrancisco.com";
    $mail->Password = "onyK!1bL(VWi";
    $mail->SetFrom("webmaster@snsanfrancisco.com", "SNSanFrancisco");
    $mail->Subject = $datos['Subject'];
    $mail->msgHTML($plantilla);
    $mail->AddAddress('leonardovazquez81@gmail.com');
    $mail->AddAddress($datos['correo']);
    if (!$mail->Send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "Mensaje enviado correctamente";
    }
}
