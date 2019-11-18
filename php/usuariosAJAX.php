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

switch ($_POST['opcion']) {
    case 'registro':
        $email     = (isset($_POST['email'])    && !empty($_POST['email']))    ? strtolower($_POST['email']) : false;
        $emailR    = (isset($_POST['emailR'])   && !empty($_POST['emailR']))   ? strtolower($_POST['emailR']) : false;
        $nombre    = (isset($_POST['nombre'])   && !empty($_POST['nombre']))   ? strtolower($_POST['nombre']) : false;
        $apellidos = (isset($_POST['apellido']) && !empty($_POST['apellido'])) ? strtolower($_POST['apellido']) : false;
        $password  = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : false;
        $passwordR = (isset($_POST['passwordR']) && !empty($_POST['passwordR'])) ? $_POST['passwordR'] : false;

        $tipoUser = 3;
        $mailEncrypt = md5($email);
        $validar = 0;
        $modo = 'dir';
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
                                'nombre' => $nombre,
                                'apellido' => $apellidos,
                                'url' => $ruta,
                                'validarCorreo' => md5($email),
                            );
                            $respuesta = array('respuesta' => 'error', 'Texto' => 'Registro realizado con exito');

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
                $sql = "UPDATE `usuarios` SET validar=1 WHERE idUsuario = " . $usuario['idUsuario'];
                $resultado = $conexion->query($sql);
                if ($resultado && $conexion->affected_rows) {
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
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;

        break;
    default:
        break;
}


function enviarCorreo2($datos = false)
{
    $respuesta = array();
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->Debugoutput = 'html';
    // $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mx72.hostgator.mx";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "no-reply@snsanfrancisco.com";
    $mail->Password = "Syst3m4s34@$";
    $mail->SetFrom("no-reply@snsanfrancisco.com");
    $mail->Subject = "Comprobación de correo Electronico";
    $mail->Body = "Prueba de envio de correos desde hostgator";
    $mail->AddAddress("leonardovazquez81@gmail.com");
    // $mail->AddAddress("blancaflore2305@gmail.com");
    $mail->msgHTML('<h1>Holamundo</h1>');
    if (!$mail->Send()) {
        $respuesta = array(
            'respuesta' => 'error',
            'Texto' => "Mailer Error: " . $mail->ErrorInfo
        );
    } else {
        $respuesta = array(
            'respuesta' => 'exito',
            'Texto' => "Mensaje enviado correctamente"
        );
    }
    return $respuesta;
}

function EnviarCorreo($perfil = false)
{

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    // $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mx72.hostgator.mx";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "no-reply@snsanfrancisco.com";
    $mail->Password = ")L7l9h1y~keT";
    $mail->SetFrom("no-reply@snsanfrancisco.com");
    $mail->Subject = "Inicio de Sesión";
    $mail->Body = "Se ha ingresado a su cuenta desde la IP:";
    $mail->AddAddress("leonardovazquez81@gmail.com");
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Mensaje enviado correctamente";
    }
}
