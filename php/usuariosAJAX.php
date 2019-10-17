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
    // $datos = array(
    //     'correo' => $email,
    //     'url' => 'https://snsanfrancisco.com/',
    //     'validarCorreo' => md5($email),
    // );
    // $respuesta = enviarCorreo2($datos);
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
        // var_dump($resultado);
        enviarCorreo2(false);
        if ($email && $emailR && $nombre && $apellidos && $password && $passwordR) {
            if ($email == $emailR) {
                if ($password == $passwordR) {
                    if (!correoExiste($conexion, $email)) {
                        $sql = "INSERT INTO usuarios(nombre, apellidos, correo, password, tipoUser, validar, encriptado,modo) VALUES ('$nombre','$apellidos','$email','$password',$tipoUser,$validar,'$mailEncrypt','$modo')";
                        $resultado = $conexion->query($sql);
                        // var_dump($resultado);
                        if ($resultado) {
                            $datos = array(
                                'correo' => 'leonardovazquez81@gmail.com',
                                'url' => 'https://snsanfrancisco.com/',
                                'validarCorreo' => md5($email),
                            );
                            $respuesta = enviarCorreo2($datos);
                        } else {
                            $respuesta = array('respuesta' => 'error', 'Texto' => 'No fue posible realizar el registro', 'sql' => $sql, 'error' => $respuesta->error);
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
        $codVerificacion = (isset($_POST['codVerificacion'])    && !empty($_POST['codVerificacion']))    ? strtolower(htmlspecialchars($_POST['codVerificacion'])) : false;
        $respuesta = array('respuesta' => 'exito', 'Texto' => 'Verificacion Exitosa',);
        die(json_encode($respuesta));
        break;
    case 'subscribirCuenta':
        $idUser = ($USERLOGIN) ? $USERLOGIN['idUsuario'] : false;
        $idUser = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? (int) $_POST['idUsuario'] : $idUser;

        break;
    default:
        break;
}

function enviarCorreo2($datos)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mx72.hostgator.mx";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "no-reply@snsanfrancisco.com";
    $mail->Password = ")L7l9h1y~keT";
    $mail->SetFrom("no-reply@snsanfrancisco.com");
    $mail->Subject = "Comprobación de correo Electronico";
    $mail->Body = "Prueba de envio de correos desde hostgator";
    $mail->AddAddress("leonardovazquez81@gmail.com");
    // $mail->AddAddress("blancaflore2305@gmail.com");
    $mail->msgHTML('');
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Mensaje enviado correctamente";
    }
}
function enviarCorreo($datos)
{

    date_default_timezone_set("America/Mexico_City");

    // $url = ruta();
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    $mail->isMail();
    $mail->setFrom('Serviciosanfco@gmail.com', 'SF noticias y servicios');
    $mail->addReplyTo('Serviciosanfco@gmail.com', 'SF noticias y servicios');
    $mail->Subject = "Por favor verifique su dirección de correo electrónico";
    $mail->addAddress($datos['correo']);
    $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
			<center>
				
				<img style="padding:20px; width:50%" src="http://drive.google.com/uc?export=view&id=1VMXji0nuInMduFaI5RC7R97RUa0YeT6w">
		
			</center>
		
			<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
			
				<center>
				
				<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
		
				<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
		
				<hr style="border:1px solid #ccc; width:80%">
		
				<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>
		
				<a href="' . $datos['url'] . 'verificar/' . $datos['validarCorreo'] . '" target="_blank" style="text-decoration:none">
		
				<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>
		
				</a>
		
				<br>
		
				<hr style="border:1px solid #ccc; width:80%">
		
				<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
		
				</center>
			</div>
	
		</div>');
    $envio = $mail->Send();

    if (!$envio) {
        $respuesta = array(
            'respuesta' => 'exito',
            'Texto' => 'No fue posible enviar el correo de verificación'
        );
    } else {
        $respuesta = array(
            'respuesta' => 'exito',
            'Texto' => 'Registro realizado Satisfactoriamente,por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico ' . $datos['correo'] . ' para verificar su correo'
        );
    }
    return $respuesta;
}
