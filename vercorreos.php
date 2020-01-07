<?php
require_once 'config/ruta.php';
require_once 'config/config.php';
require_once 'config/funciones.php';
require_once 'php/emailTemplates.php';

$PLANTILLAS = new PlantillasEmail();
$ruta = ruta();
$datos = array(
    'correo' => 'leonardovazquez81@gmail.com',
    'nombre' => 'Leonardo',
    'apellidos' => 'Vázquez',
    'verificacion' => '654654654',
    'codigo' => '3213213216458',
);
echo $PLANTILLAS->templateRecuperarPass($datos,$ruta);
