<?php
date_default_timezone_set('America/Mexico_City');

global $mesesAnio;
global $SystemName;
global $EMAILCONFIG;

$systemName = "Servicios y Noticias San Francisco de Asís";
$mesesAnio = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

$EMAILCONFIG = array(
    'no-reply' => array(
        'nombre' => 'no-reply'
    ),
);

function valNum($dato)
{
    return preg_match('/^[0-9.]*$/', $dato);
}
function valTextNum($dato)
{
    return preg_match('/^[a-zA-Z0-9]*$/', $dato);
}
function valText($dato)
{
    return preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/', $dato);
}
function valDomicilio($dato)
{
    return preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 #-.+]*$/', $dato);
}
function valFecha($dato)
{
    return preg_match('/^[0-9-]*$/', $dato);
}
function valEmail($dato)
{
    return preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $dato);
}
function valPass($dato)
{
    return preg_match('/^[a-zA-Z0-9@]*$/', $dato);
}
function conexion($database, $baseDatos = false)
{
    $baseDatos = ($baseDatos) ? $baseDatos : $database['database'];
    $conexion = new mysqli($database['host'], $database['usuario'], $database['pass'], $baseDatos);
    $conexion->set_charset("utf8");
    return $conexion;
}
function generarPassword($longitud)
{
    $key = "";
    $pattern = "1234567890@abcdefghijklmnopqrstuvwxyz@ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $max = strlen($pattern) - 1;
    for ($i = 0; $i < $longitud; $i++) {
        $key .= $pattern{
            mt_rand(0, $max)};
    }
    return $key;
}
function formatoFecha($fecha, $mesesAnio)
{
    $formato = explode("-", $fecha);
    $day = (int) $formato[1];
    return $formato[2] . ' de ' . $mesesAnio[$day] . ' del ' . $formato[0];
}

function roles($rol)
{
    switch ($rol) {
        case 1:
            return 'Administrador';
            break;
        case 2:
            return 'Operador';
            break;
        case 3:
            return 'Cobrador';
            break;
        default:
            return 'Anonimo';
            break;
    }
}
function imageRol($rol)
{
    switch ($rol) {
        case 1:
            return 'isla.png';
            break;
        case 2:
            return 'island.png';
            break;
        case 3:
            return 'mountains.png';
            break;
        default:
            return 'home.png';
            break;
    }
}
function formatoHora($hora)
{
    $formato = explode(":", $hora);
    return ($formato[0] . ':' . $formato[1]);
}

function correoExiste($conexion, $correo)
{
    $sql = "SELECT `correo` FROM `usuarios` WHERE `correo` = '$correo'";
    $resultado = $conexion->query($sql);
    $resultado = ($resultado && $resultado->num_rows) ? true : false;
    return $resultado;
}
function rellenarCero($valor, $nCeros = 5)
{
    $cero = '';
    for ($i = strlen($valor); $i < $nCeros; $i++) {
        $cero .= '0';
    }
    return ($cero . $valor);
}

function optimizar_imagen($origen, $destino, $calidad)
{

    $info = getimagesize($origen);

    if ($info['mime'] == 'image/jpeg') {
        $imagen = imagecreatefromjpeg($origen);
    } else if ($info['mime'] == 'image/gif') {
        $imagen = imagecreatefromgif($origen);
    } else if ($info['mime'] == 'image/png') {
        $imagen = imagecreatefrompng($origen);
    }

    $enviar = imagejpeg($imagen, $destino, $calidad);

    return $enviar;
}

function fotoPerfil($UserLogin, $ruta)
{
    return  $ruta . (($UserLogin['imagen'] == 'default.png') ? "galeria/sistema/images/" : "galeria/usuario/" . rellenarCero($UserLogin['idUsuario']) . '/') . $UserLogin['imagen'];
}

function validarImagen($imagen)
{
    // echo json_encode($imagen);
    $tipo = $imagen["type"];
    $admitidos = ["image/jpg", "image/jpeg", "image/gif", "image/bmp", "image/png"];
    if (array_search($tipo, $admitidos)) {
        // $tamano = getimagesize($imagen['tmp_name']);
        // echo json_encode($tamano);
        if ($imagen['size'] > 5000000) {
            die(json_encode(array(
                'respuesta' => 'error',
                'Texto' => 'tamaño exedido ' . $imagen['name']
            )));
        }
    } else {
        die(json_encode(array(
            'respuesta' => 'error',
            'Texto' => 'tamaño exedido '
        )));
    }

    //  die(json_encode(array('respuesta'=>'error','Texto' => 'Prueva de imagenes ancho = '.$ancho.' alto = '.$alto)));
}
function eliminar_simbolos($string)
{
    $string = trim($string);
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
    $string = str_replace(
        array(
            "\\", "¨", "º", "-", "~",
            "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "<code>", "]",
            "+", "}", "{", "¨", "´",
            ">", "< ", ";", ",", ":",
            ".", " "
        ),
        ' ',
        $string
    );
    return $string;
}
function limpiarEnlaces($cadena)
{
    $cadena = limpiarEspacios($cadena);
    return str_replace(" ", "-", $cadena);
}
function limpiarEspacios($cadena)
{
    $limpia    = "";
    $parts    = [];
    // divido la cadena con todos los espacios q haya
    $parts = explode(" ", $cadena);
    foreach ($parts as $subcadena) {
        // de cada subcadena elimino sus espacios a los lados
        // $subcadena = trim($subcadena);
        // luego lo vuelvo a unir con un espacio para formar la nueva cadena limpia
        // omitir los que sean unicamente espacios en blanco
        if ($subcadena != "") {
            $limpia .= $subcadena . " ";
        }
    }
    $limpia = trim($limpia);
    return $limpia;
}
$EMAILCONFIG = array(
    'no-reply' => array(
        'nombre' => 'no-reply',
        'correo' => 'no-reply@snsanfrancisco.com',
        'pass' => ')L7l9h1y~keT',
        'host' => 'mx72.hostgator.mx',
        ''
    ),

);


// function enviarCorreo($correo,$cuerpo,$SERVER)
// {
    // $mail = new PHPMailer\PHPMailer\PHPMailer();
    // //$mail->SMTPDebug = 2;
    // $mail->Debugoutput = 'html';

    // $mail->IsSMTP(); // enable SMTP
    // $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
    // $mail->SMTPAuth = true; // authentication enabled
    // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    // $mail->Host = "mx72.hostgator.mx";
    // $mail->Port = 465; // or 587
    // $mail->IsHTML(true);
    // $mail->Username = "no-reply@snsanfrancisco.com";
    // $mail->Password = ")L7l9h1y~keT";
    // $mail->SetFrom("no-reply@snsanfrancisco.com");
    // $mail->Subject = "Prueva Lvazquez";
    // $mail->Body = "Prueba de envio de correos desde hostgator";
    // $mail->AddAddress("leonardovazquez81@gmail.com");
    // if (!$mail->Send()) {
    //     echo "Mailer Error: " . $mail->ErrorInfo;
    // } else {
    //     echo "Mensaje enviado correctamente";
    // }
// }
