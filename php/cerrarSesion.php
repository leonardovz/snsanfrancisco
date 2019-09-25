<?php


session_start();

$cerrar = session_destroy();
if($cerrar){
    $respuesta = array('respuesta' => 'exito', 'Texto' => 'Redireccionando',);
}else{
    $respuesta = array('respuesta' => 'error', 'Texto' => 'No fue posible cerrar la Sesion',);
}
die(json_encode($respuesta));
?>