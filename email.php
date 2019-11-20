<?php
exit;
require_once 'php/emailTemplates.php';
require_once 'recursos/PHPMailer/src/PHPMailer.php';
require_once 'recursos/PHPMailer/src/SMTP.php';
$PLANTILLAS = new PlantillasEmail();
$datos = array(
    'correo' => 'leonardovazquez81@gmail.com',
    'nombre' => 'Leonardo Vázquez',
    'verificacion' => md5('leonardovazquez81@gmail.com')
);
$url = "https://snsanfrancisco.com/";
$CORREO = $PLANTILLAS->templateRegistro($datos, $url);

echo $CORREO;
enviarCorreo($CORREO, $datos);
function enviarCorreo($plantilla, $datos)
{
    // exit;
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
    $mail->SetFrom("webmaster@snsanfrancisco.com");
    $mail->Subject = "Verificación de Cuenta";
    $mail->msgHTML($plantilla);
    $mail->AddAddress($datos['correo']);
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Mensaje enviado correctamente";
    }
}
