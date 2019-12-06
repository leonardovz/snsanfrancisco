<?php

function ruta()
{
    $ruta = $_SERVER['HTTP_HOST'];
    if ($ruta == "localhost") {
        return 'https://' . $ruta . '/snsanfrancisco/';
    } else {
        return 'https://' . $ruta . '/';
    }
}
