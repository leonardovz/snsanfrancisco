<?php
class PlantillasEmail
{
    var $CONEXION = false;
    function templateRegistro($estructura, $ruta)
    {
        $cuerpo = "".
        '<div>'.
            '<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">'.
                '<tr>'.
                    '<td align="center">'.
                        '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">'.
                            '<tr>'.
                                '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td align="center">'.
                                    '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td align="center" height="70" style="height:70px;">'.
                                                '<a href=""'.
                                                    'style="display: block; border-style: none !important; border: 0 !important;"><img width="100" border="0" style="display: block; width: 100px;" src="' . $ruta . 'galeria/sistema/logo/5.png" alt="" /></a>'.
                                            '</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<td align="center">'.
                                                '<table width="360 " border="0" cellpadding="0" cellspacing="0"'.
                                                    'style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590 hide">'.
                                                    '<tr>'.
                                                        '<td width="120" align="center" style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;"> <a href="https://snsanfrancisco.com/servicios/2/Desarrollador-Web" style="color: #312c32; text-decoration: none;">Desarrollo Web</a> </td>'.
                                                        '<td width="120" align="center" style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;"> <a href="https://snsanfrancisco.com/servicios/4/Arquitectura" style="color: #312c32; text-decoration: none;">Arquitectura</a> </td>'.
                                                        '<td width="120" align="center" style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;"> <a href="https://snsanfrancisco.com/servicios/6/Restaurantes" style="color: #312c32; text-decoration: none;">Cocina</a></td>'.
                                                    '</tr>'.
                                                '</table>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                            '</tr>'.
                        '</table>'.
                    '</td>'.
                '</tr>'.
            '</table>'.
            '<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">'.
                '<tr>'.
                    '<td align="center">'.
                        '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">'.
                            '<tr>'.
                                '<td align="center"'.
                                    'style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"'.
                                    'class="main-header">'.
                                        '<div style="line-height: 35px">'.
                                            'Bienvenido a <span style="color: #5caad2;">SNSanFrancisco</span>'.
                                    '</div>'.
                                '</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td align="center">'.
                                    '<table border="0" width="40" align="center" cellpadding="0" cellspacing="0"'.
                                        'bgcolor="eeeeee">'.
                                        '<tr>'.
                                            '<td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td align="left">'.
                                    '<table border="0" width="590" align="center" cellpadding="0" cellspacing="0"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td align="left" style="color: #888888; font-size: 16px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">'.
                                                '<p style="line-height: 24px; margin-bottom:15px;">'.
                                                    '¡Hola!, ' . $estructura["nombre"] . ''.
                                                '</p>'.
                                                '<p style="line-height: 24px;margin-bottom:15px;">'.
                                                    'Te damos la bienvenida a SNSanFrancisco, es muy importante para nosotros tu seguridad, por ello es necesario que hagas verificación de tu correo.'.
                                                '</p>'.
                                                '<p style="line-height: 24px; margin-bottom:20px;">'.
                                                    'Has click en el siguiente enlace para que puedas acceder y continuar con el registro de tu perfil.'.
                                                '</p>'.
                                                '<p style="line-height: 24px; margin-bottom:20px;">'.
                                                    'Recuerda que debes de ingresar tu correo electronico registrado: <br>'.
                                                    '' . $estructura["correo"] . ''.
                                                '</p>'.
                                                '<table border="0" align="center" width="180" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="margin-bottom:20px;">'.
                                                    '<tr>'.
                                                        '<td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>'.
                                                    '</tr>'.
                                                    '<tr>'.
                                                        '<td align="center" style="color: #ffffff; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">'.
                                                            '<div style="line-height: 22px;">'.
                                                                '<a href="' . $ruta . 'verificar/' . $estructura["verificacion"] . '" style="color: #ffffff; text-decoration: none;">VERIFICAR</a>'.
                                                            '</div>'.
                                                        '</td>'.
                                                    '</tr>'.
                                                    '<tr>'.
                                                        '<td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>'.
                                                    '</tr>'.
                                                '</table>'.
                                                '<p style="line-height: 24px">'.
                                                    'SNSanFrancisco,</br>'.
                                                    'Te damos La Bienvenida.'.
                                                '</p>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                        '</table>'.
                    '</td>'.
                '</tr>'.
                '<tr>'.
                    '<td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>'.
                '</tr>'.
            '</table>'.
            '<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">'.
                '<tr>'.
                    '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                '</tr>'.
                '<tr>'.
                    '<td align="center">'.
                        '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">'.
                            '<tr>'.
                                '<td>'.
                                    '<table border="0" align="left" cellpadding="0" cellspacing="0"'.
                                        'style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td align="left"'.
                                                'style="color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px; text-align: center;">'.
                                                '<div style="line-height: 24px; text-align: center;">'.
                                                    '<span style="color: #333333;">Servicios y Noticias</span>'.
                                                '</div>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                    '<table border="0" align="left" width="5" cellpadding="0" cellspacing="0"'.
                                        'style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>'.
                                        '</tr>'.
                                    '</table>'.
                                    '<table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">'.
                                        '<tr>'.
                                            '<td align="center">'.
                                                '<table align="center" border="0" cellpadding="0" cellspacing="0">'.
                                                    '<tr>'.
                                                        '<td align="center">'.
                                                            '<!-- <a style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;"'.
                                                                'href=""></a> -->'.
                                                        '</td>'.
                                                    '</tr>'.
                                                '</table>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                        '</table>'.
                    '</td>'.
                '</tr>'.
                '<tr>'.
                    '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                '</tr>'.
            '</table>'.
        '</div>';
        return $cuerpo;
    }
    function templateRecuperarPass($estructura, $ruta)
    {
        $cuerpo = "".
        '<div>'.
            '<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">'.
                '<tr>'.
                    '<td align="center">'.
                        '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">'.
                            '<tr>'.
                                '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td align="center">'.
                                    '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td align="center" height="70" style="height:70px;">'.
                                                '<a href="'.$ruta.'"'.
                                                    'style="display: block; border-style: none !important; border: 0 !important;"><img width="100" border="0" style="display: block; width: 100px;" src="' . $ruta . 'galeria/sistema/logo/5.png" alt="" /></a>'.
                                            '</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<td align="center">'.
                                                '<table width="360 " border="0" cellpadding="0" cellspacing="0"'.
                                                    'style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590 hide">'.
                                                    '<tr>'.
                                                        '<td width="120" align="center" style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;"> <a href="https://snsanfrancisco.com/servicios/2/Desarrollador-Web" style="color: #312c32; text-decoration: none;">Desarrollo Web</a> </td>'.
                                                        '<td width="120" align="center" style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;"> <a href="https://snsanfrancisco.com/servicios/4/Arquitectura" style="color: #312c32; text-decoration: none;">Arquitectura</a> </td>'.
                                                        '<td width="120" align="center" style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;"> <a href="https://snsanfrancisco.com/servicios/6/Restaurantes" style="color: #312c32; text-decoration: none;">Cocina</a></td>'.
                                                    '</tr>'.
                                                '</table>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                            '</tr>'.
                        '</table>'.
                    '</td>'.
                '</tr>'.
            '</table>'.
            '<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">'.
                '<tr>'.
                    '<td align="center">'.
                        '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">'.
                            '<tr>'.
                                '<td align="center"'.
                                    'style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"'.
                                    'class="main-header">'.
                                        '<div style="line-height: 35px">'.
                                            'Recuperacion de contraseña <span style="color: #5caad2;">SNSanFrancisco</span>'.
                                    '</div>'.
                                '</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td align="center">'.
                                    '<table border="0" width="40" align="center" cellpadding="0" cellspacing="0"'.
                                        'bgcolor="eeeeee">'.
                                        '<tr>'.
                                            '<td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>'.
                            '</tr>'.
                            '<tr>'.
                                '<td align="left">'.
                                    '<table border="0" width="590" align="center" cellpadding="0" cellspacing="0"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td align="left" style="color: #888888; font-size: 16px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">'.
                                                '<p style="line-height: 24px; margin-bottom:15px;">'.
                                                    '¡Hola!, ' . $estructura["nombre"] . ''.
                                                '</p>'.
                                                '<p style="line-height: 24px;margin-bottom:15px;">'.
                                                    'Recibimos tu solicitud de recuperación de contraseña.'.
                                                '</p>'.
                                                '<p style="line-height: 24px; margin-bottom:20px;">'.
                                                    'Has click en el siguiente enlace para que puedas continuar con la recuperacion de tu cuenta.'.
                                                '</p>'.
                                                '<p style="line-height: 24px; margin-bottom:20px;">'.
                                                    'Recuerda que debes de ingresar tu correo electronico registrado: <br>'.
                                                    '' . $estructura["correo"] . ''.
                                                '</p>'.
                                                '<p>Tu código es: <b style="font-size: 1.35em; margin: 0 15px; color:#000;">' . $estructura["codigo"] . '</b></p>'.
                                                '<table border="0" align="center" width="180" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="margin-bottom:20px;">'.
                                                    '<tr>'.
                                                        '<td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>'.
                                                    '</tr>'.
                                                    '<tr>'.
                                                        '<td align="center" style="color: #ffffff; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">'.
                                                            '<div style="line-height: 22px;">'.
                                                                '<a href="' . $ruta . 'recuperarCuenta/' . $estructura["codigo"] . '" style="color: #ffffff; text-decoration: none;">VERIFICAR</a>'.
                                                            '</div>'.
                                                        '</td>'.
                                                    '</tr>'.
                                                    '<tr>'.
                                                        '<td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>'.
                                                    '</tr>'.
                                                '</table>'.
                                                '<p style="line-height: 24px">'.
                                                    'SNSanFrancisco,</br>'.
                                                    'Continua con tus actividades de manera normal.'.
                                                '</p>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                        '</table>'.
                    '</td>'.
                '</tr>'.
                '<tr>'.
                    '<td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>'.
                '</tr>'.
            '</table>'.
            '<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">'.
                '<tr>'.
                    '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                '</tr>'.
                '<tr>'.
                    '<td align="center">'.
                        '<table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">'.
                            '<tr>'.
                                '<td>'.
                                    '<table border="0" align="left" cellpadding="0" cellspacing="0"'.
                                        'style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td align="left"'.
                                                'style="color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px; text-align: center;">'.
                                                '<div style="line-height: 24px; text-align: center;">'.
                                                    '<b style="color: #333333;">Servicios y Noticias San Francisco de Asís</b>'.
                                                '</div>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                    '<table border="0" align="left" width="5" cellpadding="0" cellspacing="0"'.
                                        'style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"'.
                                        'class="container590">'.
                                        '<tr>'.
                                            '<td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>'.
                                        '</tr>'.
                                    '</table>'.
                                    '<table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">'.
                                        '<tr>'.
                                            '<td align="center">'.
                                                '<table align="center" border="0" cellpadding="0" cellspacing="0">'.
                                                    '<tr>'.
                                                        '<td align="center">'.
                                                            '<!-- <a style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;"'.
                                                                'href=""></a> -->'.
                                                        '</td>'.
                                                    '</tr>'.
                                                '</table>'.
                                            '</td>'.
                                        '</tr>'.
                                    '</table>'.
                                '</td>'.
                            '</tr>'.
                        '</table>'.
                    '</td>'.
                '</tr>'.
                '<tr>'.
                    '<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>'.
                '</tr>'.
            '</table>'.
        '</div>';
        return $cuerpo;
    }
}
