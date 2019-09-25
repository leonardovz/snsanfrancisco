<?php

function ruta(){
    $ruta = $_SERVER['HTTP_HOST'];
    return 'http://'.$ruta.'/snsanfrancisco/'; 
}
