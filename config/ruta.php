<?php

function ruta(){
    $ruta = $_SERVER['HTTP_HOST'];
    return 'https://'.$ruta.'/'; 
}
